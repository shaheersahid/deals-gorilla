<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $attributes = Attribute::with('category')->withCount('options');
            return DataTables::of($attributes)
                ->addColumn('type_badge', function ($attribute) {
                    $badges = [
                        'select' => 'primary',
                        'text' => 'info',
                        'number' => 'success',
                        'color' => 'warning',
                    ];
                    return '<span class="badge bg-' . ($badges[$attribute->type] ?? 'secondary') . '">' . ucfirst($attribute->type) . '</span>';
                })
                ->addColumn('category_name', function ($attribute) {
                    return $attribute->category ? $attribute->category->name : '<span class="text-muted">All Categories</span>';
                })
                ->addColumn('options_count', function ($attribute) {
                    return $attribute->options_count . ' options';
                })
                ->addColumn('variant', function ($attribute) {
                    return $attribute->is_variant 
                        ? '<span class="badge bg-success">Yes</span>' 
                        : '<span class="text-muted">No</span>';
                })
                ->addColumn('action', function ($attribute) {
                    return view('admin.content.attributes.action', compact('attribute'))->render();
                })
                ->rawColumns(['type_badge', 'category_name', 'variant', 'action'])
                ->make(true);
        }

        return view('admin.content.attributes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.content.attributes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:attributes,slug',
            'type' => 'required|in:select,text,number,color',
            'category_id' => 'nullable|exists:categories,id',
            'is_variant' => 'boolean',
            'is_filterable' => 'boolean',
            'is_visible' => 'boolean',
            'options' => 'nullable|array',
            'options.*.value' => 'required_with:options|string|max:255',
            'options.*.label' => 'nullable|string|max:255',
            'options.*.color_code' => 'nullable|string|max:10',
        ]);

        $attribute = Attribute::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'type' => $validated['type'],
            'category_id' => $validated['category_id'] ?? null,
            'is_variant' => $request->has('is_variant'),
            'is_filterable' => $request->has('is_filterable'),
            'is_visible' => $request->has('is_visible'),
        ]);

        // Create options
        if (!empty($validated['options'])) {
            foreach ($validated['options'] as $index => $optionData) {
                if (!empty($optionData['value'])) {
                    $attribute->options()->create([
                        'value' => $optionData['value'],
                        'label' => $optionData['label'] ?? null,
                        'color_code' => $optionData['color_code'] ?? null,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        $attribute->load('options');
        $categories = Category::where('is_active', true)->get();
        return view('admin.content.attributes.edit', compact('attribute', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:attributes,slug,' . $attribute->id,
            'type' => 'required|in:select,text,number,color',
            'category_id' => 'nullable|exists:categories,id',
            'is_variant' => 'boolean',
            'is_filterable' => 'boolean',
            'is_visible' => 'boolean',
            'options' => 'nullable|array',
        ]);

        $attribute->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'type' => $validated['type'],
            'category_id' => $validated['category_id'] ?? null,
            'is_variant' => $request->has('is_variant'),
            'is_filterable' => $request->has('is_filterable'),
            'is_visible' => $request->has('is_visible'),
        ]);

        // Update options
        $attribute->options()->delete();
        if (!empty($request->input('options'))) {
            foreach ($request->input('options') as $index => $optionData) {
                if (!empty($optionData['value'])) {
                    $attribute->options()->create([
                        'value' => $optionData['value'],
                        'label' => $optionData['label'] ?? null,
                        'color_code' => $optionData['color_code'] ?? null,
                        'sort_order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->options()->delete();
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully.');
    }
}
