<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta
            content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
            name="viewport">
        <title>Disdukcapil Kabupaten Majalengka</title>
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
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets')}}/css/style.css">
        <link rel="stylesheet" href="{{ asset('assets')}}/css/components.css">
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
                    {{-- <div class="nav-collapse">
                        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                                    <span>Pendaftaran Penduduk</span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="index-0.html" class="nav-link">General Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.html" class="nav-link">Ecommerce Dashboard</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Pencatatan Sipil</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Info & Download</a>
                            </li>
                        </ul>
                    </div> --}}
                    <form class="form-inline ml-auto">
                        <ul class="navbar-nav">
                            <li>
                                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                                    <i class="fas fa-search"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="search-element">
                            <input
                                class="form-control"
                                type="search"
                                placeholder="Search"
                                aria-label="Search"
                                data-width="250">
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <div class="search-backdrop"></div>
                            <div class="search-result">
                                <div class="search-header">
                                    Histories
                                </div>
                                <div class="search-item">
                                    <a href="#">How to hack NASA using CSS</a>
                                    <a href="#" class="search-close">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">Kodinger.com</a>
                                    <a href="#" class="search-close">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">#Stisla</a>
                                    <a href="#" class="search-close">
                                        <i class="fas fa-times"></i>
                                    </a>

                                </div>
                                <div class="search-header">
                                    Result
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img
                                            class="mr-3 rounded"
                                            width="30"
                                            src="../assets/img/products/product-3-50.png"
                                            alt="product">
                                        oPhone S9 Limited Edition
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img
                                            class="mr-3 rounded"
                                            width="30"
                                            src="../assets/img/products/product-2-50.png"
                                            alt="product">
                                        Drone X2 New Gen-7
                                    </a>
                                </div>
                                <div class="search-item">
                                    <a href="#">
                                        <img
                                            class="mr-3 rounded"
                                            width="30"
                                            src="../assets/img/products/product-1-50.png"
                                            alt="product">
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
                    @role('warga')
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->fullname }}</div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a href="features-profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <a href="features-activities.html" class="dropdown-item has-icon">
                            <i class="fas fa-bolt"></i> Activities
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a><form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        </form>
                        </div>
                    </li>
                    @endrole
                </nav>
                <nav class="navbar navbar-secondary navbar-expand-lg">
                    <div class="container">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span>Home</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <span>Cek Permohonan</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">                    
                                    <span>Pendaftaran Penduduk</span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="index-0.html" class="nav-link">Kartu Keluarga</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.html" class="nav-link">KTP-El</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.html" class="nav-link">Kartu Identitas Anak</a>
                                    </li><li class="nav-item">
                                        <a href="index.html" class="nav-link">Penduduk Pindah/Datang</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">                    
                                    <span>Pencatatan Sipil</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                                    <i class="far fa-clone"></i>
                                    <span>Info & Download</span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Informasi Persyaratan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Download Formulir</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>Top Navigation</h1>
                        </div>
                        <div class="section-body">
                            <h2 class="section-title">This is Example Page</h2>
                            <p class="section-lead">This page is just an example for you to create your own page.</p>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Example Card</h4>
                                </div>
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                        sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="card-footer bg-whitesmoke">
                                    This is card footer
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2018
                        <div class="bullet"></div>
                        Design By
                        <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                    </div>
                    <div class="footer-right">
                        2.3.0
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
        <script src="{{ asset('assets')}}/js/stisla.js"></script>

        <!-- JS Libraies -->

        <!-- Page Specific JS File -->

        <!-- Template JS File -->
        <script src="{{ asset('assets')}}/js/scripts.js"></script>
        <script src="{{ asset('assets')}}/js/custom.js"></script>
    </body>
</html>