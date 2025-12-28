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

    @include('root.layouts.cart-dropdown')

    <!-- Center Start -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center flex-shrink-0"> <a href="{{ route('home') }}" class="flex items-center gap-3"> <img src="{{asset('assets/images/logo.png')}}" alt="Deal Gorilla" class="h-15"> </a> </div>
                <div class="flex-1 px-4">
                    <div class="max-w-2xl mx-auto">
                        <div class="relative hidden md:block"> <label for="site-search" class="sr-only">Search</label> <input id="site-search" type="search" placeholder="Search Brands, Products, GTIN's" class="search-focus block w-full pl-4 pr-14 py-3 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-violet-500" autocomplete="off" aria-label="Search site" /> <button aria-label="Search" class="absolute right-1 top-1/2 -translate-y-1/4 w-10 h-10 flex items-center justify-center rounded-full text-white bg-violet-600 hover:bg-violet-700 focus:outline-none transition-colors"> <i class="fa-solid fa-magnifying-glass text-lg"></i> </button> </div>
                        <div class="md:hidden flex items-center justify-end"> <button id="mobile-search-btn" aria-label="Open search" class="p-2 rounded-full hover:bg-gray-100"> <i class="fa-solid fa-magnifying-glass text-xl"></i> </button> </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ auth()->check() ? route('wishlist') : route('login') }}" class="flex items-center gap-2 hidden md:flex"> <img src="{{asset('assets/images/wish_list.svg')}}" alt="Wish List" class="h-6"> <span class="hidden sm:inline">Wish List</span> </a>
                    <a href="{{ route('login') }}" class="flex items-center gap-2"> <img src="{{asset('assets/images/login.svg')}}" alt="Login" class="h-6"> <span class="hidden sm:inline">Login</span> </a>
                    <a href="#" id="cart-btn" class="relative flex items-center gap-2">
                        <img src="{{asset('assets/images/cart.svg')}}" class="h-6">
                        <span class="hidden sm:inline">Cart</span>
                        <span class="absolute -top-3 -left-3 bg-red-500 text-white text-xs rounded-full px-1.5">2</span>
                    </a>
                    <button id="mobile-menu-button" class="md:hidden p-0 md:p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500" aria-label="Open menu"> <svg id="hamburger-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg> <svg id="hamburger-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg> </button>
                </div>
            </div>
        </div>
    </div>
</header>