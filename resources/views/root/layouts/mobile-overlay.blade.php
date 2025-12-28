<div id="mobile-overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 z-40"></div>
<div id="mobile-menu" class="fixed inset-0 w-full h-screen md:hidden bg-white shadow-lg overflow-auto transform -translate-x-full z-[100]">
    <div class="pt-4 pb-6 space-y-1">
        <div class="px-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3"> <img src="{{asset('assets/images/logo.png')}}" alt="Deal Gorilla" class="h-15"> </a>
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