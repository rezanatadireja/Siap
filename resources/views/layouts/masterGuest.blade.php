<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="user-id" content="{{ Auth::check() ? Auth::user()->id : '' }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('icon-layanan/mjl2.png') }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>Disdukcapil Kabupaten Majalengka | @yield('title_name')</title>
        <!-- General CSS Files -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">
        <!-- CSS Libraries -->
        <link rel="stylesheet" href="{{ asset('admin/stisla/plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/stisla/plugins/bootstrap-social\bootstrap-social.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/stisla/izitoast/css/iziToast.min.css') }}">
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('admin/stisla/assets')}}/css/style.css">
        <link rel="stylesheet" href="{{ asset('admin/stisla/assets')}}/css/components.css">
        @yield('custom_style')
    </head>
    <body class="layout-3">
        <div id="app">
            <div class="main-wrapper container">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <a href="index.html" class="navbar-brand sidebar-gone-hide">DISDUKCAPIL</a>
                    <div class="navbar-nav">
                        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                    <form class="form-inline ml-auto">
                        <ul class="navbar-nav">
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" style="width: 250px;">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            <div class="search-backdrop"></div>
                            <div class="search-result">
                            <div class="search-header">
                                Histories
                            </div>
                            <div class="search-item">
                                <a href="#">How to hack NASA using CSS</a>
                                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="search-item">
                                <a href="#">Kodinger.com</a>
                                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="search-item">
                                <a href="#">#Stisla</a>
                                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="search-header">
                                Result
                            </div>
                            <div class="search-item">
                                <a href="#">
                                <img class="mr-3 rounded" src="assets/img/products/product-3-50.png" alt="product" width="30">
                                oPhone S9 Limited Edition
                                </a>
                            </div>
                            <div class="search-item">
                                <a href="#">
                                <img class="mr-3 rounded" src="assets/img/products/product-2-50.png" alt="product" width="30">
                                Drone X2 New Gen-7
                                </a>
                            </div>
                            <div class="search-item">
                                <a href="#">
                                <img class="mr-3 rounded" src="assets/img/products/product-1-50.png" alt="product" width="30">
                                Headphone Blitz
                                </a>
                            </div>
                            <div class="search-header">
                                Projects
                            </div>
                            <div class="search-item">
                                <a href="#">
                                <div class="search-icon bg-danger text-white mr-3">
                                    <i class="fas fa-code"></i>
                                </div>
                                Stisla Admin Template
                                </a>
                            </div>
                            <div class="search-item">
                                <a href="#">
                                <div class="search-icon bg-primary text-white mr-3">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                Create a new Homepage Design
                                </a>
                            </div>
                            </div>
                        </div>
                        </form>
                        @include('component.menuGuest')
                </nav>
                @include('component.navbarGuest')
                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>
                @yield('modal')
                <footer class="main-footer">
                    <div class="footer-left ml-5">
                        Copyright &copy; 2022
                        <div class="bullet"></div>
                        Build By
                        <a href="https://nauval.in/">RFFDev</a>
                    </div>
                    <div class="footer-right mr-5">
                        1.0
                    </div>
                </footer>
            </div>
        </div>

        <!-- General JS Scripts -->
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="{{ asset('admin/stisla/assets')}}/js/stisla.js"></script>
        <script src="{{ asset('admin')}}/stisla/aos/aos.js"></script>

        <!-- JS Libraies -->
        @yield('custom_script')
        <script src="{{ asset('admin/stisla/plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('admin/stisla/izitoast/js/iziToast.min.js') }}"></script>
        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ asset('admin/stisla/assets')}}/js/scripts.js"></script>
        <script src="{{ asset('admin/stisla/assets')}}/js/custom.js"></script>
        <script src="/js/app.js"></script>
        @yield('custom_script_footer')
    </body>
</html>