<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Services\CollectionService;
use App\Services\DataTableService;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;

class CollectionController extends Controller
{
    protected $collectionService;
    protected $dataTableService;

    public function __construct(CollectionService $collectionService, DataTableService $dataTableService)
    {
        $this->collectionService = $collectionService;
        $this->dataTableService = $dataTableService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Collection::withCount('products');
            return $this->dataTableService->collectionsTable($query);
        }
        return view('admin.content.collections.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('admin.content.collections.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionRequest $request): RedirectResponse
    {
        $this->collectionService->createCollection($request->validated());
        return redirect()->route('collections.index')->with('success', 'Collection created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection): View
    {
        $collection->load('products');
        $products = Product::where('is_active', true)->orderBy('name')->get();
        return view('admin.content.collections.edit', compact('collection', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionRequest $request, Collection $collection): RedirectResponse
    {
        $this->collectionService->updateCollection($collection, $request->validated());
        return redirect()->route('collections.index')->with('success', 'Collection updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection): RedirectResponse
    {
        $this->collectionService->deleteCollection($collection);
        return redirect()->route('collections.index')->with('success', 'Collection deleted successfully.');
    }

    /**
     * Toggle status via AJAX.
     */
    public function toggleStatus(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:collections,id',
            'value' => 'required|boolean',
        ]);

        $this->collectionService->toggleStatus($request->id, $request->value);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }

    /**
     * Show products belonging to a collection for reordering.
     */
    public function products(Request $request, Collection $collection): View|JsonResponse
    {
        if ($request->ajax()) {
            $products = $collection->products()
                ->select('products.*', 'collection_product.sort_order as sort_order');
            return $this->dataTableService->collectionProductsTable($products);
        }

        return view('admin.content.collections.products', compact('collection'));
    }

    /**
     * Handle bulk reordering of collection products.
     */
    public function reorderProducts(Request $request): JsonResponse
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|integer',
            'order.*.position' => 'required|integer',
            'collection_id' => 'required|integer|exists:collections,id',
        ]);

        $this->collectionService->reorderCollectionProducts($request->collection_id, $request->order);

        return response()->json(['success' => true]);
    }
}
