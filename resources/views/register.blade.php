<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Deals Gorilla register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-nav{
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
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
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
            padding: 0;
            margin: px 0;
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

        #flash-track {
            scrollbar-width: none;
        }

        #flash-track::-webkit-scrollbar {
            display: none;
        }

        html,
        body {
            overflow-x: hidden;
        }

        .card-border {
            box-shadow: 0 0 0 1px rgba(15, 23, 42, 0.03) inset;
        }

        .badge {
            font-size: 11px;
            padding: 4px 6px;
            border-radius: 6px;
        }

        .count-box {
            background: #fff;
            border-radius: 6px;
            padding: 6px 8px;
            font-size: 10px;
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .star {
            color: #f59e0b;
        }

        button:focus {
            outline: 2px solid rgba(99, 102, 241, 0.3);
            outline-offset: 2px;
        }

        .card-icons>button {
            transition: transform .28s cubic-bezier(.2, .9, .2, 1), opacity .28s ease;
            transform: translateX(8px);
            opacity: 0;
        }

        .group:has(:focus-within) .card-icons>button,
        .group:hover .card-icons>button {
            transform: translateX(0);
            opacity: 1;
        }

        .card-icons>button:nth-child(1) {
            transition-delay: 60ms;
        }

        .card-icons>button:nth-child(2) {
            transition-delay: 110ms;
        }

        .card-icons>button:nth-child(3) {
            transition-delay: 160ms;
        }

        .icon-btn:focus {
            outline: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        /* checkbox */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: none;
            /* light grey border */
            border-radius: 3px;
            cursor: pointer;
            position: relative;
            background-color: #fff;
        }
        .custom-checkbox:hover {
            border: none;
        }
        .custom-checkbox:checked {
            border: none;
            background-color: #fff;
        }
        .custom-checkbox:checked::after {
            content: "✔";
            font-size: 14px;
            color: #2563eb;
            /* Blue-600 */
            position: absolute;
            top: -2px;
            left: 3px;
            font-weight: bold;
        }

        .content-card {
            border-radius: 8px;
        }
        .custom-checkbox input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
        }

        .custom-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 3px;
            border: 1.5px solid #d1d5db;
            display: inline-block;
            vertical-align: middle;
            background: white;
        }

        .custom-checkbox input[type="checkbox"]:checked {
            background: linear-gradient(180deg, #f59e0b, #f97316);
            border-color: transparent;
            position: relative;
        }

        .custom-checkbox input[type="checkbox"]:checked::after {
            content: "✓";
            color: white;
            font-size: 11px;
            width: 16px;
            height: 16px;
            line-height: 16px;
            display: inline-block;
            text-align: center;
            transform: translateY(-4px);
        }
        .captcha-placeholder {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #fff;
            padding: 10px;
        }

        @media (min-width: 1024px) {
            .content-card {
                overflow: hidden;
            }
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

    <main class="max-w-7xl mx-auto p-6 my-10">
        <div class="bg-white panel content-card overflow-hidden lg:flex lg:shadow-lg rounded-md">
            <!-- Login form -->
            <div class="lg:w-1/2 px-8 py-10 md:px-12 md:py-14">
                <h1 class="text-2xl sm:text-3xl font-extrabold mb-0">Create account</h1>
                <p class=" mb-6">Create your account to get started — it's quick and easy.</p>

                <form class="space-y-4" action="#" method="POST" onsubmit="event.preventDefault(); alert('Account created (demo)')">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="sr-only">First name</span>
                            <input required name="first" placeholder="First Name" type="text"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>

                        <label class="block">
                            <span class="sr-only">Last name</span>
                            <input required name="last" placeholder="Last Name" type="text"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>
                    </div>

                    <div>
                        <label class="block">
                            <span class="sr-only">Email</span>
                            <input required name="email" placeholder="Email Address" type="email"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="sr-only">Password</span>
                            <input required name="password" placeholder="Password" type="password"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>

                        <label class="block">
                            <span class="sr-only">Confirm password</span>
                            <input required name="confirm" placeholder="Confirm Password" type="password"
                                class="w-full rounded border border-gray-200 bg-gray-50 px-4 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-200" />
                        </label>
                    </div>

                    <div class="space-y-3 mt-3">
                        <label class="custom-checkbox gap-3 text-sm text-slate-700">
                            <input type="checkbox" name="newsletter" />
                            <span>Sign Up for Newsletter to Get £160 Off Coupon Bundle</span>
                        </label>
                    </div>

                    <div class="mt-3">
                        <div class="captcha-placeholder">
                            <div class="flex items-center gap-4">
                                <div class="text-sm text-slate-600">I'm not a robot — reCAPTCHA placeholder</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-amber-400 hover:bg-amber-500 text-white rounded-md py-3 font-semibold mt-4">
                            Register
                        </button>
                    </div>
                </form>
                <div class="mt-8 text-xs text-slate-500">
                    By logging in you agree to our <a href="#" class="underline">Terms & Conditions</a>.
                </div>
            </div>
            <div class="lg:w-1/2 relative">
                <div class="h-64 sm:h-80 lg:h-full bg-cover bg-center"
                    style="background-image: url('assets/images/login-bg.webp');">
                    <div class="h-full w-full bg-gradient-to-b from-transparent to-white/60"></div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="max-w-sm w-full px-6 py-3 pointer-events-auto">
                        <div class="bg-white/90 backdrop-blur-sm rounded-md p-6 text-center">
                            <h3 class="text-2xl font-semibold text-slate-800 mb-2">Return to Sign in</h3>
                            <p class="text-sm text-slate-500 mb-4">Already have an account?</p>
                            <a href="/login"
                                class="inline-block w-full text-center pointer-events-auto cta-pill bg-slate-800 hover:bg-slate-900 text-white font-medium rounded-md py-3">
                                Sign In
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block absolute -left-6 top-0 bottom-0 w-6 bg-transparent"></div>
            </div>
        </div>
    </main>

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
</body>

</html>