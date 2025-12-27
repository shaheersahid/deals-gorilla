<!-- Header Start -->
<header id="site-header" class="w-full border-b bg-white">
    <div class="bg-violet-600 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-center gap-3 text-white py-2 md:py-2.5">
                <div class="flex items-center gap-2 text-sm md:text-sm"> <img src="{{asset('assets/images/free_shipping.png')}}" alt="Free Shipping" class="h-4"> <span class="whitespace-nowrap"> Free Shipping - Delivery in <span class="font-semibold">10 Business Days</span> </span> </div>
                <div class="flex items-center gap-2 text-sm md:text-sm"> <img src="{{asset('assets/images/authenticity.png')}}" alt="Authenticity" class="h-4"> <span class="whitespace-nowrap"> <span class="font-semibold">100% Authenticity Guarantee</span> </span> </div>
                <div class="flex items-center gap-2 text-sm md:text-sm"> <img src="{{asset('assets/images/all_suppliers.png')}}" alt="Suppliers" class="h-4"> <span class="whitespace-nowrap"> All Suppliers <span class="font-semibold">Fully Vetted</span> </span> </div>
            </div>
        </div>
    </div>
    <div id="cart-dropdown"
        class="fixed inset-y-0 right-0 w-full sm:w-96 bg-white shadow-2xl
            transform translate-x-full transition-transform duration-300
            z-[9999] flex flex-col">

        <!-- HEADER -->
        <div class="shrink-0 p-4 flex justify-between items-center border-b">
            <h3 class="font-semibold text-lg">My Cart (2)</h3>
            <button id="cart-close" class="p-2 rounded hover:bg-gray-100">✕</button>
        </div>

        <!-- SCROLLABLE ITEMS -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4">
            <!-- ITEM -->
            <div class="flex gap-3 border rounded-lg p-3">
                <img src="{{asset('assets/images/product02.png')}}"
                    class="w-20 h-20 object-cover rounded">

                <div class="flex-1">
                    <h4 class="text-sm font-semibold leading-tight">
                        Striped Men's Round Neck T-Shirt
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">Size: M • Color: Blue</p>

                    <div class="flex items-center justify-between mt-3">
                        <!-- Qty -->
                        <div class="flex items-center border rounded">
                            <button class="px-2 py-1 qty-minus">−</button>
                            <span class="px-3 text-sm qty">1</span>
                            <button class="px-2 py-1 qty-plus">+</button>
                        </div>

                        <!-- Price -->
                        <div class="text-sm font-semibold text-violet-600">
                            $15.00
                        </div>
                    </div>
                </div>

                <!-- Remove -->
                <button class="text-gray-400 hover:text-red-500 text-sm">
                    ✕
                </button>
            </div>

            <!-- ITEM -->
            <div class="flex gap-3 border rounded-lg p-3">
                <img src="{{asset('assets/images/product03.png')}}"
                    class="w-20 h-20 object-cover rounded">

                <div class="flex-1">
                    <h4 class="text-sm font-semibold leading-tight">
                        Casual Jeans
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">Size: 32</p>

                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center border rounded">
                            <button class="px-2 py-1 qty-minus">−</button>
                            <span class="px-3 text-sm qty">1</span>
                            <button class="px-2 py-1 qty-plus">+</button>
                        </div>

                        <div class="text-sm font-semibold text-violet-600">
                            $29.00
                        </div>
                    </div>
                </div>

                <button class="text-gray-400 hover:text-red-500 text-sm">
                    ✕
                </button>
            </div>
        </div>

        <!-- STICKY FOOTER -->
        <div class="shrink-0 border-t p-4 bg-white">
            <div class="flex justify-between text-sm mb-3">
                <span>Subtotal</span>
                <span class="font-semibold">$44.00</span>
            </div>

            <a href="/checkout" class=" bg-violet-600 hover:bg-violet-700 text-white py-3 rounded-lg font-semibold block text-center text-sm text-gray-500 mt-2">
                Checkout
            </a>

            <a href="/cart" class="block text-center text-sm text-gray-500 mt-2">
                View Full Cart
            </a>
        </div>
    </div>


    <!-- Center Start -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center flex-shrink-0"> <a href="#" class="flex items-center gap-3"> <img src="{{asset('assets/images/logo.png')}}" alt="Deal Gorilla" class="h-15"> </a> </div>
                <div class="flex-1 px-4">
                    <div class="max-w-2xl mx-auto">
                        <div class="relative hidden md:block"> <label for="site-search" class="sr-only">Search</label> <input id="site-search" type="search" placeholder="Search Brands, Products, GTIN's" class="search-focus block w-full pl-4 pr-14 py-3 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-violet-500" autocomplete="off" aria-label="Search site" /> <button aria-label="Search" class="absolute right-1 top-1/2 -translate-y-1/4 w-10 h-10 flex items-center justify-center rounded-full text-white bg-violet-600 hover:bg-violet-700 focus:outline-none transition-colors"> <i class="fa-solid fa-magnifying-glass text-lg"></i> </button> </div>
                        <div class="md:hidden flex items-center justify-end"> <button id="mobile-search-btn" aria-label="Open search" class="p-2 rounded-full hover:bg-gray-100"> <i class="fa-solid fa-magnifying-glass text-xl"></i> </button> </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/wish-list" class="flex items-center gap-2 hidden md:flex"> <img src="{{asset('assets/images/wish_list.svg')}}" alt="Wish List" class="h-6"> <span class="hidden sm:inline">Wish List</span> </a>
                    <a href="#" class="flex items-center gap-2"> <img src="{{asset('assets/images/login.svg')}}" alt="Login" class="h-6"> <span class="hidden sm:inline">Login</span> </a>
                    <a href="#" id="cart-btn" class="relative flex items-center gap-2">
                        <img src="{{asset('assets/images/cart.svg')}}" class="h-6">
                        <span class="hidden sm:inline">Cart</span>
                        <span class="absolute -top-3 -left-3 bg-red-500 text-white text-xs rounded-full px-1.5">2</span>
                    </a>
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500" aria-label="Open menu"> <svg id="hamburger-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg> <svg id="hamburger-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg> </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</header>
<!-- nav Start -->
<nav id="site-nav" class="bg-nav shadow-sm sticky top-0 z-50 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <div class="flex items-center gap-4"> 
                <div class="hidden md:flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-50 cursor-pointer" id="mega-trigger-nav">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="5" width="18" height="3" rx="1.5" fill="currentColor" />
                        <rect x="3" y="10.5" width="18" height="3" rx="1.5" fill="currentColor" />
                        <rect x="3" y="16" width="18" height="3" rx="1.5" fill="currentColor" />
                    </svg>

                    <button id="mega-trigger" class="text-sm font-medium" aria-expanded="false" aria-controls="mega-panel">All Category</button>
                </div>
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

    <!-- Mega Menu Start-->
    <div id="mega-panel" class="fixed top-[110px] left-0 w-full opacity-0 pointer-events-none transition-opacity duration-200 z-[9999] shadow-xl border-t bg-white" aria-hidden="true" role="dialog" aria-label="All Category Menu">
        <div class="w-full px-0">
            <div class="bg-white p-6 grid grid-cols-1 md:grid-cols-4 gap-6"> <!-- Column 1 -->
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
                        <div class="text-center"> <img src="{{asset('assets/images/product02.png')}}" alt="Product 1" class="mx-auto w-full h-36 object-cover rounded" />
                            <div class="mt-2 text-xs font-semibold">STRIPED MEN'S ROUND NECK T-SHIRT</div>
                            <div class="mt-1 text-sm text-violet-600 font-semibold">$15.00</div>
                        </div>
                        <div class="text-center"> <img src="{{asset('assets/images/product03.png')}}" alt="Product 2" class="mx-auto w-full h-36 object-cover rounded" />
                            <div class="mt-2 text-xs font-semibold">CASUAL JEANS</div>
                            <div class="mt-1 text-sm text-violet-600 font-semibold">$29.00</div>
                        </div>
                    </div>
                </div>
                <!-- Column 4 promo -->
                <div class="flex items-center justify-center"> <img src="{{asset('assets/images/product.png')}}" alt="Promo" class="object-cover rounded max-h-80" /> </div>
            </div>
        </div>
    </div>
