@extends('root.layouts.app')
@section('content')
<!-- Slides Start -->
<section class="relative max-w-[1920px] mx-auto">
    <div class="swiper hero-swiper relative h-[500px] md:h-[600px] lg:h-[650px]">
        <div class="swiper-wrapper">
            <!-- ================= SLIDE 1 ================= -->
            <div class="swiper-slide">
                <div
                    class="relative h-full grid grid-cols-1 md:grid-cols-12 items-center gap-8 px-6 md:px-16 lg:px-24
                           bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))]
                           from-violet-900 via-slate-900 to-black text-white">

                    <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[500px] h-[500px] bg-violet-600/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[400px] h-[400px] bg-indigo-600/20 rounded-full blur-3xl"></div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-5 z-10 text-center md:text-left">
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-500/10 border border-violet-500/20 text-violet-300 text-xs font-semibold mb-6">
                            <span class="w-2 h-2 bg-violet-400 rounded-full animate-pulse"></span>
                            Limited Time Offer
                        </span>

                        <h2 class="text-4xl md:text-5xl lg:text-7xl font-black mb-6">
                            Black Friday <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">
                                Super Sale
                            </span>
                        </h2>

                        <p class="text-lg text-gray-300 mb-8 max-w-lg mx-auto md:mx-0">
                            Unlock premium inventory with <b>20% OFF</b> on 500+ suppliers.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                            <a href="#"
                               class="px-8 py-4 bg-white text-violet-900 rounded-full font-bold shadow-lg hover:-translate-y-1 transition">
                                Shop Now
                            </a>
                            <a href="#"
                               class="px-8 py-4 border border-white/20 rounded-full hover:bg-white/10">
                                View Catalog
                            </a>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-7 flex justify-center">
                        <img src="{{ asset('assets/images/product001.Png') }}"
                             class="max-w-xl drop-shadow-2xl hover:scale-105 transition duration-700">
                    </div>
                </div>
            </div>

            <!-- ================= SLIDE 2 ================= -->
            <div class="swiper-slide">
                <div
                    class="relative h-full grid grid-cols-1 md:grid-cols-12 items-center gap-8 px-6 md:px-16 lg:px-24
                           bg-[radial-gradient(ellipse_at_bottom_left,_var(--tw-gradient-stops))]
                           from-emerald-900 via-gray-900 to-black text-white">

                    <div class="col-span-12 md:col-span-6 lg:col-span-5 z-10 text-center md:text-left">
                        <h2 class="text-4xl md:text-5xl lg:text-7xl font-black mb-6">
                            Level Up <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">
                                Your Game
                            </span>
                        </h2>

                        <p class="text-lg text-gray-300 mb-8">
                            Experience next-gen gaming performance.
                        </p>

                        <a href="#"
                           class="px-8 py-4 bg-emerald-500 rounded-full font-bold shadow-lg hover:-translate-y-1 transition">
                            Explore Gaming
                        </a>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-7 flex justify-center">
                        <img src="{{ asset('assets/images/product003.Png') }}"
                             class="max-w-xl drop-shadow-2xl hover:scale-105 transition duration-700">
                    </div>
                </div>
            </div>

            <!-- ================= SLIDE 3 ================= -->
            <div class="swiper-slide">
                <div
                    class="relative h-full grid grid-cols-1 md:grid-cols-12 items-center gap-8 px-6 md:px-16 lg:px-24
                           bg-gradient-to-bl from-rose-900 via-gray-900 to-black text-white">

                    <div class="col-span-12 md:col-span-6 lg:col-span-5 z-10 text-center md:text-left">
                        <span
                            class="inline-flex px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-300 text-xs font-semibold mb-6">
                            Top Rated Collection
                        </span>

                        <h2 class="text-4xl md:text-5xl lg:text-7xl font-black mb-6">
                            Radiant <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-rose-300">
                                Skincare
                            </span>
                        </h2>

                        <p class="text-lg text-gray-300 mb-8">
                            Luxury skincare sets with high demand.
                        </p>

                        <a href="#"
                           class="px-8 py-4 bg-white text-rose-900 rounded-full font-bold hover:-translate-y-1 transition">
                            Shop Beauty
                        </a>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-7 flex justify-center">
                        <img src="{{ asset('assets/images/product002.Png') }}"
                             class="max-w-xl drop-shadow-2xl hover:scale-105 transition duration-700">
                    </div>
                </div>
            </div>
        </div>
        <!-- DOTS -->
        <div class="swiper-pagination !bottom-6"></div>
        <!-- ARROWS -->
        <div class="swiper-button-prev !text-white"></div>
        <div class="swiper-button-next !text-white"></div>
    </div>

