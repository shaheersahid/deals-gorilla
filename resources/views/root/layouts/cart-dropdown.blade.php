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