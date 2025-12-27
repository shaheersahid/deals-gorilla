@if($products->count() > 0)
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl sm:text-3xl font-extrabold">{{ $title }}</h2>
        
        @if($type == 'slider')
        <!-- arrows -->
        <div class="flex items-center gap-2">
            <button id="prev-{{ $slug }}" aria-label="Previous" class="swiper-button-prev-{{ $slug }} nav-btn p-2 rounded-full shadow hover:scale-105 bg-white border">
                <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next-{{ $slug }}" aria-label="Next" class="swiper-button-next-{{ $slug }} nav-btn p-2 rounded-full shadow hover:scale-105 bg-white border">
                <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        @endif
    </div>

    @if($type == 'slider')
    <section class="relative max-w-7xl mx-auto py-4">
        <div class="swiper product-swiper-{{ $slug }}">
            <div class="swiper-wrapper">
                @foreach($products as $product)
                <div class="swiper-slide">
                    @include('root.content.product-card', ['product' => $product])
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        new Swiper('.product-swiper-{{ $slug }}', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next-{{ $slug }}',
                prevEl: '.swiper-button-prev-{{ $slug }}',
            },
            breakpoints: {
                640: { slidesPerView: 2.2 },
                768: { slidesPerView: 3.2 },
                1024: { slidesPerView: 4 }
            }
        });
    </script>
    @endpush

    @else
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 py-4">
        @foreach($products as $product)
            @include('root.content.product-card', ['product' => $product])
        @endforeach
    </section>
    @endif
@endif