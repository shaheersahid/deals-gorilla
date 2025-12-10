<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with('user');
            return DataTables::of($orders)
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

        return view('admin.content.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'items.variant', 'shippingAddress', 'billingAddress']);
        $statuses = Order::getStatuses();
        $paymentStatuses = Order::getPaymentStatuses();
        
        return view('admin.content.orders.show', compact('order', 'statuses', 'paymentStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,refunded',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $order->status = $validated['status'];
        $order->payment_status = $validated['payment_status'];
        $order->notes = $validated['notes'] ?? $order->notes;
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