</section>

<!-- delivery Start -->
<section class="w-full bg-[#7c3aed]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 text-white">
        <div class="flex items-center gap-3 px-5 py-4 border-b sm:border-b-0 lg:border-r border-white/20">
            <img src="assets/images/next-day.avif" class="w-8 h-8 opacity-90" alt="">
            <div>
                <h4 class="font-semibold text-sm">Next day delivery</h4>
                <p class="text-xs opacity-80">View checkout for details</p>
            </div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4 border-b sm:border-b-0 lg:border-r border-white/20">
            <img src="assets/images/standard.avif" class="w-8 h-8 opacity-90" alt="">
            <div>
                <h4 class="font-semibold text-sm">Standard delivery</h4>
                <p class="text-xs opacity-80">FREE when you spend £25</p>
            </div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4 border-b sm:border-b-0 lg:border-r border-white/20">
            <img src="assets/images/click-collect.avif" class="w-7 h-7 opacity-90" alt="">
            <div>
                <h4 class="font-semibold text-sm">Click & Collect</h4>
                <p class="text-xs opacity-80">FREE when you spend £15</p>
            </div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4 border-b sm:border-b-0 lg:border-r border-white/20">
            <img src="assets/images/delivery-scooter.avif" class="w-8 h-8 opacity-90" alt="">
            <div>
                <h4 class="font-semibold text-sm">Delivered on demand</h4>
                <p class="text-xs opacity-80">Explore instant delivery</p>
            </div>
        </div>
        <div class="flex items-center gap-3 px-5 py-4">
            <img src="assets/images/healthcare.avif" class="w-8 h-8 opacity-90" alt="">
            <div>
                <h4 class="font-semibold text-sm">Healthcare services</h4>
                <p class="text-xs opacity-80">Book & manage in one place</p>
            </div>
        </div>

    </div>
</section>


