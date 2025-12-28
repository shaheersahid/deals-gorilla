@extends('root.layouts.app')

@section('content')
<div class="bg-gray-50 py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <x-breadcrumb :crumbs="[['label' => 'Checkout']]" />
        
        <!-- PAGE WRAPPER -->
        <div class="max-w-7xl mx-auto px-4 py-10">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT : SHIPPING + PAYMENT -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- SHIPPING INFO -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-lg font-semibold mb-4">Shipping Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" placeholder="First Name" class="input">
                            <input type="text" placeholder="Last Name" class="input">
                            <input type="email" placeholder="Email Address" class="input md:col-span-2">
                            <input type="text" placeholder="Phone Number" class="input md:col-span-2">
                            <input type="text" placeholder="Street Address" class="input md:col-span-2">
                            <input type="text" placeholder="City" class="input">
                            <input type="text" placeholder="State" class="input">
                            <input type="text" placeholder="Zip Code" class="input">
                            <input type="text" placeholder="Country" class="input">
                        </div>
                    </div>

                    <!-- PAYMENT -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-lg font-semibold mb-4">Payment Method</h2>

                        <div class="space-y-4">

                            <label class="flex items-center gap-3 p-4 border rounded cursor-pointer">
                                <input type="radio" name="payment" checked>
                                <span>💵 Cash on Delivery</span>
                            </label>

                            <label class="flex items-center gap-3 p-4 border rounded cursor-pointer">
                                <input type="radio" name="payment">
                                <span>💳 Credit / Debit Card</span>
                            </label>

                            <label class="flex items-center gap-3 p-4 border rounded cursor-pointer">
                                <input type="radio" name="payment">
                                <span>📱 Wallet / EasyPaisa / JazzCash</span>
                            </label>

                        </div>
                    </div>

                </div>

                <!-- RIGHT : ORDER SUMMARY -->
                <div class="bg-white p-6 rounded-lg shadow-sm h-fit">

                    <h2 class="text-lg font-semibold mb-4">Order Summary</h2>

                    <!-- ITEM -->
                    <div class="flex items-center gap-4 mb-4">
                        <img src="assets/images/product.png" class="w-16 h-16 rounded object-cover">
                        <div class="flex-1">
                            <div class="text-sm font-medium">Men Casual T-Shirt</div>
                            <div class="text-xs text-gray-500">Qty: 1</div>
                        </div>
                        <div class="font-semibold">$25.00</div>
                    </div>

                    <!-- ITEM -->
                    <div class="flex items-center gap-4 mb-4">
                        <img src="assets/images/product02.png" class="w-16 h-16 rounded object-cover">
                        <div class="flex-1">
                            <div class="text-sm font-medium">Casual Shoes</div>
                            <div class="text-xs text-gray-500">Qty: 1</div>
                        </div>
                        <div class="font-semibold">$45.00</div>
                    </div>

                    <hr class="my-4">

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>$70.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>$5.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax</span>
                            <span>$2.00</span>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span>$77.00</span>
                    </div>

                    <button class="w-full mt-6 bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-lg font-semibold">
                        Place Order
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-3">
                        By placing your order, you agree to our Terms & Privacy Policy
                    </p>

                </div>

            </div>
        </div>

    </div>
</div>


@endsection