@extends('root.layouts.app')

@section('content')
<div class="bg-gray-50 py-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <x-breadcrumb :crumbs="[['label' => 'My Wish List']]" />

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <!-- PAGE TITLE -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold">My Wish List (2)</h1>
                <a href="#" class="text-sm text-violet-600 hover:underline">
                    Continue Shopping
                </a>
            </div>

            <!-- GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- PRODUCT CARD -->
                <article class="bg-white border rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">

                    <div class="relative">
                        <img src="assets/images/product02.png"
                            class="w-full h-52 object-cover">

                        <!-- REMOVE -->
                        <button
                            class="absolute top-3 right-3 bg-white rounded-full p-2 shadow hover:bg-red-50 text-red-500">
                            ✕
                        </button>
                    </div>

                    <div class="p-4">
                        <h3 class="text-sm font-semibold leading-snug line-clamp-2">
                            Striped Men's Round Neck T-Shirt
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            Size: M • Color: Blue
                        </p>

                        <div class="mt-2 flex items-center gap-2">
                            <span class="text-violet-600 font-semibold">$15.00</span>
                            <span class="text-xs line-through text-gray-400">$20.00</span>
                        </div>

                        <div class="mt-4 space-y-2">
                            <button
                                class="w-full bg-violet-600 hover:bg-violet-700 text-white py-2 rounded-lg text-sm font-medium">
                                Move to Cart
                            </button>

                            <button
                                class="w-full border py-2 rounded-lg text-sm hover:bg-gray-50">
                                View Product
                            </button>
                        </div>
                    </div>
                </article>

                <!-- PRODUCT CARD -->
                <article class="bg-white border rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="relative">
                        <img src="assets/images/product03.png"
                            class="w-full h-52 object-cover">
                        <button
                            class="absolute top-3 right-3 bg-white rounded-full p-2 shadow hover:bg-red-50 text-red-500">
                            ✕
                        </button>
                    </div>

                    <div class="p-4">
                        <h3 class="text-sm font-semibold leading-snug line-clamp-2">
                            Casual Denim Jeans
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">Size: 32</p>

                        <div class="mt-2">
                            <span class="text-violet-600 font-semibold">$29.00</span>
                        </div>

                        <div class="mt-4 space-y-2">
                            <button class="w-full bg-violet-600 text-white py-2 rounded-lg text-sm">
                                Move to Cart
                            </button>
                            <button class="w-full border py-2 rounded-lg text-sm">
                                View Product
                            </button>
                        </div>
                    </div>
                </article>

            </div>
        </section>


        <!-- EMPTY WISHLIST STATE (IMPORTANT) -->
        <section class="max-w-xl mx-auto py-20 text-center">
            <img src="assets/images/empaty.png" class="mx-auto h-32 mb-6">

            <h2 class="text-xl font-semibold mb-2">
                Your Wish List is Empty
            </h2>

            <p class="text-gray-500 mb-6">
                Save items you love so you can find them easily later.
            </p>

            <a href="#"
                class="inline-block bg-violet-600 hover:bg-violet-700 text-white px-6 py-3 rounded-lg">
                Start Shopping
            </a>
        </section>

    </div>
</div>


@endsection