@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-violet-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 font-medium text-gray-700 md:ml-2">Cart</span>
                    </div>
                </li>
            </ol>
        </nav>

        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Shopping Cart</h1>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <!-- Cart Items -->
            <section class="lg:col-span-8">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <ul role="list" class="divide-y divide-gray-200">
                        <!-- Item 1 -->
                        <li class="p-6 sm:flex sm:items-center sm:justify-between">
                            <div class="flex items-center sm:flex-1">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/product001.Png') }}" alt="PlayStation 5" class="w-24 h-24 rounded-md object-cover object-center sm:w-32 sm:h-32 bg-gray-100">
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-900 text-lg">
                                                <a href="#">PlayStation 5</a>
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500">Black/White</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center justify-between sm:block">
                                        <div class="flex items-center border border-gray-300 rounded-md w-max">
                                            <button type="button" class="p-2 text-gray-600 hover:bg-gray-50 rounded-l-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                            </button>
                                            <span class="px-4 py-1 text-gray-900 font-medium text-sm">1</span>
                                            <button type="button" class="p-2 text-gray-600 hover:bg-gray-50 rounded-r-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-6 flex flex-col items-end space-y-4">
                                <p class="text-xl font-bold text-gray-900">$499.00</p>
                                <button type="button" class="text-sm font-medium text-red-500 hover:text-red-700 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Remove
                                </button>
                            </div>
                        </li>

                        <!-- Item 2 -->
                        <li class="p-6 sm:flex sm:items-center sm:justify-between">
                            <div class="flex items-center sm:flex-1">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/product002.Png') }}" alt="Skincare Set" class="w-24 h-24 rounded-md object-cover object-center sm:w-32 sm:h-32 bg-gray-100">
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-900 text-lg">
                                                <a href="#">Premium Skincare Set</a>
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500">5-Piece Kit</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center justify-between sm:block">
                                        <div class="flex items-center border border-gray-300 rounded-md w-max">
                                            <button type="button" class="p-2 text-gray-600 hover:bg-gray-50 rounded-l-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                            </button>
                                            <span class="px-4 py-1 text-gray-900 font-medium text-sm">2</span>
                                            <button type="button" class="p-2 text-gray-600 hover:bg-gray-50 rounded-r-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-6 flex flex-col items-end space-y-4">
                                <p class="text-xl font-bold text-gray-900">$89.00</p>
                                <button type="button" class="text-sm font-medium text-red-500 hover:text-red-700 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Remove
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Order Summary -->
            <section class="lg:col-span-4 mt-8 lg:mt-0">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Order Summary</h2>

                    <div class="flow-root">
                        <dl class="-my-4 text-sm divide-y divide-gray-200">
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Subtotal</dt>
                                <dd class="font-medium text-gray-900">$588.00</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Shipping</dt>
                                <dd class="font-medium text-green-600">Free</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Tax Estimate</dt>
                                <dd class="font-medium text-gray-900">$47.04</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-bold text-gray-900">Order Total</dt>
                                <dd class="text-xl font-bold text-violet-600">$635.04</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Coupon Code -->
                    <div class="mt-8">
                        <label for="coupon-code" class="block text-sm font-medium text-gray-700">Coupon Code</label>
                        <div class="mt-2 flex space-x-2">
                             <input type="text" id="coupon-code" name="coupon-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 sm:text-sm p-2 border" placeholder="Enter code">
                             <button type="button" class="bg-gray-100 text-gray-900 hover:bg-gray-200 px-4 py-2 border border-transparent rounded-md text-sm font-medium transition-colors">Apply</button>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="button" class="w-full bg-violet-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Proceed to Checkout
                        </button>
                    </div>
                    
                    <div class="mt-6 text-center text-sm">
                        <p class="text-gray-500">
                            or <a href="/" class="font-medium text-violet-600 hover:text-violet-500">Continue Shopping<span aria-hidden="true"> &rarr;</span></a>
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