</nav>
<div id="mobile-overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 z-40"></div>
<div id="mobile-menu" class="fixed inset-0 w-full h-screen md:hidden bg-white shadow-lg overflow-auto transform -translate-x-full z-[100]">
    <div class="pt-4 pb-6 space-y-1">
        <div class="px-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="#" class="flex items-center gap-3"> <img src="{{asset('assets/images/logo.png')}}" alt="Deal Gorilla" class="h-15"> </a>
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
            <div class="accordion-panel px-4 pb-4 hidden"> <img src="{{asset('assets/images/product.png')}}" alt="Electronics" class="w-full h-36 object-cover rounded mb-3" />
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
            <div class="accordion-panel px-4 pb-4 hidden"> <img src="{{asset('assets/images/product.png')}}" alt="Home & Kitchen" class="w-full h-36 object-cover rounded mb-3" />
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
            <div class="accordion-panel px-4 pb-4 hidden"> <img src="{{asset('assets/images/product.png')}}" alt="Health & Beauty" class="w-full h-36 object-cover rounded mb-3" />
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
            <div class="accordion-panel px-4 pb-4 hidden"> <img src="{{asset('assets/images/product.png')}}" alt="Sports" class="w-full h-36 object-cover rounded mb-3" />
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
        <div class="border rounded">
            <a href="#" class="w-full flex items-center justify-between px-4 py-3 text-left accordion-btn" data-idx="3"> <span class="font-medium">Wish List</span></a>
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