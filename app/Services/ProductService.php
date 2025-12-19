<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{
    /**
     * Get products query with filters.
     * 
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getProductsQuery(array $filters): \Illuminate\Database\Eloquent\Builder
    {
        $query = Product::with(['category', 'brands'])->select('products.*');

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['brand_id'])) {
            $brandIds = is_array($filters['brand_id']) ? $filters['brand_id'] : [$filters['brand_id']];
            
            // remove 'all' from array
            $brandIds = array_filter($brandIds, function($value) {
                return $value !== 'all';
            });

            if (!empty($brandIds)) {
                $query->whereHas('brands', function($q) use ($brandIds) {
                    $q->whereIn('brands.id', $brandIds);
                });
            }
        }

        if (!empty($filters['stock_status'])) {
            switch ($filters['stock_status']) {
                case 'in_stock':
                    $query->where('stock', '>', 0)->where('is_out_of_stock', false);
                    break;
                case 'out_of_stock':
                    $query->where(function($q) {
                        $q->where('stock', 0)->orWhere('is_out_of_stock', true);
                    });
                    break;
                case 'low_stock':
                    $query->where('stock', '>', 0)->where('stock', '<', 10)->where('is_out_of_stock', false);
                    break;
            }
        }

        if (!empty($filters['deal_status'])) {
            $query->where('deal_enabled', $filters['deal_status'] == 'on_deal');
        }

        if (!empty($filters['status'])) {
            $query->where('is_active', $filters['status'] == 'active');
        }

        return $query;
    }

    /**
     * Create a new product with all related data.
     * 
     * @param array $data
     * @param mixed $thumbnail
     * @param array $galleryImages
     * @param array $variants
     * @return \App\Models\Product
     */
    public function createProduct(array $data, $thumbnail = null, array $galleryImages = [], array $variants = []): Product
    {
        return DB::transaction(function () use ($data, $thumbnail, $galleryImages, $variants) {
            $product = new Product();
            $product->name = $data['name'];
            $product->slug = $data['slug'] ?? generate_slug($data['name'], 'products');
            $product->category_id = $data['category_id'];
            $product->short_desc = nullable_or_value($data['short_desc'] ?? null);
            $product->description = $data['description'];
            
            if (!empty($data['sku'])) {
                $product->sku = $data['sku'];
            }
            
            $product->price = nullable_or_value($data['price'] ?? null);
            $product->compare_price = nullable_or_value($data['compare_price'] ?? null);
            $product->cost_price = nullable_or_value($data['cost_price'] ?? null);
            $product->video = nullable_or_value($data['video'] ?? null);
            $product->stock = $data['stock'] ?? 0;
            $product->is_featured = !empty($data['is_featured']);
            $product->is_active = !empty($data['is_active']);
            $product->is_out_of_stock = !empty($data['is_out_of_stock']);
            $product->has_variants = !empty($data['has_variants']);
            $product->deal_enabled = !empty($data['deal_enabled']);
            $product->deal_start = nullable_or_value($data['deal_start'] ?? null);
            $product->deal_end = nullable_or_value($data['deal_end'] ?? null);
            $product->deal_price = nullable_or_value($data['deal_price'] ?? null);
            $product->display_price = nullable_or_value($data['display_price'] ?? null);
            $product->percentage_off = nullable_or_value($data['percentage_off'] ?? null);
            
            // Auto-generate sort_order
            $maxSortOrder = Product::where('category_id', $product->category_id)->max('sort_order');
            $product->sort_order = $maxSortOrder !== null ? $maxSortOrder + 1 : 0;
            
            $product->save();

            // Brands
            if (!empty($data['brand_ids'])) {
                $product->brands()->sync($data['brand_ids']);
            }

            // Specifications
            $specs = parse_specs($data['specs'] ?? []);
            $product->specification()->create([
                'weight' => nullable_or_value($data['weight'] ?? null),
                'weight_unit' => $data['weight_unit'] ?? 'kg',
                'length' => nullable_or_value($data['length'] ?? null),
                'width' => nullable_or_value($data['width'] ?? null),
                'height' => nullable_or_value($data['height'] ?? null),
                'dimension_unit' => $data['dimension_unit'] ?? 'cm',
                'specs' => $specs,
            ]);

            // Variants
            if ($product->has_variants && !empty($variants)) {
                foreach ($variants as $index => $variantData) {
                    $variant = $product->variants()->create([
                        'sku' => !empty($variantData['sku']) ? $variantData['sku'] : $product->sku . '-V' . ($index + 1),
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'] ?? 0,
                        'is_active' => true,
                        'sort_order' => $index,
                    ]);

                    if (isset($variantData['image_file'])) {
                        $variant->image = upload_file($variantData['image_file'], 'products/variants');
                        $variant->save();
                    }

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

            // Thumbnail
            if ($thumbnail) {
                $path = upload_file($thumbnail, 'products');
                $product->images()->create([
                    'orig_path' => $path,
                    'thumb_path' => $path,
                    'description' => 'Main Thumbnail',
                    'is_primary' => true,
                    'order' => 0,
                ]);
            }

            // Gallery
            if (!empty($galleryImages)) {
                foreach ($galleryImages as $index => $image) {
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

            return $product;
        });
    }

    /**
     * Update an existing product.
     * 
     * @param \App\Models\Product $product
     * @param array $data
     * @param mixed $thumbnail
     * @param array $galleryImages
     * @param array $variants
     * @param array|null $deleteImageIds
     * @return \App\Models\Product
     */
    public function updateProduct(Product $product, array $data, $thumbnail = null, array $galleryImages = [], array $variants = [], ?array $deleteImageIds = []): Product
    {
        return DB::transaction(function () use ($product, $data, $thumbnail, $galleryImages, $variants, $deleteImageIds) {
            $wasSimpleProduct = !$product->has_variants;
            
            $product->name = $data['name'];
            $product->slug = $data['slug'] ?? generate_slug($data['name'], 'products');
            $product->category_id = $data['category_id'];
            $product->short_desc = nullable_or_value($data['short_desc'] ?? null);
            $product->description = $data['description'];
            
            if (!empty($data['sku'])) {
                $product->sku = $data['sku'];
            }
            
            $product->price = nullable_or_value($data['price'] ?? null);
            $product->compare_price = nullable_or_value($data['compare_price'] ?? null);
            $product->cost_price = nullable_or_value($data['cost_price'] ?? null);
            $product->video = nullable_or_value($data['video'] ?? null);
            $product->stock = $data['stock'] ?? 0;
            $product->is_featured = !empty($data['is_featured']);
            $product->is_active = !empty($data['is_active']);
            $product->has_variants = !empty($data['has_variants']);
            $product->deal_enabled = !empty($data['deal_enabled']);
            $product->deal_start = nullable_or_value($data['deal_start'] ?? null);
            $product->deal_end = nullable_or_value($data['deal_end'] ?? null);
            $product->deal_price = nullable_or_value($data['deal_price'] ?? null);
            $product->display_price = nullable_or_value($data['display_price'] ?? null);
            $product->percentage_off = nullable_or_value($data['percentage_off'] ?? null);
            $product->is_out_of_stock = !empty($data['is_out_of_stock']);
            
            $product->save();

            // Brands
            if (isset($data['brand_ids'])) {
                $product->brands()->sync($data['brand_ids']);
            }

            // Specifications
            $specs = parse_specs($data['specs'] ?? []);
            $specData = [
                'weight' => nullable_or_value($data['weight'] ?? null),
                'weight_unit' => $data['weight_unit'] ?? 'kg',
                'length' => nullable_or_value($data['length'] ?? null),
                'width' => nullable_or_value($data['width'] ?? null),
                'height' => nullable_or_value($data['height'] ?? null),
                'dimension_unit' => $data['dimension_unit'] ?? 'cm',
                'specs' => $specs,
            ];

            if ($product->specification) {
                $product->specification->update($specData);
            } else {
                $product->specification()->create($specData);
            }


            // Variants management
            if ($product->has_variants) {
                $updatedVariantIds = [];
                foreach ($variants as $index => $variantData) {
                    if (!empty($variantData['id'])) {
                        $variant = ProductVariant::find($variantData['id']);
                        if ($variant && $variant->product_id == $product->id) {
                            $variant->update([
                                'sku' => !empty($variantData['sku']) ? $variantData['sku'] : $product->sku . '-V' . ($index + 1),
                                'price' => $variantData['price'],
                                'compare_price' => $variantData['compare_price'] ?? null,
                                'stock' => $variantData['stock'] ?? 0,
                                'sort_order' => $index,
                            ]);
                            
                            if (isset($variantData['image_file'])) {
                                if ($variant->image) delete_file($variant->image);
                                $variant->image = upload_file($variantData['image_file'], 'products/variants');
                                $variant->save();
                            }
                            $updatedVariantIds[] = $variant->id;

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
                        $variant = $product->variants()->create([
                            'sku' => !empty($variantData['sku']) ? $variantData['sku'] : $product->sku . '-V' . ($index + 1),
                            'price' => $variantData['price'],
                            'compare_price' => $variantData['compare_price'] ?? null,
                            'stock' => $variantData['stock'] ?? 0,
                            'is_active' => true,
                            'sort_order' => $index,
                        ]);
                        
                        if (isset($variantData['image_file'])) {
                            $variant->image = upload_file($variantData['image_file'], 'products/variants');
                            $variant->save();
                        }
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
                $variantsToDelete = $product->variants()->whereNotIn('id', $updatedVariantIds)->get();
                foreach ($variantsToDelete as $v) {
                    if ($v->image) delete_file($v->image);
                    $v->delete();
                }
            } else {
                foreach ($product->variants as $v) {
                    if ($v->image) delete_file($v->image);
                    $v->delete();
                }
            }

            // Image cleanup
            if (!empty($deleteImageIds)) {
                foreach ($deleteImageIds as $imageId) {
                    $image = $product->images()->find($imageId);
                    if ($image) {
                        delete_file($image->orig_path);
                        if ($image->thumb_path !== $image->orig_path) delete_file($image->thumb_path);
                        $image->delete();
                    }
                }
            }

            // Thumbnail Update
            if ($thumbnail) {
                $path = upload_file($thumbnail, 'products');
                $existingPrimary = $product->images()->where('is_primary', true)->first();
                if ($existingPrimary) {
                    delete_file($existingPrimary->orig_path);
                    if ($existingPrimary->thumb_path !== $existingPrimary->orig_path) delete_file($existingPrimary->thumb_path);
                    $existingPrimary->update(['orig_path' => $path, 'thumb_path' => $path]);
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

            // Gallery additions
            if (!empty($galleryImages)) {
                $startOrder = $product->images()->max('order') + 1;
                foreach ($galleryImages as $index => $image) {
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

            return $product;
        });
    }

    /**
     * Delete product and all related files.
     * 
     * @param \App\Models\Product $product
     * @return bool|null
     */
    public function deleteProduct(Product $product): ?bool
    {
        return DB::transaction(function () use ($product) {
            foreach ($product->images as $image) {
                delete_file($image->orig_path);
                if ($image->thumb_path !== $image->orig_path) delete_file($image->thumb_path);
            }
            $product->images()->delete();

            foreach ($product->variants as $variant) {
                if ($variant->image) delete_file($variant->image);
            }
            $product->variants()->delete();

            return $product->delete();
        });
    }

    /**
     * Handle bulk reordering.
     * 
     * @param array $order
     * @return bool
     */
    public function reorderProducts(array $order): bool
    {
        foreach ($order as $item) {
            Product::where('id', $item['id'])->update(['sort_order' => $item['position']]);
        }
        return true;
    }

    /**
     * Update SEO meta fields.
     * 
     * @param \App\Models\Product $product
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateSeo(Product $product, array $data): \Illuminate\Database\Eloquent\Model
    {
        return $product->seo()->updateOrCreate([], [
            'meta_fields' => $data['meta_fields'] ?? [],
            'open_graph_fields' => $data['open_graph_fields'] ?? [],
            'twitter_cards' => $data['twitter_cards'] ?? [],
            'schemas' => !empty($data['schemas']) ? json_decode($data['schemas'], true) : null,
        ]);
    }

    /**
     * Toggle product status (active/featured).
     * 
     * @param int $productId
     * @param string $type
     * @param bool $value
     * @return \App\Models\Product
     */
    public function toggleStatus(int $productId, string $type, bool $value): Product
    {
        $product = Product::findOrFail($productId);
        $product->$type = $value;
        $product->save();
        return $product;
    }

    /**
     * Store/Update FAQs for a product.
     * 
     * @param \App\Models\Product $product
     * @param array $faqs
     * @return bool
     */
    public function storeFaqs(Product $product, array $faqs): bool
    {
        return DB::transaction(function () use ($product, $faqs) {
            $product->faqs()->delete();
            foreach ($faqs as $faqData) {
                $product->faqs()->create([
                    'question' => $faqData['question'],
                    'answer' => $faqData['answer'],
                ]);
            }
            return true;
        });
    }
}
