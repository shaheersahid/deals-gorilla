
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