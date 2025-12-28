<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>
    @hasSection('title')
        @yield('title') | {{ config('app.name') }}
    @else
        {{ config('app.name') }}
    @endif
</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/style_ui.css') }}">
<!-- swiper CSS -->
<link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

@stack('page-styles')