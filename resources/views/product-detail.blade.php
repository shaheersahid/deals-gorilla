<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Deals Gorilla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-nav {
            background: #EDEDED40;
            border-top: 1px solid #DEDEDE
        }
        #site-header {
            transition: transform 220ms ease, box-shadow 200ms ease;
            will-change: transform;
            transform: translateY(0);
        }

        #site-header.hidden-up {
            transform: translateY(-110%);
            box-shadow: none;
        }

        #site-header.visible {
            transform: translateY(0);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        #mega-panel {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            transition: opacity 180ms ease, transform 180ms ease, left 160ms ease, width 160ms ease;
            transform: translateY(6px);
            opacity: 0;
            pointer-events: none;
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
        }

        #mega-panel.open {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        #mobile-menu {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100vh;
            max-width: 100%;
            z-index: 9998;
            transform: translateX(-100%);
            transition: transform 280ms ease;
        }

        #mobile-menu.translate-x-0 {
            transform: translateX(0);
        }

        div#mobile-search-full {
            background: #fff;
            height: 100vh;
        }

        .search-focus:focus {
            outline: none;
            box-shadow: 0 0 0 0px rgba(99, 102, 241, 0.12);
        }

        .backdrop-blur {
            backdrop-filter: blur(6px);
        }

        #mega-panel {
            will-change: transform, opacity;
        }

        .rating-star {
            color: yellow;
        }

        .promo-strip {
            background-image:
                linear-gradient(90deg, rgba(163, 28, 78, 0.45), rgba(192, 48, 100, 0.45) 40%, rgba(169, 30, 92, 0.45)),
                url("assets/images/shop_bg.png");
            background-size: cover;
            background-position: center;
            border-radius: 0px;
            padding: 8px 0;
            margin: 0;
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.06) inset;
            border: 2px solid rgba(255, 255, 255, 0.04);
        }

        .promo-inner {
            padding: 10px;
            align-items: center;
        }

        .promo-text {
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .promo-cta a {
            background: #ffffff;
            color: #7c1d66;
            border-radius: 8px;
            padding-left: 18px;
            padding-right: 18px;
            box-shadow: 0 6px 18px rgba(124, 29, 102, 0.12);
            text-decoration: none;
        }

        #thumbs {
            scrollbar-width: none;
        }

        #thumbs::-webkit-scrollbar {
            display: none;
        }

        .thumb-item.active {
            outline: 3px solid #7c1d66;
            transform: scale(1.03);
        }

        .thumb.active {
            outline: 2px solid #7c1d66;
            border-radius: 6px;
        }

        #product-main-img {
            transition: opacity .18s ease-in-out;
        }

        #product-thumbs {
            max-height: 420px;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        button:focus,
        #product-thumbs:focus {
            outline: none;
            box-shadow: 0 0 0 0px rgba(124, 29, 102, 0.12);
            border-radius: 6px;
        }

        .panel-border {
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.03) inset;
        }

        .data-pill {
            background: #f1f1f1;
            border-radius: 6px;
            padding: 10px 12px;
        }

        .tab-active {
            box-shadow: inset 0 -2px 0 0 #e5e7eb;
        }

        .detail-left {
            min-width: 180px;
        }

        @media (max-width: 640px) {
            .promo-inner {
                gap: 8px;
            }

            .promo-left img {
                display: none;
            }

            .promo-text {
                font-size: 13px;
            }

            .promo-cta a {
                padding: 8px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body class="antialiased text-gray-700  bg-white overflow-x-hidden">

    <!-- Header Start -->
    <header id="site-header" class="w-full border-b bg-white sticky top-0 z-40 backdrop-blur">
        <div class="bg-violet-600 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-center gap-3 text-white py-2 md:py-2.5">
                    <div class="flex items-center gap-2 text-sm md:text-sm"> <img src="assets/images/free_shipping.png" alt="Free Shipping" class="h-4"> <span class="whitespace-nowrap"> Free Shipping - Delivery in <span class="font-semibold">10 Business Days</span> </span> </div>
                    <div class="flex items-center gap-2 text-sm md:text-sm"> <img src="assets/images/authenticity.png" alt="Authenticity" class="h-4"> <span class="whitespace-nowrap"> <span class="font-semibold">100% Authenticity Guarantee</span> </span> </div>
                    <div class="flex items-center gap-2 text-sm md:text-sm"> <img src="assets/images/all_suppliers.png" alt="Suppliers" class="h-4"> <span class="whitespace-nowrap"> All Suppliers <span class="font-semibold">Fully Vetted</span> </span> </div>
                </div>
            </div>
        </div>
        <!-- Center Start -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center flex-shrink-0"> <a href="#" class="flex items-center gap-3"> <img src="assets/images/logo.png" alt="Deal Gorilla" class="h-15"> </a> </div>
                    <div class="flex-1 px-4">
                        <div class="max-w-2xl mx-auto">
                            <div class="relative hidden md:block"> <label for="site-search" class="sr-only">Search</label> <input id="site-search" type="search" placeholder="Search Brands, Products, GTIN's" class="search-focus block w-full pl-4 pr-10 py-3 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-violet-500" autocomplete="off" aria-label="Search site" /> <button aria-label="Search" class="absolute right-1 top-1/2 -translate-y-1/2 px-3 py-1 rounded-full text-sm focus:outline-none"> <img src="assets/images/search.svg" alt="Search" class="h-5"> </button> </div>
                            <div class="md:hidden flex items-center justify-end"> <button id="mobile-search-btn" aria-label="Open search" class="p-2 rounded-full hover:bg-gray-100"> <img src="assets/images/search.svg" alt="Search" class="h-6 w-6"> </button> </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="#" class="flex items-center gap-2"> <img src="assets/images/wish_list.svg" alt="Wish List" class="h-6"> <span class="hidden sm:inline">Wish List</span> </a>
                        <a href="#" class="flex items-center gap-2"> <img src="assets/images/login.svg" alt="Login" class="h-6"> <span class="hidden sm:inline">Login</span> </a>
                        <a href="#" class="flex items-center gap-2 relative"> <img src="assets/images/cart.svg" alt="Cart" class="h-6"> <span class="hidden sm:inline">Cart</span> <span class="absolute -top-3 -left-3 bg-red-500 text-white text-xs rounded-full px-1.5">3</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- nav Start -->
        <nav class="bg-nav shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    <div class="flex items-center gap-4"> <button id="mobile-menu-button" class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500" aria-label="Open menu"> <svg id="hamburger-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg> <svg id="hamburger-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg> </button>
                        <div class="hidden md:flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-50 cursor-pointer" id="mega-trigger-nav"> <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 7v11a1 1 0 001 1h16a1 1 0 001-1V7" />
                            </svg> <button id="mega-trigger" class="text-sm font-medium" aria-expanded="false" aria-controls="mega-panel">All Category</button> </div>
                    </div>
                    <div class="hidden md:flex md:space-x-6">
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Best Seller</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Brands</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Clearance</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">New Releases</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Shop By</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Create Your Own</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Today's Deals</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Registry</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Gift Cards</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Customer Service</a>
                        <a href="#" class="py-2 text-sm font-medium hover:text-violet-600">Sell</a>
                    </div>
                    <div class="flex items-center gap-4"></div>
                </div>
            </div>
        </nav>
        <!-- Mega Menu Start-->
        <div id="mega-panel" class="fixed left-0 top-0 w-screen opacity-0 pointer-events-none transform translate-y-1 transition-all duration-200 z-50" aria-hidden="true" role="dialog" aria-label="All Category Menu">
            <div class="w-full px-0">
                <div class="bg-white border rounded shadow-lg p-6 grid grid-cols-1 md:grid-cols-4 gap-6"> <!-- Column 1 -->
                    <div class="pr-4 md:border-r md:border-dashed">
                        <h3 class="text-sm font-semibold mb-3">ALL CLOTHING</h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li><a href="#" class="block hover:text-violet-600">T-Shirts</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Casual & Party Wear Shirts</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Jeans</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Formal Shirts</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Cargos, Shorts & 3/4ths</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Sports Wear</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Trousers</a></li>
                        </ul>
                    </div>
                    <!-- Column 2 -->
                    <div class="pr-4 md:border-r md:border-dashed">
                        <h3 class="text-sm font-semibold mb-3">ALL FOOTWEAR</h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li><a href="#" class="block hover:text-violet-600">Flats</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Heels</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Bellies</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Wedges</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Slippers & Flip-Flop's</a></li>
                            <li><a href="#" class="block hover:text-violet-600">Sports Shoes</a></li>
                        </ul>
                    </div>
                    <!-- Column 3 -->
                    <div class="pr-4">
                        <h3 class="text-sm font-semibold mb-3">FEATURED PRODUCTS</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center"> <img src="assets/images/product02.png" alt="Product 1" class="mx-auto w-full h-36 object-cover rounded" />
                                <div class="mt-2 text-xs font-semibold">STRIPED MEN'S ROUND NECK T-SHIRT</div>
                                <div class="mt-1 text-sm text-violet-600 font-semibold">$15.00</div>
                            </div>
                            <div class="text-center"> <img src="assets/images/product03.png" alt="Product 2" class="mx-auto w-full h-36 object-cover rounded" />
                                <div class="mt-2 text-xs font-semibold">CASUAL JEANS</div>
                                <div class="mt-1 text-sm text-violet-600 font-semibold">$29.00</div>
                            </div>
                        </div>
                    </div>
                    <!-- Column 4 promo -->
                    <div class="flex items-center justify-center"> <img src="assets/images/product.png" alt="Promo" class="object-cover rounded max-h-80" /> </div>
                </div>
            </div>
        </div>
        <div id="mobile-overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 z-40"></div>
        <div id="mobile-menu" class="fixed inset-0 w-full h-screen md:hidden bg-white shadow-lg overflow-auto transform -translate-x-full z-50">
            <div class="pt-4 pb-6 space-y-1">
                <div class="px-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <a href="#" class="flex items-center gap-3"> <img src="assets/images/logo.png" alt="Deal Gorilla" class="h-15"> </a>
                    </div>
                    <button id="mobile-close" class="p-2 rounded hover:bg-gray-100">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-4 px-2 space-y-2">
                <div class="border rounded"> <button class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="0"> <span class="font-medium">Electronics</span> <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4" />
                        </svg> </button>
                    <div class="accordion-panel px-4 pb-4 hidden"> <img src="assets/images/product.png" alt="Electronics" class="w-full h-36 object-cover rounded mb-3" />
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="block">Smartphones</a></li>
                            <li><a href="#" class="block">Laptops</a></li>
                            <li><a href="#" class="block">Cameras</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border rounded"> <button class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="1"> <span class="font-medium">Home & Kitchen</span> <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4" />
                        </svg> </button>
                    <div class="accordion-panel px-4 pb-4 hidden"> <img src="assets/images/product.png" alt="Home & Kitchen" class="w-full h-36 object-cover rounded mb-3" />
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="block">Appliances</a></li>
                            <li><a href="#" class="block">Cookware</a></li>
                            <li><a href="#" class="block">Furniture</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border rounded"> <button class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="2"> <span class="font-medium">Health & Beauty</span> <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4" />
                        </svg> </button>
                    <div class="accordion-panel px-4 pb-4 hidden"> <img src="assets/images/product.png" alt="Health & Beauty" class="w-full h-36 object-cover rounded mb-3" />
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="block">Skincare</a></li>
                            <li><a href="#" class="block">Supplements</a></li>
                            <li><a href="#" class="block">Haircare</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border rounded"> <button class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Sports & Outdoors</span> <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4" />
                        </svg> </button>
                    <div class="accordion-panel px-4 pb-4 hidden"> <img src="assets/images/product.png" alt="Sports" class="w-full h-36 object-cover rounded mb-3" />
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="block">Fitness</a></li>
                            <li><a href="#" class="block">Camping</a></li>
                            <li><a href="#" class="block">Cycling</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Best Seller</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Brands</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Clearance</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">New Releases</span></a>
                </div>

                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Today's Deals</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Prime Video</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Registry</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Customer Service</span></a>
                </div>
                <div class="border rounded">
                    <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Sell</span></a>
                </div>
            </div>
        </div>
        </div>
        <div id="mobile-search-full" class="fixed inset-0 z-60 hidden opacity-0 bg-white/95 backdrop-blur-sm flex items-start pt-16 px-4 transition-opacity duration-200">
            <div class="w-full max-w-3xl mx-auto">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3"> <button id="mobile-search-close" class="p-2 rounded hover:bg-gray-100" aria-label="Close search"> <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg> </button>
                        <div class="text-sm font-semibold">Search</div>
                    </div>
                </div>
                <div class="mt-8"> <label for="mobile-search-input" class="sr-only">Search</label> <input id="mobile-search-input" type="search" placeholder="Search Brands, Products, GTIN's" class="block w-full pl-4 pr-4 py-4 rounded-full border border-gray-200 shadow-sm text-lg placeholder-gray-400 focus:outline-none focus:border-violet-500" aria-label="Mobile search" /> </div>
                <div id="mobile-search-suggestions" class="mt-4 text-sm text-gray-600">
                    <div class="text-gray-400">Recent searches will appear here...</div>
                </div>
            </div>
        </div>
    </header>




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
        <!-- Carousel products Start-->
        <div class="flex items-center justify-between mb-6 mt-10">
            <div>
                <div class="text-sm text-violet-600 font-medium flex items-center gap-3">
                    <span class="w-3 h-6 bg-violet-600 rounded"></span>
                    <span>Today’s</span>
                </div>
                <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold">You might also like</h2>
            </div>

            <!-- arrows -->
            <div class="flex items-center gap-2">
                <button id="prev" aria-label="Previous" class="nav-btn p-2 rounded-full shadow hover:scale-105">
                    <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next" aria-label="Next" class="nav-btn p-2 rounded-full shadow hover:scale-105">
                    <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
        <section id="products-carousel" class="relative">
            <div class="overflow-hidden">
                <div id="track" class="flex gap-6 transition-transform duration-300 will-change-transform">
                    <!-- Product card -->
                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-1 rounded font-semibold">NEW</span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>
                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product02.png" alt="Product 1"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>
                            <h3 class="mt-3 text-sm font-semibold">Breed Dry Dog Food</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$100</div>
                                <div class="text-sm text-gray-400"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(35)</span></div>
                            </div>
                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>

                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product03.png" alt="Camera"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">CANON EOS DSLR Camera</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-slate-600 line-through font-semibold">$360</div>
                                <div class="text-sm"> <span class="rating-star">★★★★☆</span> <span
                                        class="text-xs text-slate-500 ml-1">(95)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button class="flex-1 bg-black text-white px-3 py-2 rounded text-sm font-medium">Add to Cart</button>

                            </div>
                        </div>
                    </article>

                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product04.png" alt="Laptop"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">ASUS FHD Gaming Laptop</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$700</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(325)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>

                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product003.png" alt="Perfume"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">Curology Product Set</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$500</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(145)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>
                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product02.png" alt="Perfume"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">Curology Product Set</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$500</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(145)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>
                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product02.png" alt="Perfume"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">Curology Product Set</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$500</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(145)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>
                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product02.png" alt="Perfume"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">Curology Product Set</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$500</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(145)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>
                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/product02.png" alt="Perfume"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">Curology Product Set</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$500</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(145)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>
                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-1 rounded font-semibold">NEW</span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>
                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/new_01.png" alt="Product 1"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>
                            <h3 class="mt-3 text-sm font-semibold">Breed Dry Dog Food</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$100</div>
                                <div class="text-sm text-gray-400"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(35)</span></div>
                            </div>
                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>

                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/new_02.png" alt="Camera"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">CANON EOS DSLR Camera</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-slate-600 line-through font-semibold">$360</div>
                                <div class="text-sm"> <span class="rating-star">★★★★☆</span> <span
                                        class="text-xs text-slate-500 ml-1">(95)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button class="flex-1 bg-black text-white px-3 py-2 rounded text-sm font-medium">Add to Cart</button>

                            </div>
                        </div>
                    </article>

                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/new_03.png" alt="Laptop"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">ASUS FHD Gaming Laptop</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$700</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(325)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>

                    <article
                        class="product-card flex-shrink-0 w-[calc(100%/1-1rem)] sm:w-[calc(100%/2-1rem)] md:w-[calc(100%/3-1rem)] lg:w-[calc(100%/4-1rem)]">
                        <div class="bg-white rounded-lg p-4 card-transition card-hover relative h-full">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs bg-white/60 text-slate-600 px-2 py-1 rounded"> </span>
                                <div class="flex items-center gap-2">
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/heart_small.svg" alt="Perfume" />
                                    </button>
                                    <button class="p-1 rounded-full hover:bg-gray-100">
                                        <img src="assets/images/quick_view.svg" alt="Perfume" />
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full h-40 md:h-44 lg:h-48 flex items-center justify-center bg-gray-50 rounded overflow-hidden">
                                <img src="assets/images/new_04.png" alt="Perfume"
                                    class="product-img max-h-full w-full object-contain" />
                            </div>

                            <h3 class="mt-3 text-sm font-semibold">Curology Product Set</h3>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-violet-600 font-semibold">$500</div>
                                <div class="text-sm"> <span class="rating-star">★★★★★</span> <span
                                        class="text-xs text-slate-500 ml-1">(145)</span></div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button
                                    class="flex-1 bg-violet-600 hover:bg-violet-700 text-white px-3 py-2 rounded text-sm font-medium">Add
                                    to Cart</button>

                            </div>
                        </div>
                    </article>

                </div>
            </div>
            <!-- pagination dots -->
            <div id="dots" class="mt-4 flex items-center justify-center gap-2"></div>
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


    <!-- Promo banner-->
    <section class="promo-strip">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="promo-inner flex items-center justify-between gap-4">
                <div class="promo-center text-center flex-1">
                    <p class="promo-text text-sm sm:text-base md:text-lg font-medium">
                        Unlock <span class="font-bold">4 for 2</span> on selected Sanctuary Spa, Champneys & more. Or <span class="font-bold">3 for 2</span> on selected Soap & Glory!
                    </p>
                </div>

                <div class="shrink-0">
                    <a href="#" class="inline-flex items-center gap-2 bg-violet-700 hover:bg-violet-800 text-white px-3 py-2 rounded-lg text-sm sm:text-base font-medium shadow-md transition">
                        SHOP NOW
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Start  -->
    <footer class="footer-outer">
        <div class="bg-gradient-to-r from-white via-violet-50 to-white">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <div>
                        <img src="assets/images/logo.png" alt="logo" class="w-40 mb-4">
                        <p class="text-gray-600 text-sm leading-relaxed">
                            When Looking At Its Layout. The Point Of Using Lorem Ipsum Is That It Has A More Less Normal Distribution
                            Of Letters.
                        </p>
                        <div class="flex items-center gap-4 mt-4 text-gray-700">
                            <a href="#" aria-label="instagram" class="hover:opacity-80"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="facebook" class="hover:opacity-80"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="youtube" class="hover:opacity-80"><i class="fab fa-youtube"></i></a>
                            <a href="#" aria-label="x-twitter" class="hover:opacity-80"><i class="fab fa-x-twitter"></i></a>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-3">Contact Us</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            3613 Canis Heights Drive, Long Beach, California, 90804.
                        </p>
                        <p class="text-gray-600 mt-3 text-sm">
                            Email: <a href="mailto:Admin@Example.Com" class="underline">Admin@Example.Com</a>
                        </p>
                        <p class="text-gray-600 mt-1 text-sm">
                            Ph: 001245 18000
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-3">Collections</h3>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li><a href="#" class="hover:underline">Shop All</a></li>
                            <li><a href="#" class="hover:underline">Modern Chair</a></li>
                            <li><a href="#" class="hover:underline">Court Cupboard</a></li>
                            <li><a href="#" class="hover:underline">Chaise Longue</a></li>
                        </ul>
                    </div>

                    <div class="flex justify-center md:justify-end">
                        <img src="assets/images/map.png" alt="world map" class="w-56 md:w-64 object-contain">
                    </div>
                </div>

                <div class="border-t mt-10 pt-4 flex flex-col md:flex-row items-center justify-between text-sm text-gray-600">
                    <p class="w-full md:w-auto text-center md:text-left">All Right Reserved © <span id="year">2025</span>
                        Delsgorilla</p>

                    <div class="flex items-center gap-5 mt-3 md:mt-0">
                        <a href="#" class="hover:underline">Terms And Condition</a>
                        <span class="hidden md:inline">|</span>
                        <a href="#" class="hover:underline">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Minimal JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('site-header');
            const mobileBtn = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('hamburger-open');
            const closeIcon = document.getElementById('hamburger-close');
            const mobileClose = document.getElementById('mobile-close');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const mobileSearchBtn = document.getElementById('mobile-search-btn');
            const mobileSearchFull = document.getElementById('mobile-search-full');
            const mobileSearchClose = document.getElementById('mobile-search-close');
            const mobileSearchInput = document.getElementById('mobile-search-input');

            const megaPanel = document.getElementById('mega-panel');
            const megaTrigger = document.getElementById('mega-trigger');
            const megaTriggerNav = document.getElementById('mega-trigger-nav');
            let scrollLockPosition = 0;

            function disableScroll() {
                scrollLockPosition = window.pageYOffset || document.documentElement.scrollTop || 0;
                document.documentElement.style.top = `-${scrollLockPosition}px`;
                document.documentElement.style.position = 'fixed';
                document.documentElement.style.width = '100%';
            }

            function enableScroll() {
                document.documentElement.style.position = '';
                document.documentElement.style.top = '';
                document.documentElement.style.width = '';
                window.scrollTo(0, scrollLockPosition);
            }

            function openMobileMenu() {
                if (mobileSearchFull && !mobileSearchFull.classList.contains('hidden')) closeMobileSearch();
                if (mobileOverlay) {
                    mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
                    mobileOverlay.classList.add('opacity-100');
                }
                if (mobileMenu) {
                    mobileMenu.classList.remove('-translate-x-full');
                    mobileMenu.classList.add('translate-x-0');
                }
                openIcon && openIcon.classList.add('hidden');
                closeIcon && closeIcon.classList.remove('hidden');
                disableScroll();
            }

            function closeMobileMenu() {
                if (mobileOverlay) {
                    mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
                    mobileOverlay.classList.remove('opacity-100');
                }
                if (mobileMenu) {
                    mobileMenu.classList.remove('translate-x-0');
                    mobileMenu.classList.add('-translate-x-full');
                }
                openIcon && openIcon.classList.remove('hidden');
                closeIcon && closeIcon.classList.add('hidden');
                enableScroll();
                document.querySelectorAll('.accordion-panel').forEach(p => p.classList.add('hidden'));
            }

            if (mobileBtn) {
                mobileBtn.addEventListener('click', () => {
                    const closed = mobileMenu.classList.contains('-translate-x-full') || (!mobileMenu.classList.contains('translate-x-0'));
                    if (closed) openMobileMenu();
                    else closeMobileMenu();
                });
            }
            if (mobileClose) mobileClose.addEventListener('click', closeMobileMenu);
            if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

            /* Mobile fullscreen search  */
            function openMobileSearch() {
                if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) closeMobileMenu();
                if (mobileSearchFull) {
                    mobileSearchFull.classList.remove('hidden');
                    setTimeout(() => mobileSearchFull.classList.add('opacity-100'), 10);
                    disableScroll();
                    setTimeout(() => {
                        if (mobileSearchInput) mobileSearchInput.focus();
                    }, 120);
                }
            }

            function closeMobileSearch() {
                if (!mobileSearchFull) return;
                mobileSearchFull.classList.remove('opacity-100');
                setTimeout(() => mobileSearchFull.classList.add('hidden'), 200);
                enableScroll();
            }
            if (mobileSearchBtn) mobileSearchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                openMobileSearch();
            });
            if (mobileSearchClose) mobileSearchClose.addEventListener('click', (e) => {
                e.preventDefault();
                closeMobileSearch();
            });
            if (mobileSearchFull) {
                mobileSearchFull.addEventListener('click', (e) => {
                    if (e.target === mobileSearchFull) closeMobileSearch();
                });
            }

            function positionMegaPanelFixed() {
                if (!header || !megaPanel || !megaTriggerNav) return;
                const headerRect = header.getBoundingClientRect();
                const triggerRect = megaTriggerNav.getBoundingClientRect();
                const gap = 8;
                const top = headerRect.bottom + gap;
                let left = Math.max(8, triggerRect.left);
                const margin = 12;
                const maxW = Math.min(1215, window.innerWidth - left - margin);
                megaPanel.style.top = `${top}px`;
                megaPanel.style.left = `${left}px`;
                megaPanel.style.width = `${maxW}px`;
            }

            function showMega() {
                positionMegaPanelFixed();
                megaPanel.classList.add('open');
                megaPanel.setAttribute('aria-hidden', 'false');
                megaTrigger?.setAttribute('aria-expanded', 'true');
            }

            function hideMega() {
                megaPanel.classList.remove('open');
                megaPanel.setAttribute('aria-hidden', 'true');
                megaTrigger?.setAttribute('aria-expanded', 'false');
            }

            (function setupMega() {
                if (!megaTrigger || !megaPanel || !megaTriggerNav) return;
                let openTimer = null,
                    closeTimer = null;
                const OPEN_DELAY = 60,
                    CLOSE_DELAY = 220;
                megaTriggerNav.addEventListener('mouseenter', () => {
                    clearTimeout(closeTimer);
                    openTimer = setTimeout(showMega, OPEN_DELAY);
                });
                megaTriggerNav.addEventListener('mouseleave', () => {
                    clearTimeout(openTimer);
                    closeTimer = setTimeout(hideMega, CLOSE_DELAY);
                });
                megaPanel.addEventListener('mouseenter', () => clearTimeout(closeTimer));
                megaPanel.addEventListener('mouseleave', () => closeTimer = setTimeout(hideMega, CLOSE_DELAY));
                megaTrigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (megaPanel.classList.contains('open')) hideMega();
                    else showMega();
                });
                window.addEventListener('resize', positionMegaPanelFixed);
                window.addEventListener('scroll', positionMegaPanelFixed, {
                    passive: true
                });
                positionMegaPanelFixed();
            })();

            document.querySelectorAll('.accordion-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const panel = btn.nextElementSibling;
                    const isHidden = panel.classList.contains('hidden');
                    document.querySelectorAll('.accordion-panel').forEach(p => p.classList.add('hidden'));
                    if (isHidden) panel.classList.remove('hidden');
                });
            });

            (function setupHeaderScrollToggle() {
                if (!header) return;
                let lastScrollY = window.pageYOffset || 0;
                let ticking = false;
                const HIDE_AFTER = 80;

                function onScroll() {
                    const current = window.pageYOffset || 0;
                    if (current > lastScrollY && current > HIDE_AFTER) {
                        header.classList.add('hidden-up');
                        header.classList.remove('visible');
                    } else {
                        header.classList.remove('hidden-up');
                        header.classList.add('visible');
                    }
                    if (current === 0) {
                        header.classList.remove('hidden-up');
                        header.classList.add('visible');
                    }
                    lastScrollY = current <= 0 ? 0 : current;
                    ticking = false;
                }
                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        window.requestAnimationFrame(onScroll);
                        ticking = true;
                    }
                }, {
                    passive: true
                });
                header.classList.add('visible');
            })();

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (mobileSearchFull && !mobileSearchFull.classList.contains('hidden')) closeMobileSearch();
                    else if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) closeMobileMenu();
                    else if (megaPanel && megaPanel.classList.contains('open')) hideMega();
                }
            });

            (function setupResizeWatcher() {
                const mq = window.matchMedia('(min-width: 768px)');

                function handleResize(e) {
                    if (e.matches) {
                        if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) closeMobileMenu();
                        if (mobileSearchFull && !mobileSearchFull.classList.contains('hidden')) closeMobileSearch();
                    }
                    positionMegaPanelFixed();
                }
                mq.addEventListener ? mq.addEventListener('change', handleResize) : mq.addListener(handleResize);
                handleResize(mq);
            })();

        });
    </script>
    <!--Products Slider-->
    <script>
        (function() {
            const MAIN_IMG_ID = 'product-main-img';
            const THUMBS_CONTAINER_ID = 'product-thumbs';
            const THUMB_CLASS = 'thumb';
            const PREV_ID = 'imgPrev';
            const NEXT_ID = 'imgNext';
            const THUMB_UP_ID = 'thumbUp';
            const THUMB_DOWN_ID = 'thumbDown';
            const FALLBACK = 'https://via.placeholder.com/1200x900?text=image+not+found';

            const mainImg = document.getElementById(MAIN_IMG_ID);
            const thumbsContainer = document.getElementById(THUMBS_CONTAINER_ID);
            const prevBtn = document.getElementById(PREV_ID);
            const nextBtn = document.getElementById(NEXT_ID);
            const upBtn = document.getElementById(THUMB_UP_ID);
            const downBtn = document.getElementById(THUMB_DOWN_ID);

            if (!mainImg || !thumbsContainer) {
                console.error('[Slider] Missing mainImg or thumbsContainer.');
                return;
            }

            const thumbEls = Array.from(thumbsContainer.querySelectorAll('.' + THUMB_CLASS));
            if (thumbEls.length === 0) {
                console.error('[Slider] No .thumb elements found.');
                return;
            }

            const images = thumbEls.map((el) => (el.dataset.large || el.getAttribute('data-large') || (el.querySelector('img') && el.querySelector('img').src) || '')).filter(Boolean);
            mainImg.onerror = function() {
                if (!mainImg.dataset._errored) {
                    mainImg.dataset._errored = '1';
                    console.warn('[Slider] main image failed to load:', mainImg.src, '— switching to fallback.');
                    mainImg.src = FALLBACK;
                }
            };

            thumbEls.forEach((el, idx) => {
                if (!el.hasAttribute('data-index')) el.dataset.index = idx;
            });

            let current = 0;

            function checkImage(url, cb) {
                const i = new Image();
                i.onload = () => cb(true);
                i.onerror = () => cb(false);
                i.src = url;
            }

            function setActive(index, opts = {
                scrollThumb: true
            }) {
                if (index < 0) index = images.length - 1;
                if (index >= images.length) index = 0;
                current = index;
                const url = images[index];
                if (!url) {
                    mainImg.src = FALLBACK;
                    return;
                }
                checkImage(url, (ok) => {
                    if (ok) {
                        mainImg.src = url;
                    } else {
                        console.warn('[Slider] image not loadable:', url);
                        mainImg.src = FALLBACK;
                    }
                });

                thumbEls.forEach((el, i) => el.classList.toggle('active', i === index));
                if (opts.scrollThumb) {
                    const activeThumb = thumbEls[index];
                    if (activeThumb) activeThumb.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            thumbEls.forEach((t) => {
                t.addEventListener('click', () => {
                    const idx = Number(t.dataset.index);
                    if (!Number.isNaN(idx)) setActive(idx);
                });
            });

            if (prevBtn) prevBtn.addEventListener('click', () => setActive((current - 1 + images.length) % images.length));
            if (nextBtn) nextBtn.addEventListener('click', () => setActive((current + 1) % images.length));

            function scrollThumbs(dir) {
                if (!thumbsContainer) return;
                const firstThumb = thumbEls[0];
                if (!firstThumb) return;

                const itemHeight = firstThumb.offsetHeight || 64;

                const visibleCount = Math.max(1, Math.floor(thumbsContainer.clientHeight / itemHeight));
                const scrollAmount = itemHeight * visibleCount;

                thumbsContainer.scrollBy({
                    top: scrollAmount * dir,
                    behavior: 'smooth'
                });
            }

            if (upBtn) upBtn.addEventListener('click', () => scrollThumbs(-1));
            if (downBtn) downBtn.addEventListener('click', () => scrollThumbs(1));

            // allow arrow keys when thumbs container focused
            thumbsContainer.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    scrollThumbs(-1);
                }
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    scrollThumbs(1);
                }
            });

            // keyboard navigation for main image
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') setActive((current - 1 + images.length) % images.length);
                if (e.key === 'ArrowRight') setActive((current + 1) % images.length);
            });
            (function() {
                let startX = 0,
                    startY = 0;
                mainImg.addEventListener('touchstart', (ev) => {
                    startX = ev.touches[0].clientX;
                    startY = ev.touches[0].clientY;
                }, {
                    passive: true
                });
                mainImg.addEventListener('touchend', (ev) => {
                    const dx = ev.changedTouches[0].clientX - startX;
                    const dy = ev.changedTouches[0].clientY - startY;
                    if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
                        if (dx < 0) setActive((current + 1) % images.length);
                        else setActive((current - 1 + images.length) % images.length);
                    }
                }, {
                    passive: true
                });
            })();

            (function init() {
                let i = 0;

                function tryNext() {
                    if (i >= images.length) {
                        mainImg.src = FALLBACK;
                        console.warn('[Slider] no valid images found; using fallback.');
                        return;
                    }
                    const url = images[i++];
                    checkImage(url, (ok) => {
                        if (ok) setActive(i - 1, {
                            scrollThumb: false
                        });
                        else tryNext();
                    });
                }
                tryNext();
            })();
            const dec = document.getElementById('decQty'),
                inc = document.getElementById('incQty'),
                qty = document.getElementById('qty');
            if (dec && inc && qty) {
                dec.addEventListener('click', () => {
                    qty.value = Math.max(1, Number(qty.value || 1) - 1);
                });
                inc.addEventListener('click', () => {
                    qty.value = Math.max(1, Number(qty.value || 1) + 1);
                });
            }

            window.productSlider = {
                images,
                setActive
            };
            console.info('[Slider] ready — images:', images.length);
        })();
    </script>
    <!-- Tabs Description -->
    <script>
        (function() {
            const tabs = Array.from(document.querySelectorAll('[role="tab"]'));
            const panels = Array.from(document.querySelectorAll('[role="tabpanel"]'));

            function activateTab(tab) {
                tabs.forEach(t => {
                    const selected = t === tab;
                    t.setAttribute('aria-selected', selected ? 'true' : 'false');
                    if (selected) {
                        t.classList.add('tab-active', 'text-gray-900');
                        t.classList.remove('text-gray-500');
                    } else {
                        t.classList.remove('tab-active', 'text-gray-900');
                        t.classList.add('text-gray-500');
                    }
                });
                panels.forEach(p => {
                    p.classList.toggle('hidden', p.id !== tab.getAttribute('aria-controls'));
                });
            }
            const defaultTab = document.getElementById('tab-details');
            activateTab(defaultTab);

            tabs.forEach(tab => {
                tab.addEventListener('click', () => activateTab(tab));

                tab.addEventListener('keydown', (e) => {
                    const idx = tabs.indexOf(tab);
                    if (e.key === 'ArrowRight') {
                        const next = tabs[(idx + 1) % tabs.length];
                        next.focus();
                        activateTab(next);
                    } else if (e.key === 'ArrowLeft') {
                        const prev = tabs[(idx - 1 + tabs.length) % tabs.length];
                        prev.focus();
                        activateTab(prev);
                    }
                });
            });
        })();
    </script>

    <!-- Star Reating -->
    <script>
        document.getElementById('seeMoreBtn').addEventListener('click', function() {
            const container = document.querySelector('.md\\:col-span-2 .space-y-6');
            if (!container) return;
            const first = container.querySelector('article');
            if (first) {
                const clone = first.cloneNode(true);
                container.appendChild(clone);
                clone.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>

</body>

</html>