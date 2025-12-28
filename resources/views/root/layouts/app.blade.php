<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('root.layouts.head')
</head>

<body class="antialiased text-gray-700  bg-white overflow-x-hidden">
    @include('root.layouts.top-header')
    @include('root.layouts.navbar')
    @include('root.layouts.mobile-overlay')
    @include('root.layouts.mobile-search')

    @yield('content')
    @include('root.layouts.footer')

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('page-scripts')
</body>

</html>