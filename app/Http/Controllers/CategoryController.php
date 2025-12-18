<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\ToggleCategoryStatusRequest;

class CategoryController extends Controller
{
    protected $dataTableService;

    public function __construct(DataTableService $dataTableService)
    {
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
            $categories = Category::with('parent');
            return $this->dataTableService->categoriesTable($categories);
        }

        return view('admin.content.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.content.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->has('show_on_homepage') && Category::where('show_on_homepage', true)->count() >= 4) {
            return redirect()->back()->withInput()->with('error', 'Maximum 4 categories can be shown on the home page.');
        }

        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = $validated['slug'] ?? Str::slug($validated['name']);
        $category->title = $validated['title'] ?? null;
        $category->icon = $validated['icon'] ?? null;
        $category->parent_id = $validated['parent_id'] ?? 0;
        $category->description = $validated['description'] ?? null;
        $category->is_active = $request->has('is_active');
        $category->show_on_homepage = $request->has('show_on_homepage');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('admin.content.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        $categories = Category::where('parent_id', 0)->where('id', '!=', $category->id)->get();
        return view('admin.content.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->has('show_on_homepage') && !$category->show_on_homepage && Category::where('show_on_homepage', true)->count() >= 4) {
            return redirect()->back()->withInput()->with('error', 'Maximum 4 categories can be shown on the home page.');
        }

        $category->name = $validated['name'];
        $category->slug = $validated['slug'] ?? Str::slug($validated['name']);
        $category->title = $validated['title'] ?? null;
        $category->icon = $validated['icon'] ?? null;
        $category->parent_id = $validated['parent_id'] ?? 0;
        $category->description = $validated['description'] ?? null;
        $category->is_active = $request->has('is_active');
        $category->show_on_homepage = $request->has('show_on_homepage');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        Category::where('parent_id', $category->id)->update(['parent_id' => 0]);
        
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * Show products belonging to a category for reordering.
     * 
     * @param Request $request
     * @param Category $category
     * @return View|JsonResponse
     */
    public function products(Request $request, Category $category): View|JsonResponse
    {
        if ($request->ajax()) {
            $products = $category->products()->orderBy('sort_order', 'asc');
            return $this->dataTableService->categoryProductsTable($products);
        }

        return view('admin.content.categories.products', compact('category'));
    }

    /**
     * Toggle category status (active/homepage) via AJAX.
     * 
     * @param ToggleCategoryStatusRequest $request
     * @return JsonResponse
     */
    public function toggleStatus(ToggleCategoryStatusRequest $request): JsonResponse
    {
        $category = Category::findOrFail($request->id);
        $type = $request->type;

        if ($type == 'show_on_homepage' && $request->value == 1) {
            $count = Category::where('show_on_homepage', true)->where('id', '!=', $category->id)->count();
            if ($count >= 4) {
                return response()->json([
                    'success' => false,
                    'message' => "Maximum 4 categories can be shown on the home page."
                ], 422);
            }
        }

        $category->$type = $request->value;
        $category->save();

        $label = $type == 'is_active' ? 'Status' : 'Home page status';
        $status = $request->value ? 'enabled' : 'disabled';

        return response()->json([
            'success' => true,
            'message' => "Category {$label} updated successfully!"
        ]);
    }
}