<main class="max-w-7xl mx-auto p-6">
    <!-- Logos Slider -->
    <section class="max-w-7xl mx-auto px-4 py-8">
        <div class="text-center mb-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold mb-8">NBrands <span class="text-red-500">You Love</span></h2>
            <p class="text-sm text-gray-500 mt-1">
                Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.
            </p>
        </div>

        <div class="bg-white rounded p-4">
            <div class="swiper brands-swiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/images/ellipse1.png') }}" class="max-h-20 object-contain">
                    </div>

                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/images/ellipse2.png') }}" class="max-h-20 object-contain">
                    </div>

                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/images/ellipse3.png') }}" class="max-h-20 object-contain">
                    </div>

                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/images/ellipse4.png') }}" class="max-h-20 object-contain">
                    </div>

                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/images/ellipse5.png') }}" class="max-h-20 object-contain">
                    </div>

                    <div class="swiper-slide flex justify-center">
                        <img src="{{ asset('assets/images/ellipse6.png') }}" class="max-h-20 object-contain">
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- New Arrival Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 py-12">
        <h2 class="text-2xl sm:text-3xl font-extrabold mb-8">New Arrival</h2>

        <!-- Grid: left large card + right grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
            <!-- Left large card -->
            <div class="lg:col-span-7">
                <a href="#" class="group block rounded-lg overflow-hidden shadow-md h-full">
                    <div class="relative h-[400px] sm:h-[430px] lg:h-[530px] bg-gray-900">
                        <!-- Replace src with your large product image -->
                        <img src="assets/images/product001.Png" alt="PlayStation 5" class="absolute inset-0 w-full h-full object-cover drop-shadow-xl" />
                        <!-- overlay content -->
                        <div class="absolute left-4 bottom-4 right-4 bg-gradient-to-t from-black/70 via-black/30 to-transparent p-4 rounded-md">
                            <div class="text-white text-sm font-semibold uppercase tracking-wide">PlayStation 5</div>
                            <p class="text-white/90 text-sm mt-2 max-w-sm">Black and White version of the PS5 coming out on sale.</p>
                            <div class="mt-4">
                                <span class="inline-flex items-center gap-2 bg-violet-700 hover:bg-violet-800 text-white px-3 py-2 rounded-lg text-sm sm:text-base font-medium shadow-md transition">
                                    Shop Now
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Right column grid -->
            <div class="lg:col-span-5 grid grid-rows-3 gap-6">
                <!-- top (large) -->
                <div class="row-span-2">
                    <a href="#" class="group block rounded-lg overflow-hidden shadow-md h-full">
                        <div class="relative h-full bg-gray-800">
                            <img src="assets/images/product002.Png" alt="Women's Collections" class="absolute inset-0 w-full h-full object-cover drop-shadow-xl" />
                            <div class="absolute left-4 bottom-4 right-4 bg-gradient-to-t from-black/60 p-4 rounded-md">
                                <div class="text-white text-lg font-semibold">Women's Collections</div>
                                <p class="text-white/90 text-sm mt-2 hidden sm:block">Featured woman collections that give you another vibe.</p>
                                <div class="mt-3">
                                    <span class="inline-flex items-center gap-2 bg-violet-700 hover:bg-violet-800 text-white px-3 py-2 rounded-lg text-sm sm:text-base font-medium shadow-md transition">
                                        Shop Now
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- bottom two smaller cards -->
                <div class="grid grid-cols-2 gap-6">
                    <a href="#" class="group block rounded-lg overflow-hidden shadow-md">
                        <div class="relative h-40 bg-gray-800">
                            <img src="assets/images/product003.Png" alt="Speakers" class="absolute inset-0 w-full h-full object-cover drop-shadow-lg" />
                            <div class="absolute left-3 bottom-3 bg-black/60 text-white px-3 py-2 rounded text-sm">
                                <div class="font-semibold">Speakers</div>
                                <div class="text-xs">Amazon wireless speakers</div>
                                <div class="mt-3">
                                    <span class="inline-flex items-center gap-2 bg-violet-700 hover:bg-violet-800 text-white px-2 py-1 rounded-lg text-sm sm:text-base font-medium shadow-md transition">
                                        Shop Now
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>

                    <a href="#" class="group block rounded-lg overflow-hidden shadow-md">
                        <div class="relative h-40 bg-gray-800">
                            <img src="assets/images/product004.Png" alt="Perfume" class="absolute inset-0 w-full h-full object-cover drop-shadow-lg" />
                            <div class="absolute left-3 bottom-3 bg-black/60 text-white px-3 py-2 rounded text-sm">
                                <div class="font-semibold">Perfume</div>
                                <div class="text-xs">GUCCI INTENSE EDP</div>
                                <div class="mt-3">
                                    <span class="inline-flex items-center gap-2 bg-violet-700 hover:bg-violet-800 text-white px-2 py-1 rounded-lg text-sm sm:text-base font-medium shadow-md transition">
                                        Shop Now
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Carousel products Start-->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold">Explore Our Products</h2>
        </div>

        <!-- arrows -->
        <div class="flex items-center gap-2">
            <button id="prev" aria-label="Previous" class="swiper-button-prev-custom nav-btn p-2 rounded-full shadow hover:scale-105">
                <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next" aria-label="Next" class="swiper-button-next-custom nav-btn p-2 rounded-full shadow hover:scale-105">
                <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
    <section class="relative max-w-7xl mx-auto px-4 py-10">
        <!-- Swiper -->
        <div class="swiper products-swiper">
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
                            <img src="{{ asset('assets/images/new_01.png') }}" class="object-contain max-h-full drop-shadow-md">
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
                <!-- PRODUCT 7 -->
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
                <!-- PRODUCT 8 -->
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
                <!-- PRODUCT 9 -->
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
                <!-- PRODUCT 10 -->
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
                <!-- PRODUCT 11 -->
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
                <!-- PRODUCT 12 -->
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
                <!-- PRODUCT 13 -->
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
                <!-- PRODUCT 14 -->
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


    <!-- offer banner Section -->
    <section class="w-full mt-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-violet-600/20 via-violet-300/10 to-white shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center px-8 py-12">
                    <div class="space-y-5">
                        <span class="inline-block text-sm font-semibold text-violet-700 uppercase tracking-wider">
                            Limited Time Offer
                        </span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
                            Unlock <span class="text-violet-700">Exclusive 30% OFF</span>
                            on Your Favorite Products
                        </h2>

                        <p class="text-gray-700 text-sm sm:text-base max-w-md">
                            Premium quality, premium discounts. Don’t miss the hottest deals of the season.
                            Shop now and save big on our best-selling items!
                        </p>

                        <button
                            class="inline-flex items-center gap-2 bg-violet-700 hover:bg-violet-800 text-white px-7 py-3 rounded-lg text-sm sm:text-base font-medium shadow-md transition">
                            Shop Now
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-center md:justify-end">
                        <img
                            src="assets/images/product004.Png"
                            alt="Offer Product"
                            class="w-full max-w-sm object-contain drop-shadow-2xl" />
                    </div>
                </div>
                <div class="absolute -top-10 -left-10 w-48 h-48 bg-violet-300/40 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-violet-500/20 rounded-full blur-2xl"></div>
            </div>
        </div>
    </section>

    <!-- Flash Sales Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="block md:block lg:flex lg:items-center lg:justify-between mb-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold">Flash Sales</h2>
            </div>

            <!-- Countdown -->
            <div class="flex items-center gap-3">
                <div id="countdown" class="flex items-center gap-2 bg-white/6 px-3 py-2 rounded-lg shadow-sm border border-slate-100/10">
                    <div class="text-center px-3">
                        <div id="cd-days" class="text-2xl font-bold">00</div>
                        <div class="text-xs text-slate-700">Days</div>
                    </div>
                    <div class="text-center px-3">
                        <div id="cd-hours" class="text-2xl font-bold">00</div>
                        <div class="text-xs text-slate-700">Hours</div>
                    </div>
                    <div class="text-center px-3">
                        <div id="cd-mins" class="text-2xl font-bold">00</div>
                        <div class="text-xs text-slate-700">Minutes</div>
                    </div>
                    <div class="text-center px-3">
                        <div id="cd-secs" class="text-2xl font-bold">00</div>
                        <div class="text-xs text-slate-700">Seconds</div>
                    </div>
                </div>

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
    <!-- Categories Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-5 py-10">
        <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <!-- Card 1 -->
            <div class="bg-white border rounded shadow-sm p-5">
                <h3 class="text-lg font-semibold mb-4 capitalize">Most-loved travel essentials</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/001.jpg" alt="Backpacks" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Backpacks</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/002.jpg" alt="Suitcases" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Suitcases</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/003.jpg" alt="Accessories" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Accessories</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/004.jpg" alt="Handbags" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Handbags</span>
                    </a>
                </div>

                <div class="mt-4">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Discover more</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white border rounded shadow-sm p-5">
                <h3 class="text-lg font-semibold mb-4 capitalize capitalize">Deals on top categories</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/001.jpg" alt="Books" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Books</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/0002.jpg" alt="Fashion" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Fashion</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/0003.jpg" alt="PC" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">PC</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/0004.jpg" alt="Beauty" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Beauty</span>
                    </a>
                </div>

                <div class="mt-4">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Discover more</a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border rounded shadow-sm p-5">
                <h3 class="text-lg font-semibold mb-4 capitalize">Have more fun with family</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/001.jpg" alt="Outdoor Play Sets" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Outdoor Play Sets</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/00002.jpg" alt="Learning Toys" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Learning Toys</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/00003.jpg" alt="Action Figures" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Action Figures</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/00004.jpg" alt="Pretend Play Toys" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Pretend Play Toys</span>
                    </a>
                </div>

                <div class="mt-4">
                    <a href="#" class="text-sm text-blue-600 hover:underline">See more</a>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white border rounded shadow-sm p-5">
                <h3 class="text-lg font-semibold mb-4 capitalize">Find gifts at any price</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/000001.jpg" alt="Under $10" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Under $10</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/000002.jpg" alt="Under $25" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Under $25</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/000003.jpg" alt="Under $50" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Under $50</span>
                    </a>

                    <a href="#" class="flex flex-col items-start gap-2">
                        <div class="w-full h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                            <img src="assets/images/000004.jpg" alt="Under $75" class="object-cover w-full h-full">
                        </div>
                        <span class="text-sm text-gray-600">Under $75</span>
                    </a>
                </div>

                <div class="mt-4">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Visit the Holiday Shop</a>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection