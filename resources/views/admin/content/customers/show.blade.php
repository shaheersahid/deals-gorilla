@extends('admin.layouts.master')
@section('page-title', 'Customer Detail')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h4 class="mb-1">{{ $customer->name ?? trim($customer->first_name . ' ' . $customer->last_name) }}
                        </h4>
                        <p class="text-muted mb-0">Joined {{ optional($customer->created_at)->format('d M Y') }}</p>
                    </div>
                    <a href="{{ route('customers.index') }}" class="btn btn-light">
                        <i class="fa fa-arrow-left me-1"></i> Back to Customers
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Customer Info</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><span class="text-muted">Email:</span> {{ $customer->email ?? '—' }}</p>
                            <p class="mb-2"><span class="text-muted">Phone:</span> {{ $customer->phone ?? '—' }}</p>
                            <p class="mb-2"><span class="text-muted">Address:</span> {{ $customer->address_1 ?? '—' }}</p>
                            <p class="mb-0"><span class="text-muted">City:</span> {{ $customer->city ?? '—' }}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Stats</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2 d-flex justify-content-between">
                                <span>Total orders</span>
                                <strong>{{ number_format($stats['total_orders']) }}</strong>
                            </p>
                            <p class="mb-2 d-flex justify-content-between">
                                <span>Total spent</span>
                                <strong>Rs. {{ number_format((float) $stats['total_spent'], 2) }}</strong>
                            </p>
                            <p class="mb-2 d-flex justify-content-between">
                                <span>Avg. order value</span>
                                <strong>Rs. {{ number_format((float) $stats['average_order_value'], 2) }}</strong>
                            </p>
                            <p class="mb-0 d-flex justify-content-between">
                                <span>Last order</span>
                                <strong>{{ optional($stats['last_order_at'])->diffForHumans() ?? '—' }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Orders</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Order #</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Items</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ optional($order->created_at)->format('d M Y, h:i A') }}</td>
                                                <td>{{ \App\Models\Order::statusLabel($order->status) }}</td>
                                                <td>Rs. {{ number_format((float) $order->total_amount, 2) }}</td>
                                                <td>{{ $order->orderItems->sum('quantity') }}</td>
                                                <td>
                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">No orders found for
                                                    this customer.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

