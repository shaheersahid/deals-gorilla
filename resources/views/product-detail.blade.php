@extends('layouts.app')
@section('content')

<!-- Breadcrumb Section -->
<section class="w-full bg-white py-4 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm text-gray-400">
            <a href="#" class="hover:text-gray-600">Home</a>
            <span class="mx-1">></span>
            <span class="text-gray-500">Product Detail Page</span>
        </nav>
    </div>
</section>

<main class="max-w-7xl mx-auto p-6">
    <!--  products Detail Start-->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-7">
            <div class="flex gap-6">
                <div class="flex-1 relative bg-white rounded shadow overflow-hidden">
                    <img id="product-main-img" src="assets/images/details_1.jpg" alt="Main product"
                        class="w-full h-[480px] object-cover bg-gray-200" />
                    <button id="imgPrev"
                        class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow"
                        aria-label="Previous image">‹</button>
                    <button id="imgNext"
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow"
                        aria-label="Next image">›</button>
                </div>
                <div class="flex flex-col items-center">
                    <div id="product-thumbs" class="w-20 bg-white rounded p-2 border" tabindex="0"
                        aria-label="Product thumbnails">
                        <div class="thumb mb-2 p-1 rounded cursor-pointer" data-index="0"
                            data-large="assets/images/details_1.jpg">
                            <img src="assets/images/details_1.jpg" alt="thumb1" class="w-full h-auto rounded" />
                        </div>
                        <div class="thumb mb-2 p-1 rounded cursor-pointer" data-index="1"
                            data-large="assets/images/details_4.jpg">
                            <img src="assets/images/details_4.jpg" alt="thumb2" class="w-full h-auto rounded" />
                        </div>
                        <div class="thumb mb-2 p-1 rounded cursor-pointer" data-index="2"
                            data-large="assets/images/details_2.jpg">
                            <img src="assets/images/details_2.jpg" alt="thumb3" class="w-full h-auto rounded" />
                        </div>
                        <div class="thumb mb-2 p-1 rounded cursor-pointer" data-index="3"
                            data-large="assets/images/details_3.jpg">
                            <img src="assets/images/details_3.jpg" alt="thumb4" class="w-full h-auto rounded" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="bg-white p-6 rounded shadow">
                <div class="flex items-center gap-3 mb-3">
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded text-xs">In Stock</span>
                    <button class="ml-auto p-2 rounded hover:bg-gray-100" aria-label="Add to wishlist">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M12 21s-6-4.35-9-7.2C1.5 11.15 4 6 8 6c2 0 3.5 1.5 4 2.4C12.5 7.5 14 6 16 6c4 0 6.5 5.15 5 7.8C18 16.65 12 21 12 21z"
                                stroke="#333" stroke-width="1" />
                        </svg>
                    </button>
                </div>

                <h1 class="text-2xl font-bold mb-2">The best is yet to come' Framed poster</h1>
                <div class="flex items-center gap-3 mb-4">
                    <div class="text-2xl"><del>$250.00</del></div>
                    <div class="text-2xl font-extrabold">$150.00</div>
                    <div class="text-sm text-yellow-500">★★★★★</div>
                    <div class="text-sm text-gray-500">(5 Reviews)</div>
                </div>

                <ul class="text-sm text-gray-600 list-disc list-inside space-y-1 mb-6">
                    <li>Advanced features to meet both casual</li>
                    <li>Quick setup installation with detailed instructions</li>
                    <li>Premium sound and video playback quality</li>
                </ul>

                <div class="mb-4">
                    <div class="text-sm text-gray-800 mb-2">Texture:</div>
                    <div class="flex items-center gap-2">
                        <button class="p-1 border rounded" aria-label="texture 1"><img src="assets/images/details.Png"
                                alt="tex1" width="40" /></button>
                        <button class="p-1 border rounded" aria-label="texture 2"><img src="assets/images/detail.Png"
                                alt="tex2" width="40" /></button>
                        <button class="p-1 border rounded" aria-label="texture 3"><img src="assets/images/details.Png"
                                alt="tex3" width="40" /></button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="text-sm text-gray-800 block mb-2">Size:</label>
                    <div class="flex items-center gap-3">
                        <button class="px-3 py-2 border rounded bg-white" aria-pressed="true">55</button>
                        <button class="px-3 py-2 border rounded bg-white">65</button>
                    </div>
                </div>

                <div class="flex gap-3 items-center mb-4">
                    <div class="flex items-center border rounded overflow-hidden">
                        <button class="px-3 py-2" id="decQty" aria-label="Decrease quantity">-</button>
                        <input id="qty" class="w-12 text-center" value="1" aria-label="Quantity" />
                        <button class="px-3 py-2" id="incQty" aria-label="Increase quantity">+</button>
                    </div>

                    <button class="flex-1 bg-violet-700 text-white px-4 py-3 rounded">ADD TO CART</button>
                </div>

                <button class="w-full bg-black text-white px-4 py-3 rounded">BUY NOW</button>
            </div>
        </div>
    </div>

    <!-- Card container -->
    <div class="bg-white rounded border panel-border">
        <!-- Tabs header -->
        <div class="border-b">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-center gap-6 h-14">
                    <nav id="productTabs" class="flex gap-4" role="tablist" aria-label="Product sections">
                        <button id="tab-desc" role="tab" aria-selected="true" aria-controls="panel-desc"
                            class="text-sm px-4 py-3 rounded-t-md font-medium focus:outline-none">
                            Description
                        </button>

                        <button id="tab-details" role="tab" aria-selected="false" aria-controls="panel-details"
                            class="text-sm px-4 py-3 rounded-t-md font-medium tab-active focus:outline-none">
                            Product Details
                        </button>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Tab panels -->
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div id="panel-desc" role="tabpanel" aria-labelledby="tab-desc" class="tab-panel hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-sm text-gray-700">
                        <p class="mb-4">Reference HDF-GHD-546<br />Condition: Refurbished<br />In stock: 150 items</p>
                        <h4 class="text-base font-semibold mb-2">Overview</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">This framed poster celebrates modern design with premium
                            print quality. A perfect decorative piece for living rooms, bedrooms or offices.</p>
                    </div>

                    <div class="text-sm text-gray-700">
                        <h4 class="text-base font-semibold mb-2">Shipping & Returns</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">Ships in 1–2 business days. Returns accepted within 30
                            days of delivery (some restrictions apply).</p>
                    </div>
                </div>
            </div>

            <div id="panel-details" role="tabpanel" aria-labelledby="tab-details" class="tab-panel">
                <div class="mb-4 text-sm text-gray-600">
                    <p class="mb-2">Reference HDF-GHD-546<br />Condition Refurbished<br />In stock 150 Items</p>
                </div>

                <h5 class="text-sm font-semibold mb-4">Data Sheet</h5>
                <div class="bg-white border rounded p-4">
                    <div class="grid gap-3 grid-cols-1 md:grid-cols-2">
                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Composition</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">Matt paper</div>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Property</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">Stone</div>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Item Model Number</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">LOG-QLE055GXPUA</div>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Product Dimensions</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">30cm x 15cm x 20cm (L x W x H)</div>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Box Weight</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">1.2 kg</div>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Container Type</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">Hard Plastic Case</div>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="detail-left text-sm text-gray-600">Model Year</div>
                            <div class="flex-1">
                                <div class="data-pill text-sm text-gray-700">2025</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="block md:block lg:flex lg:items-center lg:justify-between mb-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold">You might also like</h2>
            </div>
            <!-- Countdown -->
            <div class="flex items-center gap-3">
                <!-- arrows -->
                <div class="flex items-center gap-2 ml-4">
                    <button id="flash-prev" aria-label="Previous" class="swiper-button-next-sub  w-9 h-9 bg-white border rounded-full shadow hover:scale-105 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="flash-next" aria-label="Next" class="swiper-button-prev-sub w-9 h-9 bg-white border rounded-full shadow hover:scale-105 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products carousel -->
        <section class="relative max-w-7xl mx-auto px-4 py-10">
            <!-- Swiper -->
            <div class="swiper subproducts-swiper">
                <div class="swiper-wrapper">
                    <!-- PRODUCT 1 -->
                    <div class="swiper-slide">
                        <article
                            class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">

                            <!-- badge -->
                            <span
                                class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>

                            <!-- icons -->
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
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

                            <!-- image -->
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full">
                            </div>

                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 mb-2">
                                New Featured MacBook Pro With Apple M1 Pro Chip
                            </h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- add to cart -->
                            <a href="#"
                                class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                                Add To Cart
                            </a>
                        </article>
                    </div>
                    <!-- PRODUCT 2 -->
                    <div class="swiper-slide">
                        <article
                            class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">

                            <!-- badge -->
                            <span
                                class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>

                            <!-- icons -->
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
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

                            <!-- image -->
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full">
                            </div>

                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 mb-2">
                                New Featured MacBook Pro With Apple M1 Pro Chip
                            </h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- add to cart -->
                            <a href="#"
                                class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                                Add To Cart
                            </a>
                        </article>
                    </div>
                    <!-- PRODUCT 3 -->
                    <div class="swiper-slide">
                        <article
                            class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">

                            <!-- badge -->
                            <span
                                class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>

                            <!-- icons -->
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
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

                            <!-- image -->
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full">
                            </div>

                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 mb-2">
                                New Featured MacBook Pro With Apple M1 Pro Chip
                            </h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- add to cart -->
                            <a href="#"
                                class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                                Add To Cart
                            </a>
                        </article>
                    </div>
                    <!-- PRODUCT 4 -->
                    <div class="swiper-slide">
                        <article
                            class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">

                            <!-- badge -->
                            <span
                                class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>

                            <!-- icons -->
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
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

                            <!-- image -->
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full">
                            </div>

                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 mb-2">
                                New Featured MacBook Pro With Apple M1 Pro Chip
                            </h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- add to cart -->
                            <a href="#"
                                class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                                Add To Cart
                            </a>
                        </article>
                    </div>
                    <!-- PRODUCT 5 -->
                    <div class="swiper-slide">
                        <article
                            class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">

                            <!-- badge -->
                            <span
                                class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>

                            <!-- icons -->
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
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

                            <!-- image -->
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full">
                            </div>

                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 mb-2">
                                New Featured MacBook Pro With Apple M1 Pro Chip
                            </h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- add to cart -->
                            <a href="#"
                                class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                                Add To Cart
                            </a>
                        </article>
                    </div>
                    <!-- PRODUCT 6 -->
                    <div class="swiper-slide">
                        <article
                            class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px] p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">

                            <!-- badge -->
                            <span
                                class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>

                            <!-- icons -->
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
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

                            <!-- image -->
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full">
                            </div>

                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 mb-2">
                                New Featured MacBook Pro With Apple M1 Pro Chip
                            </h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- add to cart -->
                            <a href="#"
                                class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4">
                                Add To Cart
                            </a>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Reviews Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <aside class="md:col-span-1 flex flex-col items-start">
                <h2 class="text-lg font-semibold mb-6">Reviews</h2>

                <div class="w-full bg-white p-6 rounded border">
                    <div class="text-sm text-slate-500 mb-2">Overall Rating</div>

                    <div class="flex items-center gap-6">
                        <div class="text-4xl md:text-5xl font-extrabold">4.3<span class="text-base font-medium text-slate-500">/ 5</span></div>
                        <div>
                            <div class="flex items-center gap-1 mb-1" aria-hidden="true">
                                <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                                <svg class="w-5 h-5 text-slate-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                            </div>

                            <div class="text-sm text-slate-500">based on <span class="font-medium text-slate-700">9,647</span> reviews</div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="md:col-span-2">
                <div class="flex items-center justify-between mb-6 gap-4">
                    <div class="text-sm text-slate-500">Sort by</div>

                    <div class="flex items-center gap-3 ml-auto">
                        <div>
                            <select class="border rounded px-3 py-2 text-sm bg-white">
                                <option>Recommended</option>
                                <option>Latest</option>
                                <option>Highest rating</option>
                            </select>
                        </div>

                        <button class="border rounded px-3 py-2 text-sm bg-white flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M10 6h10M10 12h6M10 18h2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
                <div class="space-y-6">
                    <article class="pb-6">
                        <header class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-sm font-semibold">Preetam – New Zealand</h3>
                                <div class="text-xs text-slate-400">October 1, 2025 · Verified Booking</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center text-yellow-400">
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-slate-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                </div>
                            </div>
                        </header>

                        <div class="mt-3 text-sm text-slate-700">
                            Efficient and prompt. The directions were easy and clear.
                        </div>

                        <div class="mt-4 border-t pt-4 text-xs text-slate-400">
                            Verified user · Helpful: 12
                        </div>
                    </article>

                    <article class="pb-6">
                        <header class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-sm font-semibold">Aisha – Canada</h3>
                                <div class="text-xs text-slate-400">September 25, 2025 · Verified Booking</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center text-yellow-400">
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-slate-300" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.955c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.448 2.376c-.784.57-1.838-.197-1.539-1.118l1.287-3.955a1 1 0 00-.364-1.118L2.568 9.382c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                </div>
                            </div>
                        </header>

                        <div class="mt-3 text-sm text-slate-700">
                            Great product and quick delivery. Highly recommend.
                        </div>

                        <div class="mt-4 border-t pt-4 text-xs text-slate-400">
                            Verified user · Helpful: 4
                        </div>
                    </article>
                </div>

                <div class="mt-8 flex justify-center">
                    <button id="seeMoreBtn" class="inline-flex items-center gap-2 px-5 py-2 border rounded text-sm bg-white hover:bg-slate-50">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 5v14M5 12h14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        See more Reviews
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection