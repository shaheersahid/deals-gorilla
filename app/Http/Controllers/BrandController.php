<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\DataTableService;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
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
            $brands = Brand::query();
            return $this->dataTableService->brandsTable($brands);
        }

        return view('admin.content.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return View
     */
    public function create(): View
    {
        return view('admin.content.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreBrandRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBrandRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $brand = new Brand();
        $brand->name = $validated['name'];
        $brand->slug = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $brand->logo = $request->file('logo')->store('brands', 'public');
        }

        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param Brand $brand
     * @return View
     */
    public function show(Brand $brand): View
    {
        return view('admin.content.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Brand $brand
     * @return View
     */
    public function edit(Brand $brand): View
    {
        return view('admin.content.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateBrandRequest $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validated();

        $brand->name = $validated['name'];
        $brand->slug = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            if ($brand->logo && \Storage::disk('public')->exists($brand->logo)) {
                \Storage::disk('public')->delete($brand->logo);
            }
            $brand->logo = $request->file('logo')->store('brands', 'public');
        }

        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        // Delete logo if exists
        if ($brand->logo && \Storage::disk('public')->exists($brand->logo)) {
            \Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}