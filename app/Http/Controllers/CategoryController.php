<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::with('parent');
            return DataTables::of($categories)
                ->addColumn('parentCategory', function ($category) {
                    return $category->parent ? $category->parent->name : '<span class="text-muted">None</span>';
                })
                ->addColumn('totalProducts', function ($category) {
                    return $category->products()->count();
                })
                ->addColumn('status', function ($category) {
                    return $category->is_active 
                        ? '<span class="badge bg-success">Active</span>' 
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($category) {
                    return view('admin.content.categories.action', compact('category'))->render();
                })
                ->rawColumns(['parentCategory', 'status', 'action'])
                ->make(true);
        }

        return view('admin.content.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.content.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'title' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = $validated['slug'] ?? Str::slug($validated['name']);
        $category->title = $validated['title'] ?? null;
        $category->icon = $validated['icon'] ?? null;
        $category->parent_id = $validated['parent_id'] ?? 0;
        $category->description = $validated['description'] ?? null;
        $category->is_active = $request->has('is_active');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.content.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::where('parent_id', 0)->where('id', '!=', $category->id)->get();
        return view('admin.content.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'title' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $category->name = $validated['name'];
        $category->slug = $validated['slug'] ?? Str::slug($validated['name']);
        $category->title = $validated['title'] ?? null;
        $category->icon = $validated['icon'] ?? null;
        $category->parent_id = $validated['parent_id'] ?? 0;
        $category->description = $validated['description'] ?? null;
        $category->is_active = $request->has('is_active');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::where('parent_id', $category->id)->update(['parent_id' => 0]);
        
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
