<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brands = Brand::query();
            return DataTables::of($brands)
                ->addColumn('logo_preview', function ($brand) {
                    if ($brand->logo) {
                        return '<img src="' . asset('storage/' . $brand->logo) . '" alt="' . $brand->name . '" style="height: 40px;">';
                    }
                    return '<span class="text-muted">No logo</span>';
                })
                ->addColumn('action', function ($brand) {
                    return view('admin.content.brands.action', compact('brand'))->render();
                })
                ->rawColumns(['logo_preview', 'action'])
                ->make(true);
        }

        return view('admin.content.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

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
     */
    public function show(Brand $brand)
    {
        return view('admin.content.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.content.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'slug' => 'nullable|string|max:255|unique:brands,slug,' . $brand->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

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
     */
    public function destroy(Brand $brand)
    {
        // Delete logo if exists
        if ($brand->logo && \Storage::disk('public')->exists($brand->logo)) {
            \Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
