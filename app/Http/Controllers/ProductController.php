<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Services\ProductService;
use App\Services\DataTableService;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateProductSeoRequest;

class ProductController extends Controller
{
    protected $productService;
    protected $dataTableService;

    public function __construct(ProductService $productService, DataTableService $dataTableService)
    {
        $this->productService = $productService;
        $this->dataTableService = $dataTableService;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $query = $this->productService->getProductsQuery($request->all());
            return $this->dataTableService->productsTable($query);
        }

        return view('admin.content.products.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::all();
        $attributes = Attribute::with('options')->orderBy('sort_order')->get();
        $variantAttributes = Attribute::where('is_variant', true)->with('options')->get();
        
        return view('admin.content.products.create', compact('categories', 'brands', 'attributes', 'variantAttributes'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $this->productService->createProduct(
                $request->validated(),
                $request->file('thumbnail'),
                $request->file('images', []),
                $request->input('variants', [])
            );

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        $product->load(['category', 'brands', 'specification', 'variants.attributeValues.option', 'attributeValues.attribute', 'attributeValues.option']);
        return view('admin.content.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
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
     * 
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        try {
            $this->productService->updateProduct(
                $product,
                $request->validated(),
                $request->file('thumbnail'),
                $request->file('images', []),
                $request->input('variants', []),
                $request->input('delete_image_ids', [])
            );

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'redirect' => route('products.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        try {
            $this->productService->deleteProduct($product);
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    /**
     * Show SEO settings page.
     * 
     * @param Product $product
     * @return View
     */
    public function editSeo(Product $product): View
    {
        return view('admin.content.products.edit-meta-fields', [
            'product' => $product->load('seo'),
        ]);
    }

    /**
     * Update SEO settings.
     * 
     * @param UpdateProductSeoRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function updateSeo(UpdateProductSeoRequest $request, Product $product): RedirectResponse
    {
        $this->productService->updateSeo($product, $request->validated());
        return redirect()->route('products.index')->with('success', 'Product SEO updated successfully.');
    }

    /**
     * Show FAQ settings page.
     * 
     * @param Product $product
     * @return View
     */
    public function manageFaqs(Product $product): View
    {
        $product->load('faqs');
        return view('admin.content.products.manage-faqs', compact('product'));
    }

    /**
     * Update FAQ settings.
     * 
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function storeFaqs(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string|max:255',
            'faqs.*.answer' => 'required_with:faqs|string',
        ]);

        $this->productService->storeFaqs($product, $request->input('faqs', []));
        return redirect()->route('products.faqs', $product)->with('success', 'FAQs updated successfully.');
    }

    /**
     * Toggle product status via AJAX.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function toggleStatus(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'type' => 'required|in:is_active,is_featured',
            'value' => 'required|boolean',
        ]);

        $this->productService->toggleStatus($request->id, $request->type, $request->value);

        $label = $request->type == 'is_active' ? 'Status' : 'Featured status';
        return response()->json([
            'success' => true,
            'message' => "Product {$label} updated successfully!"
        ]);
    }

    /**
     * Reorder products via drag and drop.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:products,id',
            'order.*.position' => 'required|integer',
        ]);

        $this->productService->reorderProducts($request->order);

        return response()->json([
            'success' => true,
            'message' => 'Product order updated successfully!'
        ]);
    }
}
