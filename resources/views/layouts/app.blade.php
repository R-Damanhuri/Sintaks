<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- plugins:css -->
    @vite(['public/assets/vendors/mdi/css/materialdesignicons.min.css', 'public/assets/vendors/css/vendor.bundle.base.css', 'public/assets/css/style.css'])

    <!-- Layout styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles" />

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('home') }}"><img
                        src="{{ asset('assets/images/logo.svg') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img
                        src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Cari di sini ...">
                        </div>
                    </form>
                </div>

                <ul class="navbar-nav navbar-nav-right">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item nav-profile dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image">
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                                </div>
                            </a>

                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout me-2 "></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    @if (auth()->user()->role_id==1)
                        
                    <li class="nav-item sidebar-actions">
                        <div class="border-bottom">
                            <h6 class="font-weight-normal mt-4 menu-title">Admin</h6>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengguna') }}">
                            <span class="menu-title">Data Pengguna</span>
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jenissurat') }}">
                            <span class="menu-title">Jenis Surat</span>
                            <i class="mdi mdi-view-grid menu-icon"></i>
                        </a>
                    </li>
                    @endif
                    
                    <li class="nav-item sidebar-actions">
                        <div class="border-bottom">
                            <h6 class="font-weight-normal mt-4">Pengarsip</h6>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suratmasuk') }}">
                            <span class="menu-title">Surat Masuk</span>
                            <i class="mdi mdi-email-open menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/icons/mdi.html">
                            <span class="menu-title">Surat Keluar</span>
                            <i class="mdi mdi-email menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('disposisi') }}">
                            <span class="menu-title">Disposisi</span>
                            <i class="mdi mdi mdi-send menu-icon"></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="../../pages/forms/basic_elements.html">
                            <span class="menu-title">Buat Surat</span>
                            <i class="mdi mdi-pencil menu-icon"></i>
                        </a>
                    </li> --}}

                </ul>
            </nav>
            <!-- partial -->
            <main class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright ©
                            bootstrapdash.com 2021</span>
                    </div>
                </footer>
            </main>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    @vite(['public/assets/vendors/js/vendor.bundle.base.js', 'public/assets/js/off-canvas.js', 'public/assets/js/hoverable-collapse.js', 'public/assets/js/misc.js', 'public/assets/vendors/chart.js/Chart.min.js', 'public/assets/js/dashboard.js'])

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        datatabel = new DataTable("#myTable");
    </script>
</body>

</html>
