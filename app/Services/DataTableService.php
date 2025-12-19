<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class DataTableService
{
    /**
     * Configuration for Products DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function productsTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
            ->editColumn('name', function ($product) {
                $imageUrl = $product->images->where('is_primary', true)->first()?->url
                    ?? ($product->images->first()?->url ?? asset('admin/assets/images/no-image.png'));
                $image = '<img src="' . $imageUrl . '" alt="' . $product->name . '" class="img-thumbnail me-2" style="width: 50px; height: 50px; object-fit: cover;">';
                
                return '<div class="d-flex align-items-center">' . $image . '<div><a href="' . route('products.edit', $product->id) . '" class="fw-bold">' . $product->name . '</a><br><small class="text-muted">' . $product->sku . '</small></div></div>';
            })
            ->addColumn('brand_name', function ($product) {
                if ($product->brands->count() > 0) {
                    return $product->brands->map(function($brand) {
                        return '<span class="badge bg-light text-dark border">' . $brand->name . '</span>';
                    })->implode(' ');
                }
                return '<span class="text-muted">N/A</span>';
            })
            ->addColumn('category_name', function ($product) {
                return $product->category ? '<span class="badge bg-info bg-opacity-10 text-info">' . $product->category->name . '</span>' : '<span class="text-muted">N/A</span>';
            })
            ->addColumn('price_display', function ($product) {
                if ($product->has_variants) {
                    $minPrice = $product->variants->min('price');
                    $maxPrice = $product->variants->max('price');
                    $priceStr = format_price($minPrice);
                    if ($minPrice != $maxPrice) {
                        $priceStr .= ' - ' . format_price($maxPrice);
                    }
                    return '<div><span class="badge bg-soft-primary text-primary mb-1">Variants</span><br>' . $priceStr . '</div>';
                }
                if ($product->deal_enabled && $product->deal_price) {
                    return '<div><span class="text-decoration-line-through text-muted small">' . format_price($product->price) . '</span><br>' .
                           '<span class="text-danger fw-bold">' . format_price($product->deal_price) . '</span></div>';
                }
                return '<span class="fw-bold">' . format_price($product->price) . '</span>';
            })
            ->addColumn('stock_display', function ($product) {
                $stock = $product->stock;
                $class = $stock > 10 ? 'success' : ($stock > 0 ? 'warning' : 'danger');
                $label = $stock > 0 ? $stock : 'Out of Stock';
                return '<span class="badge bg-' . $class . '">' . $label . '</span>';
            })
            ->addColumn('deal', function ($product) {
                if ($product->deal_enabled) {
                    return '<div class="text-center"><span class="badge bg-success">ON</span><br><small class="text-success fw-bold">' . round($product->percentage_off) . '% OFF</small></div>';
                }
                return '<span class="badge bg-light text-muted">OFF</span>';
            })
            ->addColumn('status', function ($product) {
                $checked = $product->is_active ? 'checked' : '';
                return '<div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input toggle-status" type="checkbox" data-id="' . $product->id . '" data-type="is_active" ' . $checked . '>
                        </div>';
            })
            ->addColumn('featured', function ($product) {
                $checked = $product->is_featured ? 'checked' : '';
                return '<div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input toggle-status" type="checkbox" data-id="' . $product->id . '" data-type="is_featured" ' . $checked . '>
                        </div>';
            })
            ->addColumn('action', function ($product) {
                return view('admin.content.products.action', compact('product'))->render();
            })
            ->rawColumns(['name', 'price_display', 'stock_display', 'deal', 'status', 'featured', 'action', 'brand_name', 'category_name'])
            ->make(true);
    }

    /**
     * Configuration for Categories DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoriesTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
            ->addColumn('parentCategory', function ($category) {
                return $category->parent ? $category->parent->name : '<span class="text-muted">None</span>';
            })
            ->addColumn('totalProducts', function ($category) {
                return $category->products()->count();
            })
            ->addColumn('status', function ($category) {
                $checked = $category->is_active ? 'checked' : '';
                return '<div class="form-check form-switch d-flex justify-content-center" style="min-height: auto;">
                            <input class="form-check-input toggle-status" type="checkbox" data-id="' . $category->id . '" data-type="is_active" ' . $checked . ' style="cursor: pointer;">
                        </div>';
            })
            ->addColumn('homepage', function ($category) {
                $checked = $category->show_on_homepage ? 'checked' : '';
                return '<div class="form-check form-switch d-flex justify-content-center" style="min-height: auto;">
                            <input class="form-check-input toggle-status" type="checkbox" data-id="' . $category->id . '" data-type="show_on_homepage" ' . $checked . ' style="cursor: pointer;">
                        </div>';
            })
            ->addColumn('action', function ($category) {
                return view('admin.content.categories.action', compact('category'))->render();
            })
            ->rawColumns(['parentCategory', 'status', 'homepage', 'action'])
            ->make(true);
    }

    /**
     * Configuration for Category Products (reorder) DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryProductsTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
            ->addColumn('image', function ($product) {
                $imageUrl = $product->images->where('is_primary', true)->first()?->url
                    ?? ($product->images->first()?->url ?? asset('admin/assets/images/no-image.png'));
                return '<img src="' . $imageUrl . '" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">';
            })
            ->addColumn('details', function ($product) {
                return '<strong>' . $product->name . '</strong><br><small class="text-muted">' . $product->sku . '</small>';
            })
            ->addColumn('id', function ($product) {
                return $product->id;
            })
            ->setRowId('id')
            ->rawColumns(['image', 'details'])
            ->make(true);
    }

    /**
     * Configuration for Orders DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function ordersTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
            ->addColumn('customer', function ($order) {
                return $order->user ? $order->user->name : '<span class="text-muted">Guest</span>';
            })
            ->addColumn('total', function ($order) {
                return '$' . number_format($order->total_amount, 2);
            })
            ->addColumn('order_status', function ($order) {
                return '<span class="badge bg-' . $order->status_badge . '">' . ucfirst($order->status) . '</span>';
            })
            ->addColumn('payment', function ($order) {
                return '<span class="badge bg-' . $order->payment_badge . '">' . ucfirst($order->payment_status) . '</span>';
            })
            ->addColumn('date', function ($order) {
                return $order->created_at->format('M d, Y H:i');
            })
            ->addColumn('action', function ($order) {
                return view('admin.content.orders.action', compact('order'))->render();
            })
            ->rawColumns(['customer', 'order_status', 'payment', 'action'])
            ->make(true);
    }

    /**
     * Configuration for Brands DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function brandsTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
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

    /**
     * Configuration for Attributes DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function attributesTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
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

    /**
     * Configuration for Customers DataTable.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function customersTable($query): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
            ->addColumn('status', function ($user) {
                return $user->is_active 
                    ? '<span class="badge bg-success">Active</span>' 
                    : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('created', function ($user) {
                return $user->created_at->format('M d, Y');
            })
            ->addColumn('action', function ($user) {
                return view('admin.content.customers.action', compact('user'))->render();
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
