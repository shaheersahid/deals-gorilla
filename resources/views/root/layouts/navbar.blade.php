<nav id="site-nav" class="bg-nav shadow-sm sticky top-0 z-50 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between md:h-14 h-auto">
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