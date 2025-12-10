<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\ProductVariant;
use App\Models\ProductSpecification;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateProductSeoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['category', 'brand']);
            return DataTables::of($products)
                ->addColumn('category_name', function ($product) {
                    return $product->category ? $product->category->name : '<span class="text-muted">None</span>';
                })
                ->addColumn('brand_name', function ($product) {
                    return $product->brand ? $product->brand->name : '<span class="text-muted">None</span>';
                })
                ->addColumn('price_display', function ($product) {
                    if ($product->has_variants) {
                        return '<span class="text-muted">Variants</span>';
                    }
                    return format_price($product->price);
                })
                ->addColumn('status', function ($product) {
                    return get_active_badge($product->is_active);
                })
                ->addColumn('featured', function ($product) {
                    return $product->is_featured 
                        ? '<span class="badge bg-primary">Featured</span>' 
                        : '<span class="text-muted">-</span>';
                })
                ->addColumn('action', function ($product) {
                    return view('admin.content.products.action', compact('product'))->render();
                })
                ->rawColumns(['category_name', 'brand_name', 'price_display', 'status', 'featured', 'action'])
                ->make(true);
        }

        return view('admin.content.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::all();
        $attributes = Attribute::with('options')->orderBy('sort_order')->get();
        $variantAttributes = Attribute::where('is_variant', true)->with('options')->get();
        
        return view('admin.content.products.create', compact('categories', 'brands', 'attributes', 'variantAttributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // Create product
            $product = new Product();
            $product->name = $validated['name'];
            $product->slug = $validated['slug'] ?? generate_slug($validated['name'], 'products');
            $product->category_id = $validated['category_id'];
            $product->brand_id = nullable_or_value($validated['brand_id'] ?? null);
            $product->short_desc = nullable_or_value($validated['short_desc'] ?? null);
            $product->description = $validated['description'];
            $product->sku = $validated['sku'];
            $product->price = nullable_or_value($validated['price'] ?? null);
            $product->cost_price = nullable_or_value($validated['cost_price'] ?? null);
            $product->video = nullable_or_value($validated['video'] ?? null);
            $product->stock = $validated['stock'] ?? 0;
            $product->is_featured = $request->has('is_featured');
            $product->is_active = $request->has('is_active');
            $product->has_variants = $request->has('has_variants');
            $product->deal_enabled = $request->has('deal_enabled');
            $product->deal_start = nullable_or_value($validated['deal_start'] ?? null);
            $product->deal_end = nullable_or_value($validated['deal_end'] ?? null);
            $product->save();

            // Create specifications
            if ($request->filled('weight') || $request->filled('length') || $request->filled('specs')) {
                $specs = parse_specs($request->input('specs', []));
                $product->specification()->create([
                    'weight' => nullable_or_value($validated['weight'] ?? null),
                    'weight_unit' => $validated['weight_unit'] ?? 'kg',
                    'length' => nullable_or_value($validated['length'] ?? null),
                    'width' => nullable_or_value($validated['width'] ?? null),
                    'height' => nullable_or_value($validated['height'] ?? null),
                    'dimension_unit' => $validated['dimension_unit'] ?? 'cm',
                    'specs' => $specs,
                ]);
            }

            // Create variants
            if ($request->has('has_variants') && $request->filled('variants')) {
                foreach ($request->input('variants', []) as $index => $variantData) {
                    $variant = $product->variants()->create([
                        'sku' => !empty($variantData['sku']) ? $variantData['sku'] : $product->sku . '-V' . ($index + 1),
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'] ?? 0,
                        'is_active' => true,
                        'sort_order' => $index,
                    ]);

                    // Attach variant attributes
                    if (!empty($variantData['attributes'])) {
                        foreach ($variantData['attributes'] as $attrId => $optionId) {
                            if ($optionId) {
                                $variant->attributeValues()->create([
                                    'attribute_id' => $attrId,
                                    'attribute_option_id' => $optionId,
                                ]);
                            }
                        }
                    }
                }
            }

            // Upload Main Thumbnail
            if ($request->hasFile('thumbnail')) {
                $path = upload_file($request->file('thumbnail'), 'products');
                $product->images()->create([
                    'orig_path' => $path,
                    'thumb_path' => $path,
                    'description' => 'Main Thumbnail',
                    'is_primary' => true,
                    'order' => 0,
                ]);
            }

            // Upload Gallery Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = upload_file($image, 'products');
                    $product->images()->create([
                        'orig_path' => $path,
                        'thumb_path' => $path,
                        'description' => $image->getClientOriginalName(),
                        'is_primary' => false,
                        'order' => $index + 1,
                    ]);
                }
            }

            // Save FAQs
            if ($request->filled('faqs')) {
                foreach ($request->input('faqs') as $faq) {
                    $product->faqs()->create([
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'redirect' => route('products.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'specification', 'variants.attributeValues.option', 'attributeValues.attribute', 'attributeValues.option']);
        return view('admin.content.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load(['specification', 'variants.attributeValues', 'attributeValues']);
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::all();
        $attributes = Attribute::with('options')->orderBy('sort_order')->get();
        $variantAttributes = Attribute::where('is_variant', true)->with('options')->get();

        return view('admin.content.products.edit', compact('product', 'categories', 'brands', 'attributes', 'variantAttributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // Update product
            $product->name = $validated['name'];
            $product->slug = $validated['slug'] ?? generate_slug($validated['name'], 'products');
            $product->category_id = $validated['category_id'];
            $product->brand_id = nullable_or_value($validated['brand_id'] ?? null);
            $product->short_desc = nullable_or_value($validated['short_desc'] ?? null);
            $product->description = $validated['description'];
            if (!empty($validated['sku'])) {
                $product->sku = $validated['sku'];
            } else {
                 $sku = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(10));
                 while (Product::where('sku', $sku)->where('id', '!=', $product->id)->exists()) {
                    $sku = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(10));
                 }
                 $product->sku = $sku;
            }
            $product->price = nullable_or_value($validated['price'] ?? null);
            $product->cost_price = nullable_or_value($validated['cost_price'] ?? null);
            $product->video = nullable_or_value($validated['video'] ?? null);
            $product->stock = $validated['stock'] ?? 0;
            $product->is_featured = $request->has('is_featured');
            $product->is_active = $request->has('is_active');
            $product->has_variants = $request->has('has_variants');
            $product->deal_enabled = $request->has('deal_enabled');
            $product->deal_start = nullable_or_value($validated['deal_start'] ?? null);
            $product->deal_end = nullable_or_value($validated['deal_end'] ?? null);
            $product->save();

            // Update specifications
            $specs = parse_specs($request->input('specs', []));
            $specData = [
                'weight' => nullable_or_value($validated['weight'] ?? null),
                'weight_unit' => $validated['weight_unit'] ?? 'kg',
                'length' => nullable_or_value($validated['length'] ?? null),
                'width' => nullable_or_value($validated['width'] ?? null),
                'height' => nullable_or_value($validated['height'] ?? null),
                'dimension_unit' => $validated['dimension_unit'] ?? 'cm',
                'specs' => $specs,
            ];

            if ($product->specification) {
                $product->specification->update($specData);
            } else {
                $product->specification()->create($specData);
            }

            // Update variants
            if ($request->has('has_variants')) {
                // Get existing variant IDs
                $existingVariantIds = $product->variants->pluck('id')->toArray();
                $updatedVariantIds = [];

                foreach ($request->input('variants', []) as $index => $variantData) {
                    if (!empty($variantData['id'])) {
                        // Update existing variant
                        $variant = ProductVariant::find($variantData['id']);
                        if ($variant && $variant->product_id == $product->id) {
                            $variant->update([
                                'sku' => !empty($variantData['sku']) ? $variantData['sku'] : $product->sku . '-V' . ($index + 1),
                                'price' => $variantData['price'],
                                'compare_price' => $variantData['compare_price'] ?? null,
                                'stock' => $variantData['stock'] ?? 0,
                                'sort_order' => $index,
                            ]);
                            $updatedVariantIds[] = $variant->id;

                            // Update variant attributes
                            $variant->attributeValues()->delete();
                            if (!empty($variantData['attributes'])) {
                                foreach ($variantData['attributes'] as $attrId => $optionId) {
                                    if ($optionId) {
                                        $variant->attributeValues()->create([
                                            'attribute_id' => $attrId,
                                            'attribute_option_id' => $optionId,
                                        ]);
                                    }
                                }
                            }
                        }
                    } else {
                        // Create new variant
                        $variant = $product->variants()->create([
                            'sku' => !empty($variantData['sku']) ? $variantData['sku'] : $product->sku . '-V' . ($index + 1),
                            'price' => $variantData['price'],
                            'compare_price' => $variantData['compare_price'] ?? null,
                            'stock' => $variantData['stock'] ?? 0,
                            'is_active' => true,
                            'sort_order' => $index,
                        ]);
                        $updatedVariantIds[] = $variant->id;

                        if (!empty($variantData['attributes'])) {
                            foreach ($variantData['attributes'] as $attrId => $optionId) {
                                if ($optionId) {
                                    $variant->attributeValues()->create([
                                        'attribute_id' => $attrId,
                                        'attribute_option_id' => $optionId,
                                    ]);
                                }
                            }
                        }
                    }
                }

                // Delete removed variants
                $variantsToDelete = array_diff($existingVariantIds, $updatedVariantIds);
                ProductVariant::whereIn('id', $variantsToDelete)->delete();
            } else {
                // If variants disabled, remove all variants
                $product->variants()->delete();
            }

            // Delete marked images
            if ($request->filled('delete_image_ids')) {
                foreach ($request->input('delete_image_ids') as $imageId) {
                    $image = $product->images()->find($imageId);
                    if ($image) {
                        delete_file($image->orig_path);
                        if ($image->thumb_path !== $image->orig_path) {
                            delete_file($image->thumb_path);
                        }
                        $image->delete();
                    }
                }
            }

            // Update Main Thumbnail
            if ($request->hasFile('thumbnail')) {
                $path = upload_file($request->file('thumbnail'), 'products');
                
                // Find existing primary image
                $existingPrimary = $product->images()->where('is_primary', true)->first();
                if ($existingPrimary) {
                    delete_file($existingPrimary->orig_path);
                    if ($existingPrimary->thumb_path !== $existingPrimary->orig_path) {
                        delete_file($existingPrimary->thumb_path);
                    }
                    $existingPrimary->update([
                        'orig_path' => $path,
                        'thumb_path' => $path,
                        'description' => 'Main Thumbnail',
                    ]);
                } else {
                    $product->images()->create([
                        'orig_path' => $path,
                        'thumb_path' => $path,
                        'description' => 'Main Thumbnail',
                        'is_primary' => true,
                        'order' => 0,
                    ]);
                }
            }

            // Upload New Gallery Images
            if ($request->hasFile('images')) {
                $startOrder = $product->images()->max('order') + 1;
                foreach ($request->file('images') as $index => $image) {
                    $path = upload_file($image, 'products');
                    $product->images()->create([
                        'orig_path' => $path,
                        'thumb_path' => $path,
                        'description' => $image->getClientOriginalName(),
                        'is_primary' => false,
                        'order' => $startOrder + $index,
                    ]);
                }
            }

            $product->faqs()->delete();
            if ($request->filled('faqs')) {
                foreach ($request->input('faqs') as $faqData) {
                    $product->faqs()->create([
                        'question' => $faqData['question'],
                        'answer' => $faqData['answer'],
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'redirect' => route('products.index')
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image files
        foreach ($product->images as $image) {
            delete_file($image->orig_path);
            if ($image->thumb_path !== $image->orig_path) {
                delete_file($image->thumb_path);
            }
        }
        $product->images()->delete(); // Database records
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Show the form for editing the SEO meta.
     */
    public function editSeo(Product $product)
    {
        return view('admin.content.products.edit-meta-fields', [
            'product' => $product->load('seo'),
        ]);
    }

    /**
     * Update the SEO meta.
     */
    public function updateSeo(UpdateProductSeoRequest $request, Product $product)
    {
        $validated = $request->validated();

        $data = [
            'meta_fields' => $validated['meta_fields'] ?? [],
            'open_graph_fields' => $validated['open_graph_fields'] ?? [],
            'twitter_cards' => $validated['twitter_cards'] ?? [],
            'schemas' => !empty($validated['schemas']) ? json_decode($validated['schemas'], true) : null,
        ];

        $product->seo()->updateOrCreate([], $data);

        return redirect()->route('products.index')->with('success', 'Product SEO updated successfully.');
    }
}
