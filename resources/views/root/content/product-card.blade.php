<article class="p-4 flex flex-col group relative bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden h-full">
    @php
        $primaryImage = $product->images->where('is_primary', true)->first();
        $imagePath = $primaryImage ? asset('storage/' . $primaryImage->orig_path) : asset('assets/images/placeholder.png');
    @endphp
    
    <!-- badge -->
    @if($product->is_featured)
    <span class="absolute top-3 left-3 bg-amber-100 text-amber-700 text-xs font-semibold px-2 py-1 rounded z-10">FEATURED</span>
    @endif

    <!-- icons -->
    <div class="absolute top-3 right-3 flex flex-col gap-3 z-20 card-icons">
        <a href="#" class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-red-50">❤️</a>
        <a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-slate-50">👁</a>
        <button class="icon-btn w-9 h-9 flex items-center justify-center bg-white border rounded-full shadow-sm hover:bg-blue-50 add-to-cart" data-id="{{ $product->id }}">🛒</button>
    </div>

    <!-- image -->
    <a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="w-full h-48 flex items-center justify-center mb-4 product-image rounded overflow-hidden">
        <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="object-contain max-h-full drop-shadow-md group-hover:scale-110 transition duration-300">
    </a>

    @if($product->category)
    <p class="text-sm text-slate-500 mb-1">{{ $product->category->name }}</p>
    @endif
    
    <h3 class="text-sm font-semibold text-slate-800 mb-2 truncate-2-lines flex-grow">
        <a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="hover:text-blue-600">
            {{ $product->name }}
        </a>
    </h3>

    <div class="flex items-center gap-2 mb-2">
        <div class="text-yellow-400 text-sm">★★★★★</div>
        <div class="text-xs text-slate-400">({{ $product->reviews_count ?? 0 }})</div>
    </div>

    <div class="text-blue-600 font-semibold text-lg">
        ${{ number_format($product->effective_price, 2) }}
        @if($product->compare_price > $product->effective_price)
            <span class="text-slate-400 text-sm line-through ml-2">${{ number_format($product->compare_price, 2) }}</span>
        @endif
    </div>

    <!-- add to cart hover -->
    <button data-id="{{ $product->id }}"
        class="add-to-cart absolute left-0 bottom-0 w-full bg-black text-white text-center py-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 transition duration-300">
        Add To Cart
    </button>
</article>
