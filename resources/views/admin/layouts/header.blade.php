<meta charset="utf-8" />
<title>{{ View::yieldContent('page-title') . ' | ' . env('APP_NAME') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="On Time Packaging Dashboard" name="description" />
<meta content="wahabSabir" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- App favicon -->
<link rel="icon" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}" sizes="16x16" />
<link rel="icon" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" sizes="32x32" />
<link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}" />
<meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/favicon.ico') }}" />

<!-- dark layout js -->
<script src="{{ asset('admin/assets/js/pages/layout.js') }}"></script>

<!-- Bootstrap Css -->
<link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<!-- Icons Css -->
<link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Simplebar Css -->
<link href="{{ asset('admin/assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet" />

<!-- App Css -->
<link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<!-- Custom Css -->
<link href="{{ asset('admin/assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<!-- Additional Styles -->
@stack('admin-styles')

<!-- Sweet Alert-->
<link rel="stylesheet" href="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}">
