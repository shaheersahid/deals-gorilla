<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     * 
     * @return View
     */
    public function index(): View
    {
        // 1. Total Sales (Revenue) - Sum of paid orders
        $totalSales = Order::where('payment_status', 'paid')->sum('total_amount');

        // 2. Total Orders
        $totalOrders = Order::count();

        // 3. Total Products
        $totalProducts = Product::count();

        // 4. Total Customers (Assuming role 'customer' or all users for now)
        $totalCustomers = User::where('is_admin', 0)->where('is_active',1)->count();

        // 5. Recent Orders
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // 6. Sales by Category
        $salesByCategory = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('SUM(order_items.unit_price * order_items.quantity) as total'))
            ->groupBy('categories.name')
            ->get();
            
        // 7. Monthly Sales (Last 12 months or similar)
        $monthlySales = Order::where('payment_status', 'paid')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get();

        // Extra counts for dashboard widgets
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $completedOrdersCount = Order::where('status', 'delivered')->count();

        // 8. Top Selling Products (Top 5 by quantity sold)
        $topSellingItems = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        $topSellingProducts = [];
        if($topSellingItems->isNotEmpty()) {
            $productIds = $topSellingItems->pluck('product_id')->toArray();
            $products = Product::with('images')->whereIn('id', $productIds)->get()->keyBy('id');
            
            foreach($topSellingItems as $item) {
                if(isset($products[$item->product_id])) {
                    $product = $products[$item->product_id];
                    $product->total_sold = $item->total_sold;
                    $topSellingProducts[] = $product;
                }
            }
        }

        // 9. Recent Users/Customers
        $newCustomers = User::latest()->take(5)->get();

        return view('admin.content.index', compact(
            'totalSales',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'recentOrders',
            'salesByCategory',
            'monthlySales',
            'pendingOrdersCount',
            'completedOrdersCount',
            'topSellingProducts',
            'newCustomers'
        ));
    }
}