@extends('root.layouts.app')
@section('content')

<div class="bg-white py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumb :crumbs="[['label' => 'Product']]" />
    </div>
</div>

<main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex items-center gap-3 mb-3 lg:mb-0">
                <div class="flex items-center gap-2">
                    <button id="gridBtn" aria-pressed="true" class="p-2 border rounded text-slate-700 bg-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg></button>
                    <button id="listBtn" class="p-2 border rounded text-slate-600 bg-white/90"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                        </svg></button>
                    <button id="mobileFiltersBtn" class="lg:hidden ml-2 text-sm text-violet-700 underline">Filters</button>
                </div>

                <div class="text-sm text-slate-600 pl-3 border-l border-slate-200">There are <span class="font-semibold text-slate-800">24</span> products.</div>
            </div>
            <div class="flex items-center gap-3">
                <label for="sort" class="text-sm text-slate-600 hidden sm:inline">Sort by:</label>
                <select id="sort" class="text-sm border rounded px-3 py-2 bg-white">
                    <option>Relevance</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest</option>
                </select>
            </div>
        </div>
    </div>

    <div class="lg:flex lg:gap-8">
        <aside id="filters" class="hidden lg:block w-72 shrink-0">
            <div class="bg-white p-4 rounded card-border">
                <h4 class="text-sm font-semibold mb-3">Categories</h4>
                <ul class="space-y-2 text-sm text-slate-700">
                    <li><label class="flex items-center gap-2"><input type="checkbox" class="custom-checkbox" /> Camera Lenses <span class="ml-auto text-xs text-slate-500">(8)</span></label></li>
                    <li><label class="flex items-center gap-2"><input type="checkbox" class="custom-checkbox" /> Monitors <span class="ml-auto text-xs text-slate-500">(12)</span></label></li>
                    <li><label class="flex items-center gap-2"><input type="checkbox" class="custom-checkbox" /> Projectors <span class="ml-auto text-xs text-slate-500">(16)</span></label></li>
                    <li><label class="flex items-center gap-2"><input type="checkbox" class="custom-checkbox" /> VR Headset <span class="ml-auto text-xs text-slate-500">(13)</span></label></li>
                </ul>

                <hr class="my-4 border-slate-100">

                <h4 class="text-sm font-semibold mb-3">Price</h4>
                <div class="text-sm text-slate-600 mb-3">$16.00 - $260.00</div>
                <input type="range" min="0" max="100" value="30" class="w-full">

                <hr class="my-4 border-slate-100">

                <h4 class="text-sm font-semibold mb-3">Color</h4>
                <div class="grid grid-cols-4 gap-2">
                    <button class="w-7 h-7 rounded-full bg-black border"></button>
                    <button class="w-7 h-7 rounded-full bg-blue-600 border"></button>
                    <button class="w-7 h-7 rounded-full bg-slate-400 border"></button>
                    <button class="w-7 h-7 rounded-full bg-green-500 border"></button>
                </div>

                <hr class="my-4 border-slate-100">

                <h4 class="text-sm font-semibold mb-3">Selections</h4>
                <ul class="space-y-2 text-sm text-slate-700">
                    <li><label class="flex items-center gap-2"><input type="checkbox" class="custom-checkbox" /> Projectors <span class="ml-auto text-xs text-slate-500">(16)</span></label></li>
                    <li><label class="flex items-center gap-2"><input type="checkbox" class="custom-checkbox" /> VR Headset <span class="ml-auto text-xs text-slate-500">(13)</span></label></li>
                </ul>
            </div>
        </aside>

        <div id="mobileFilters" class="fixed inset-0 z-40 hidden">
            <div id="mobileFiltersBackdrop" class="absolute inset-0 bg-black/40"></div>
            <div class="absolute left-0 top-0 bottom-0 w-80 bg-white p-4 overflow-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold">Filters</h3>
                    <button id="mobileFiltersClose" class="text-slate-600">Close</button>
                </div>
                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-semibold mb-2">Categories</h4>
                        <label class="flex items-center gap-2"><input type="checkbox" /> Camera Lenses</label>
                        <label class="flex items-center gap-2"><input type="checkbox" /> Monitors</label>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold mb-2">Price</h4>
                        <input type="range" min="0" max="100" value="30" class="w-full">
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold mb-2">Selections</h4>
                        <label class="flex items-center gap-2"><input type="checkbox" /> Discounted</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUCT main -->

        <!-- PRODUCTS -->
        <section class="w-full px-4 pb-10">

            <div id="productGrid"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
                <!-- PRODUCT CARD -->
                <article
                    class="product-card flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden p-4">

                    <!-- Badge -->
                    <span
                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                        NEW
                    </span>

                    <!-- Icons -->
                    <div class="card-icons absolute top-3 right-3 flex flex-col gap-2 z-20">
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            ❤️
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            👁
                        </a>
                        <a href="#"
                            class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm">
                            🛒
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="product-image w-full h-48 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/images/new_01.png') }}"
                            class="object-contain max-h-full">
                    </div>

                    <!-- Content -->
                    <div class="product-content flex flex-col flex-1">
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>

                        <h3 class="text-sm font-medium text-slate-800 leading-snug mb-2">
                            New Featured MacBook Pro With Apple M1 Pro Chip
                        </h3>

                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">★★★★★</span>
                            <span class="text-xs text-slate-400">(3)</span>
                        </div>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-lg font-bold text-slate-900">$200.00</span>
                            <span class="text-xs text-green-600 font-medium">In Stock</span>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <a href="#"
                        class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                        Add To Cart
                    </a>
                </article>
            </div>

        </section>
    </div>
</main>
@endsection