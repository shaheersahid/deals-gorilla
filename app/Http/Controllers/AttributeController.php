<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;

class AttributeController extends Controller
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
            $attributes = Attribute::with('category')->withCount('options');
            return $this->dataTableService->attributesTable($attributes);
        }

        return view('admin.content.attributes.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.content.attributes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreAttributeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAttributeRequest $request): RedirectResponse
    {
        $validated = $request->validated();

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
     * 
     * @param Attribute $attribute
     * @return View
     */
    public function edit(Attribute $attribute): View
    {
        $attribute->load('options');
        $categories = Category::where('is_active', true)->get();
        return view('admin.content.attributes.edit', compact('attribute', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateAttributeRequest $request
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute): RedirectResponse
    {
        $validated = $request->validated();

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
     * 
     * @param Attribute $attribute
     * @return RedirectResponse
     */
    public function destroy(Attribute $attribute): RedirectResponse
    {
        $attribute->options()->delete();
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully.');
    }
}
