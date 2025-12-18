@extends('admin.layouts.master')
@section('page-title', 'Order Details')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8">
                    <!-- Order Info -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Order #{{ $order->order_number }}</h5>
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back to Orders
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Customer:</strong> {{ $order->user?->name ?? 'Guest' }}
                                    @if($order->user)
                                        <small class="text-muted">({{ $order->user->email }})</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Order Items</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Variant</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->variant_name ?: '-' }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                        <td class="text-end">${{ number_format($item->total, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No items in this order</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                                        <td class="text-end">${{ number_format($order->subtotal, 2) }}</td>
                                    </tr>
                                    @if($order->discount_amount > 0)
                                    <tr>
                                        <td colspan="4" class="text-end text-success"><strong>Discount:</strong></td>
                                        <td class="text-end text-success">-${{ number_format($order->discount_amount, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Shipping:</strong></td>
                                        <td class="text-end">${{ number_format($order->shipping_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Tax:</strong></td>
                                        <td class="text-end">${{ number_format($order->tax_amount, 2) }}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                        <td class="text-end">${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($order->notes)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Notes</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <!-- Status Update -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Update Status</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Order Status</label>
                                    <select class="form-select" name="status">
                                        @foreach($statuses as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Payment Status</label>
                                    <select class="form-select" name="payment_status">
                                        @foreach($paymentStatuses as $value => $label)
                                            <option value="{{ $value }}" {{ $order->payment_status == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Admin Notes</label>
                                    <textarea class="form-control" name="notes" rows="3">{{ $order->notes }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-save me-1"></i> Update Order
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Payment</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                            <p class="mb-0">
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $order->payment_badge }}">{{ ucfirst($order->payment_status) }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Addresses -->
                    @if($order->shippingAddress)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            <address class="mb-0">
                                {{ $order->shippingAddress->name ?? '' }}<br>
                                {{ $order->shippingAddress->address_line_1 ?? '' }}<br>
                                @if($order->shippingAddress->address_line_2)
                                    {{ $order->shippingAddress->address_line_2 }}<br>
                                @endif
                                {{ $order->shippingAddress->city ?? '' }}, {{ $order->shippingAddress->state ?? '' }} {{ $order->shippingAddress->postal_code ?? '' }}<br>
                                {{ $order->shippingAddress->country ?? '' }}
                            </address>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
