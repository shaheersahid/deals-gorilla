<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
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
            $orders = Order::with('user');
            return $this->dataTableService->ordersTable($orders);
        }

        return view('admin.content.orders.index');
    }

    /**
     * Display the specified resource.
     * 
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        $order->load(['user', 'items.product', 'items.variant', 'shippingAddress', 'billingAddress']);
        $statuses = Order::getStatuses();
        $paymentStatuses = Order::getPaymentStatuses();
        
        return view('admin.content.orders.show', compact('order', 'statuses', 'paymentStatuses'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
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
     * 
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
