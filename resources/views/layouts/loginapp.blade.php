<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- plugins: css-->
    @vite(['public/assets/vendors/mdi/css/materialdesignicons.min.css', 'public/assets/vendors/css/vendor.bundle.base.css', 'public/assets/css/style.css'])

    <!-- Layout styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles" />


    <!-- Shortcut Icon-->
    <link rel="shortcut icon" href="assets/images/logo-mini.svg" />

    <!-- Scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
    <main class="">
        @yield('content')
    </main>

    <!-- plugins:js -->
    @vite(['public/assets/vendors/js/vendor.bundle.base.js', 'public/assets/js/off-canvas.js', 'public/assets/js/hoverable-collapse.js', 'public/assets/js/misc.js'])
</body>

</html>
