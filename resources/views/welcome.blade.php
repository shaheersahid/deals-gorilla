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

        .bg-banner {
            background: #222222;
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

        #flash-track {
            scrollbar-width: none;
        }

        #flash-track::-webkit-scrollbar {
            display: none;
        }

        /* Icon products */
        .card-icons {
            transition: transform .28s cubic-bezier(.2, .9, .3, 1), opacity .28s;
            transform: translateY(-6px) translateX(8px) scale(.98);
            opacity: 0;
        }

        .group:hover .card-icons,
        .group:focus-within .card-icons {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 1;
        }

        .card-icons .icon-btn {
            transform: translateY(6px);
            opacity: 0;
            transition: transform .28s cubic-bezier(.2, .9, .3, 1), opacity .28s;
        }

        .group:hover .card-icons .icon-btn:nth-child(1) {
            transition-delay: .05s;
            transform: translateY(0);
            opacity: 1;
        }

        .group:hover .card-icons .icon-btn:nth-child(2) {
            transition-delay: .10s;
            transform: translateY(0);
            opacity: 1;
        }

        .group:hover .card-icons .icon-btn:nth-child(3) {
            transition-delay: .15s;
            transform: translateY(0);
            opacity: 1;
        }

        .add-cart-btn {
            transition: transform .28s cubic-bezier(.2, .9, .3, 1), opacity .28s;
            transform: translateY(16px);
            opacity: 0;
        }

        .group:hover .add-cart-btn,
        .group:focus-within .add-cart-btn {
            transform: translateY(0);
            opacity: 1;
        }

        .product-image {
            background: linear-gradient(180deg, #fff 0%, #fafafa 100%);
        }

        .group:hover {
            box-shadow: 0 8px 30px rgba(16, 24, 40, 0.08);
            transform: translateY(-2px);
            transition: all .18s ease-in-out;
        }

        @media (max-width: 480px) {
            .card-icons {
                opacity: 1;
                transform: none;
                position: static;
                flex-direction: row;
                gap: .5rem;
                margin-top: .5rem;
            }

            .card-icons .icon-btn {
                transform: none;
                opacity: 1;
            }

            .add-cart-btn {
                position: static;
                transform: none;
                opacity: 1;
                margin-top: .75rem;
                border-radius: .5rem;
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


    <!-- Slides Start -->
    <section class="relative max-w-12xl mx-auto px-0 py-0">
        <div id="hero-slider" class="relative overflow-hidden  shadow-lg">
            <div class="relative h-[360px] md:h-[420px] lg:h-[520px]">
                <!-- Slide 1 -->
                <div class="slide absolute inset-0 hidden grid grid-cols-1 md:grid-cols-12 items-center gap-6 p-6 md:p-20 bg-banner from-indigo-900/80 via-indigo-800/30 to-transparent text-white">
                    <div class="col-span-12 md:col-span-6 lg:col-span-5 max-w-xl mx-auto md:mx-0">
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">Black Friday Sale <span class="text-violet-400">20% OFF</span></h2>
                        <p class="text-sm md:text-base text-gray-200 mb-4">Source premium brands and high margin products from a combined catalog of 500+ suppliers. All available with guaranteed authenticity.</p>
                        <div class="flex items-center gap-6 text-sm text-gray-200 mb-6">
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">500+</span>
                                <span class="text-xs">Vetted suppliers</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">10k+</span>
                                <span class="text-xs">Brands</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">500k+</span>
                                <span class="text-xs">Products</span>
                            </div>
                        </div>
                        <div>
                            <a href="#"
                                class="inline-block bg-violet-600 hover:bg-violet-700 text-white px-5 py-2 rounded shadow">Buy Now</a>
                        </div>
                    </div>

                    <!-- Right image area -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-7 flex items-center justify-center">
                        <!-- Use your product group image here. Replace src as needed. -->
                        <img src="assets/images/product001.Png"
                            alt="Products"
                            class="hero-img max-h-[260px] md:max-h-[320px] lg:max-h-[420px] w-full md:w-auto" />
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="slide absolute inset-0 hidden grid grid-cols-1 md:grid-cols-12 items-center gap-6 p-6 md:p-20 bg-banner from-indigo-900/80 via-indigo-800/30 to-transparent text-white">
                    <div class="col-span-12 md:col-span-6 lg:col-span-5 max-w-xl mx-auto md:mx-0">
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">ASUS FHD <span class="text-emerald-300">Gaming Laptop</span></h2>
                        <p class="text-sm md:text-base text-gray-200 mb-4">LSource premium brands and high margin products from a combined catalog of 500+ suppliers. All available with guaranteed authenticity.</p>
                        <div class="flex items-center gap-6 text-sm text-gray-200 mb-6">
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">500+</span>
                                <span class="text-xs">Vetted suppliers</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">10k+</span>
                                <span class="text-xs">Brands</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">500k+</span>
                                <span class="text-xs">Products</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-violet-600 hover:bg-violet-700 text-white px-5 py-2 rounded shadow">Explore</a>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-7 flex items-center justify-center">
                        <img src="assets/images/product003.Png" alt="Products 2" class="hero-img max-h-[260px] md:max-h-[320px] lg:max-h-[420px] w-full md:w-auto" />
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="slide absolute inset-0 hidden grid grid-cols-1 md:grid-cols-12 items-center gap-6 p-6 md:p-20 bg-banner from-indigo-900/80 via-indigo-800/30 to-transparent text-white">
                    <div class="col-span-12 md:col-span-6 lg:col-span-5 max-w-xl mx-auto md:mx-0">
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">Skincare Picks <span class="text-pink-300">Top Rated</span></h2>
                        <p class="text-sm md:text-base text-gray-200 mb-4">Source premium brands and high margin products from a combined catalog of 500+ suppliers. All available with guaranteed authenticity.</p>
                        <div class="flex items-center gap-6 text-sm text-gray-200 mb-6">
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">500+</span>
                                <span class="text-xs">Vetted suppliers</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">10k+</span>
                                <span class="text-xs">Brands</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-semibold">500k+</span>
                                <span class="text-xs">Products</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-violet-600 hover:bg-violet-700 text-white px-5 py-2 rounded shadow">Shop</a>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-7 flex items-center justify-center">
                        <img src="assets/images/product002.Png" alt="Products 3" class="hero-img max-h-[260px] md:max-h-[320px] lg:max-h-[420px] w-full md:w-auto" />
                    </div>
                </div>
            </div>

            <!-- Controls prev / next -->
            <button id="prevBtn" aria-label="Previous" class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow rounded-full p-2 md:p-3 z-10">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="nextBtn" aria-label="Next" class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white shadow rounded-full p-2 md:p-3 z-10">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Dots -->
            <div id="dots" class="absolute bottom-4 left-1/2 -translate-x-1/2 z-10 flex gap-2"></div>
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
                <h3 class="text-xl font-bold">Brands <span class="text-red-500">You Love</span></h3>
                <p class="text-sm text-gray-500 mt-1">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.</p>
            </div>
            <div id="brands-slider" class="relative bg-white rounded p-4 shadow-sm">
                <div class="overflow-hidden">
                    <div id="brands-track" class="flex gap-6 items-center will-change-transform transition-transform duration-300">
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse1.png" alt="Brand 1"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse2.png" alt="Mango" class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse3.png" alt="H&M" class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse4.png" alt="Puma" class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse5.png" alt="Levis" class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse6.png" alt="Zara" class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse7.png" alt="Brand 7"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse1.png" alt="Brand 7"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse2.png" alt="Brand 7"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse3.png" alt="Brand 7"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse4.png" alt="Brand 7"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse5.png" alt="Brand 7"
                                class="max-h-20 object-contain" />
                        </div>
                        <div class="logo-item flex-shrink-0 w-40 md:w-32 lg:w-28 flex items-center justify-center">
                            <img src="assets/images/ellipse6.png" alt="Mango 2" class="max-h-20 object-contain" />
                        </div>
                    </div>
                </div>
                <button id="brands-prev" aria-label="Previous"
                    class="absolute left-1 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow">
                    <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="brands-next" aria-label="Next"
                    class="absolute right-1 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-2 rounded-full shadow">
                    <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div id="brands-dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2"></div>
            </div>
        </section>
        <!-- New Arrival Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 py-12">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <span class="inline-flex items-center justify-center w-3 h-6 bg-violet-600 rounded mr-2"></span>
                <span class="text-sm text-violet-600 font-medium">Featured</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold mb-8">New Arrival</h2>

            <!-- Grid: left large card + right grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                <!-- Left large card -->
                <div class="lg:col-span-7">
                    <a href="#" class="group block rounded-lg overflow-hidden shadow-md h-full">
                        <div class="relative h-[400px] sm:h-[430px] lg:h-[530px] bg-gray-900">
                            <!-- Replace src with your large product image -->
                            <img src="assets/images/product001.Png" alt="PlayStation 5" class="absolute inset-0 w-full h-full object-cover" />
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
                                <img src="assets/images/product002.Png" alt="Women's Collections" class="absolute inset-0 w-full h-full object-cover" />
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
                                <img src="assets/images/product003.Png" alt="Speakers" class="absolute inset-0 w-full h-full object-cover" />
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
                                <img src="assets/images/product004.Png" alt="Perfume" class="absolute inset-0 w-full h-full object-cover" />
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
                <div class="text-sm text-violet-600 font-medium flex items-center gap-3">
                    <span class="w-3 h-6 bg-violet-600 rounded"></span>
                    <span>Our Products</span>
                </div>
                <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold">Explore Our Products</h2>
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
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:grid-rows-2 auto-rows-fr">
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_01.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_02.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_03.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_04.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_02.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_03.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_02.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                            <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to wishlist" title="Add to wishlist">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                        <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Quick view" title="Quick view">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                    </svg>
                                </button>
                                <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                    aria-label="Add to cart" title="Add to cart">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                            <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                                <img src="assets/images/new_03.png" alt="Product" class="object-contain max-h-full">
                            </div>
                            <p class="text-sm text-slate-500 mb-1">Cartify</p>
                            <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                                <div class="text-xs text-slate-400">(3)</div>
                            </div>

                            <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                            <!-- Add to Cart Hover Button (slides in from bottom) -->
                            <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                                role="button" tabindex="0" aria-label="Add product to cart">
                                <!-- you can include icon + text -->
                                <span class="inline-flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                        <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="20" r="1" fill="currentColor" />
                                        <circle cx="18" cy="20" r="1" fill="currentColor" />
                                    </svg>
                                    Add To Cart
                                </span>
                            </div>
                        </article>
                        
                    </div>
                </div>
            </div>
            <!-- pagination dots -->
            <div id="dots" class="mt-4 flex items-center justify-center gap-2"></div>
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
                    <div class="inline-flex items-center gap-3 mb-1">
                        <span class="w-2 h-6 bg-violet-500 rounded mr-2"></span>
                        <div class="text-sm text-violet-600 font-medium">Today's</div>
                    </div>
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
                        <button id="flash-prev" aria-label="Previous" class="w-9 h-9 bg-white border rounded-full shadow hover:scale-105 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="flash-next" aria-label="Next" class="w-9 h-9 bg-white border rounded-full shadow hover:scale-105 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products carousel -->
            <div class="relative">
                <div id="flash-track" class="flex gap-6 overflow-x-auto scroll-smooth pb-3">
                    <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                        <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                        <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to wishlist" title="Add to wishlist">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                    <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Quick view" title="Quick view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to cart" title="Add to cart">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                            <img src="assets/images/new_01.png" alt="Product" class="object-contain max-h-full">
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>
                        <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                        <div class="flex items-center gap-2 mb-2">
                            <div class="text-yellow-400 text-sm">★★★★★</div>
                            <div class="text-xs text-slate-400">(3)</div>
                        </div>

                        <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                        <!-- Add to Cart Hover Button (slides in from bottom) -->
                        <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                            role="button" tabindex="0" aria-label="Add product to cart">
                            <!-- you can include icon + text -->
                            <span class="inline-flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                                Add To Cart
                            </span>
                        </div>
                    </article>
                    <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                        <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                        <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to wishlist" title="Add to wishlist">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                    <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Quick view" title="Quick view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to cart" title="Add to cart">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                            <img src="assets/images/new_02.png" alt="Product" class="object-contain max-h-full">
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>
                        <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                        <div class="flex items-center gap-2 mb-2">
                            <div class="text-yellow-400 text-sm">★★★★★</div>
                            <div class="text-xs text-slate-400">(3)</div>
                        </div>

                        <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                        <!-- Add to Cart Hover Button (slides in from bottom) -->
                        <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                            role="button" tabindex="0" aria-label="Add product to cart">
                            <!-- you can include icon + text -->
                            <span class="inline-flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                                Add To Cart
                            </span>
                        </div>
                    </article>
                    <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                        <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                        <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to wishlist" title="Add to wishlist">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                    <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Quick view" title="Quick view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to cart" title="Add to cart">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                            <img src="assets/images/new_03.png" alt="Product" class="object-contain max-h-full">
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>
                        <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                        <div class="flex items-center gap-2 mb-2">
                            <div class="text-yellow-400 text-sm">★★★★★</div>
                            <div class="text-xs text-slate-400">(3)</div>
                        </div>

                        <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                        <!-- Add to Cart Hover Button (slides in from bottom) -->
                        <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                            role="button" tabindex="0" aria-label="Add product to cart">
                            <!-- you can include icon + text -->
                            <span class="inline-flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                                Add To Cart
                            </span>
                        </div>
                    </article>
                    <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                        <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                        <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to wishlist" title="Add to wishlist">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                    <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Quick view" title="Quick view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to cart" title="Add to cart">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                            <img src="assets/images/new_04.png" alt="Product" class="object-contain max-h-full">
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>
                        <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                        <div class="flex items-center gap-2 mb-2">
                            <div class="text-yellow-400 text-sm">★★★★★</div>
                            <div class="text-xs text-slate-400">(3)</div>
                        </div>

                        <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                        <!-- Add to Cart Hover Button (slides in from bottom) -->
                        <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                            role="button" tabindex="0" aria-label="Add product to cart">
                            <!-- you can include icon + text -->
                            <span class="inline-flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                                Add To Cart
                            </span>
                        </div>
                    </article>
                    <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                        <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                        <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to wishlist" title="Add to wishlist">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                    <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Quick view" title="Quick view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to cart" title="Add to cart">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                            <img src="assets/images/new_02.png" alt="Product" class="object-contain max-h-full">
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>
                        <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                        <div class="flex items-center gap-2 mb-2">
                            <div class="text-yellow-400 text-sm">★★★★★</div>
                            <div class="text-xs text-slate-400">(3)</div>
                        </div>

                        <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                        <!-- Add to Cart Hover Button (slides in from bottom) -->
                        <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                            role="button" tabindex="0" aria-label="Add product to cart">
                            <!-- you can include icon + text -->
                            <span class="inline-flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                                Add To Cart
                            </span>
                        </div>
                    </article>
                    <article class="min-w-[240px] sm:min-w-[260px] md:min-w-[280px]  p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg p-4 shadow-sm overflow-hidden">
                        <span class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded z-10">NEW</span>
                        <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to wishlist" title="Add to wishlist">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-500">
                                    <path d="M12 21s-7.5-4.35-9.5-7.5C.5 9.75 5 5 9 6.5 11 7.4 12 9 12 9s1-1.6 3-2.5c4-1.5 8.5 3.25 6.5 7.5C19.5 16.65 12 21 12 21z" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Quick view" title="Quick view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M12 5c5 0 9 4 9 7s-4 7-9 7-9-4-9-7 4-7 9-7z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="2.2" fill="currentColor" />
                                </svg>
                            </button>
                            <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-gray-50"
                                aria-label="Add to cart" title="Add to cart">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-slate-600">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full h-48 flex items-center justify-center mb-4 product-image rounded">
                            <img src="assets/images/new_03.png" alt="Product" class="object-contain max-h-full">
                        </div>
                        <p class="text-sm text-slate-500 mb-1">Cartify</p>
                        <h3 class="text-sm font-semibold text-slate-800 leading-tight mb-2">New Featured MacBook Pro With Apple M1 Pro Chip</h3>

                        <div class="flex items-center gap-2 mb-2">
                            <div class="text-yellow-400 text-sm">★★★★★</div>
                            <div class="text-xs text-slate-400">(3)</div>
                        </div>

                        <div class="text-blue-600 font-semibold text-lg">$200.00</div>

                        <!-- Add to Cart Hover Button (slides in from bottom) -->
                        <div class="add-cart-btn absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 transform translate-y-4"
                            role="button" tabindex="0" aria-label="Add product to cart">
                            <!-- you can include icon + text -->
                            <span class="inline-flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-white">
                                    <path d="M3 3h2l.6 2M7 13h10l3-8H6.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="10" cy="20" r="1" fill="currentColor" />
                                    <circle cx="18" cy="20" r="1" fill="currentColor" />
                                </svg>
                                Add To Cart
                            </span>
                        </div>
                    </article>
                </div>

                <!-- dots / CTA row -->
                <div class="mt-6 flex justify-center">
                    <a href="#" class="inline-block bg-violet-600 hover:bg-violet-700 text-white px-6 py-2 rounded-full font-medium">View All Products</a>
                </div>
            </div>
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
    <!-- Banner slider -->
    <script>
        (function() {
            const slider = document.querySelectorAll('#hero-slider .slide');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const dotsContainer = document.getElementById('dots');

            let current = 0;
            let autoplayInterval = 5000;
            let timer = null;
            let isPaused = false;

            function init() {
                slider.forEach((s, i) => {
                    if (i === 0) {
                        s.classList.remove('hidden');
                        s.style.zIndex = 1;
                        s.style.opacity = 1;
                    } else {
                        s.classList.add('hidden');
                        s.style.zIndex = 0;
                        s.style.opacity = 0;
                    }
                    const dot = document.createElement('button');
                    dot.className = 'w-3 h-3 rounded-full bg-white/60 hover:bg-white/80';
                    dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
                    dot.dataset.index = i;
                    dot.addEventListener('click', () => goTo(i));
                    dotsContainer.appendChild(dot);
                });
                updateDots();
                startAutoplay();
                attachEvents();
            }

            function updateDots() {
                const dots = Array.from(dotsContainer.children);
                dots.forEach((d, idx) => {
                    d.classList.toggle('bg-white', idx === current);
                    d.classList.toggle('bg-white/60', idx !== current);
                });
            }

            function showSlide(nextIdx) {
                if (nextIdx === current) return;
                const outgoing = slider[current];
                const incoming = slider[nextIdx];

                outgoing.classList.add('hidden');
                outgoing.style.opacity = 0;
                outgoing.style.zIndex = 0;

                incoming.classList.remove('hidden');
                incoming.style.zIndex = 1;
                incoming.style.opacity = 1;

                current = nextIdx;
                updateDots();
            }

            function prev() {
                showSlide((current - 1 + slider.length) % slider.length);
            }

            function next() {
                showSlide((current + 1) % slider.length);
            }

            function goTo(i) {
                showSlide(i);
                resetAutoplay();
            }

            function startAutoplay() {
                stopAutoplay();
                timer = setInterval(() => {
                    if (!isPaused) next();
                }, autoplayInterval);
            }

            function stopAutoplay() {
                if (timer) {
                    clearInterval(timer);
                    timer = null;
                }
            }

            function resetAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            function attachEvents() {
                const container = document.getElementById('hero-slider');
                container.addEventListener('mouseenter', () => {
                    isPaused = true;
                });
                container.addEventListener('mouseleave', () => {
                    isPaused = false;
                });
                container.addEventListener('focusin', () => {
                    isPaused = true;
                });
                container.addEventListener('focusout', () => {
                    isPaused = false;
                });

                prevBtn.addEventListener('click', () => {
                    prev();
                    resetAutoplay();
                });
                nextBtn.addEventListener('click', () => {
                    next();
                    resetAutoplay();
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        prev();
                        resetAutoplay();
                    }
                    if (e.key === 'ArrowRight') {
                        next();
                        resetAutoplay();
                    }
                });

                let startX = 0;
                let dist = 0;
                const threshold = 50;

                container.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                }, {
                    passive: true
                });
                container.addEventListener('touchmove', (e) => {
                    dist = e.touches[0].clientX - startX;
                }, {
                    passive: true
                });
                container.addEventListener('touchend', () => {
                    if (Math.abs(dist) > threshold) {
                        if (dist < 0) next();
                        else prev();
                        resetAutoplay();
                    }
                    startX = 0;
                    dist = 0;
                });
            }
            init();
        })();
    </script>
    <!-- Logos Slider -->
    <script>
        (function() {
            const track = document.getElementById('brands-track');
            const prev = document.getElementById('brands-prev');
            const next = document.getElementById('brands-next');
            const dotsWrap = document.getElementById('brands-dots');
            const container = document.getElementById('brands-slider');
            const items = Array.from(track.children);

            function itemsPerView() {
                const w = window.innerWidth;
                if (w >= 1024) return 5;
                if (w >= 768) return 4;
                return 2;
            }
            let perView = itemsPerView();
            let pages = Math.ceil(items.length / perView);
            let currentPage = 0;
            let autoplayMs = 3000;
            let autoplayTimer = null;
            let isPaused = false;
            let startX = 0,
                dist = 0,
                swThreshold = 20;

            function rebuild() {
                perView = itemsPerView();
                pages = Math.ceil(items.length / perView);
                currentPage = 0;
                track.style.transform = 'translateX(0px)';
                buildDots();
            }

            function buildDots() {
                dotsWrap.innerHTML = '';
                for (let i = 0; i < pages; i++) {
                    const b = document.createElement('button');
                    b.className = 'w-2 h-2 rounded-full bg-slate-300/80';
                    b.dataset.idx = i;
                    b.setAttribute('aria-label', 'Go to page ' + (i + 1));
                    b.addEventListener('click', () => {
                        goToPage(parseInt(b.dataset.idx));
                        resetAutoplay();
                    });
                    dotsWrap.appendChild(b);
                }
                updateDots();
            }

            function updateDots() {
                const dots = Array.from(dotsWrap.children);
                dots.forEach((d, idx) => {
                    d.classList.toggle('bg-slate-700', idx === currentPage);
                    d.classList.toggle('bg-slate-300/80', idx !== currentPage);
                });
            }

            function goToPage(idx) {
                if (idx < 0) idx = pages - 1;
                if (idx >= pages) idx = 0;
                currentPage = idx;
                const itemWidth = items[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap || 0);
                const offset = itemWidth * perView * currentPage;
                track.style.transform = `translateX(-${offset}px)`;
                updateDots();
            }

            function prevPage() {
                goToPage(currentPage - 1);
            }

            function nextPage() {
                goToPage(currentPage + 1);
            }

            function startAutoplay() {
                stopAutoplay();
                autoplayTimer = setInterval(() => {
                    if (!isPaused) nextPage();
                }, autoplayMs);
            }

            function stopAutoplay() {
                if (autoplayTimer) {
                    clearInterval(autoplayTimer);
                    autoplayTimer = null;
                }
            }

            function resetAutoplay() {
                stopAutoplay();
                startAutoplay();
            }
            prev.addEventListener('click', () => {
                prevPage();
                resetAutoplay();
            });
            next.addEventListener('click', () => {
                nextPage();
                resetAutoplay();
            });

            container.addEventListener('mouseenter', () => {
                isPaused = true;
            });
            container.addEventListener('mouseleave', () => {
                isPaused = false;
            });
            container.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                dist = 0;
            }, {
                passive: true
            });
            container.addEventListener('touchmove', (e) => {
                dist = e.touches[0].clientX - startX;
            }, {
                passive: true
            });
            container.addEventListener('touchend', () => {
                if (Math.abs(dist) > swThreshold) {
                    if (dist < 0) nextPage();
                    else prevPage();
                    resetAutoplay();
                }
                startX = 0;
                dist = 0;
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    prevPage();
                    resetAutoplay();
                }
                if (e.key === 'ArrowRight') {
                    nextPage();
                    resetAutoplay();
                }
            });
            let resizeTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    rebuild();
                }, 150);
            });
            rebuild();
            startAutoplay();
            window.brandsSlider = {
                goToPage,
                nextPage,
                prevPage,
                rebuild
            };
        })();
    </script>
    <!--Products Slider-->
    <script>
        (function() {
            const track = document.getElementById('track');
            const prevBtn = document.getElementById('prev'); // optional buttons in HTML
            const nextBtn = document.getElementById('next');
            const dotsWrap = document.getElementById('dots');
            const container = document.getElementById('products-carousel');

            if (!track || !container || !dotsWrap) return; // safety

            // select the article cards inside the track (your markup uses <article>)
            const cards = Array.from(track.querySelectorAll('article'));
            if (cards.length === 0) {
                console.warn('No product cards found — make sure cards are <article> elements inside #track.');
            }

            let perView = 1;
            let currentIndex = 0;
            let pages = 1;
            let autoplayMs = 4000;
            let autoplayTimer = null;
            let isPaused = false;
            let startX = 0,
                dist = 0,
                threshold = 50;

            function calcPerView() {
                const w = window.innerWidth;
                if (w >= 1920) return 4;
                if (w >= 1024) return 4;
                if (w >= 768) return 3;
                if (w >= 640) return 2;
                return 1;
            }

            function rebuild() {
                perView = calcPerView();
                pages = Math.max(1, Math.ceil(cards.length / perView));
                currentIndex = Math.min(currentIndex, pages - 1);
                buildDots();
                goTo(currentIndex, false);
            }

            function buildDots() {
                dotsWrap.innerHTML = '';
                for (let i = 0; i < pages; i++) {
                    const b = document.createElement('button');
                    b.className = 'w-2 h-2 rounded-full bg-slate-300/70';
                    b.dataset.index = i;
                    b.setAttribute('aria-label', 'Go to page ' + (i + 1));
                    b.type = 'button';
                    b.addEventListener('click', () => {
                        goTo(parseInt(b.dataset.index, 10), true);
                        resetAutoplay();
                    });
                    dotsWrap.appendChild(b);
                }
                updateDots();
            }

            function updateDots() {
                const dots = Array.from(dotsWrap.children);
                dots.forEach((d, idx) => {
                    d.classList.toggle('bg-slate-700', idx === currentIndex);
                    d.classList.toggle('bg-slate-300/70', idx !== currentIndex);
                });
            }

            function getGap() {
                const style = getComputedStyle(track);
                const gap = parseFloat(style.gap) || 0;
                return gap;
            }

            function goTo(index, smooth = true) {
                if (cards.length === 0) return;

                if (index < 0) index = 0;
                if (index > pages - 1) index = pages - 1;
                currentIndex = index;

                const cardRect = cards[0].getBoundingClientRect();
                const gap = getGap();
                const itemFullWidth = cards[0].offsetWidth + gap;

                // total width of all items
                const totalWidth = itemFullWidth * cards.length - gap; // subtract final gap
                // offset desired
                let offset = itemFullWidth * perView * currentIndex;
                // max offset so last visible page aligns correctly
                const maxOffset = Math.max(0, totalWidth - (itemFullWidth * perView - gap));
                if (offset > maxOffset) offset = maxOffset;

                if (!smooth) {
                    track.style.transition = 'none';
                } else {
                    // ensure track has a transition class or style to animate (you have transition-transform in markup)
                    track.style.transition = track.style.transition || '';
                }

                track.style.transform = `translateX(-${offset}px)`;

                // restore transition after next frame if we turned it off
                requestAnimationFrame(() => {
                    if (!smooth) track.style.transition = '';
                });

                updateDots();
            }

            function prev() {
                goTo(currentIndex - 1, true);
                resetAutoplay();
            }

            function next() {
                goTo(currentIndex + 1, true);
                resetAutoplay();
            }

            // attach prev/next only if they exist
            if (prevBtn) prevBtn.addEventListener('click', prev);
            if (nextBtn) nextBtn.addEventListener('click', next);

            function startAutoplay() {
                stopAutoplay();
                autoplayTimer = setInterval(() => {
                    if (!isPaused) {
                        if (currentIndex < pages - 1) goTo(currentIndex + 1);
                        else goTo(0);
                    }
                }, autoplayMs);
            }

            function stopAutoplay() {
                if (autoplayTimer) {
                    clearInterval(autoplayTimer);
                    autoplayTimer = null;
                }
            }

            function resetAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            container.addEventListener('mouseenter', () => isPaused = true);
            container.addEventListener('mouseleave', () => isPaused = false);
            container.addEventListener('focusin', () => isPaused = true);
            container.addEventListener('focusout', () => isPaused = false);

            container.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                dist = 0;
            }, {
                passive: true
            });

            container.addEventListener('touchmove', (e) => {
                dist = e.touches[0].clientX - startX;
            }, {
                passive: true
            });

            container.addEventListener('touchend', () => {
                if (Math.abs(dist) > threshold) {
                    if (dist < 0) next();
                    else prev();
                }
                startX = 0;
                dist = 0;
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prev();
                if (e.key === 'ArrowRight') next();
            });

            let rtimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(rtimer);
                rtimer = setTimeout(() => rebuild(), 120);
            });

            // initial run
            window.requestAnimationFrame(() => {
                rebuild();
                startAutoplay();
            });

            window.productCarousel = {
                goTo,
                next,
                prev,
                rebuild,
                startAutoplay,
                stopAutoplay
            };
        })();
    </script>

    <!--New Products Slider-->
    <script>
        (function() {
            const saleEnds = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000).getTime();

            function pad(v) {
                return String(v).padStart(2, '0');
            }

            function updateCountdown() {
                const now = Date.now();
                let diff = Math.max(0, saleEnds - now);

                const days = Math.floor(diff / (24 * 60 * 60 * 1000));
                diff -= days * (24 * 60 * 60 * 1000);
                const hours = Math.floor(diff / (60 * 60 * 1000));
                diff -= hours * (60 * 60 * 1000);
                const mins = Math.floor(diff / (60 * 1000));
                diff -= mins * (60 * 1000);
                const secs = Math.floor(diff / 1000);

                document.getElementById('cd-days').textContent = pad(days);
                document.getElementById('cd-hours').textContent = pad(hours);
                document.getElementById('cd-mins').textContent = pad(mins);
                document.getElementById('cd-secs').textContent = pad(secs);
            }


            updateCountdown();
            setInterval(updateCountdown, 1000);

            const track = document.getElementById('flash-track');
            const prev = document.getElementById('flash-prev');
            const next = document.getElementById('flash-next');

            function scrollAmount(dir = 1) {
                const card = track.querySelector('article');
                if (!card) return 300;
                const style = getComputedStyle(track);
                const gap = parseFloat(style.gap) || 16;
                return (card.getBoundingClientRect().width + gap) * (dir);
            }

            prev.addEventListener('click', () => {
                track.scrollBy({
                    left: -scrollAmount(1),
                    behavior: 'smooth'
                });
            });
            next.addEventListener('click', () => {
                track.scrollBy({
                    left: scrollAmount(1),
                    behavior: 'smooth'
                });
            });

            // optional: support keyboard arrows when track focused
            track.setAttribute('tabindex', '0');
            track.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') track.scrollBy({
                    left: -scrollAmount(1),
                    behavior: 'smooth'
                });
                if (e.key === 'ArrowRight') track.scrollBy({
                    left: scrollAmount(1),
                    behavior: 'smooth'
                });
            });
        })();
    </script>
</body>

</html>