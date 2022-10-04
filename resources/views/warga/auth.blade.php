<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Sistem Informasi Pelayanan Disdukcapil Kabupaten Majalengka</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('anyar')}}/assets/img/favicon.png" rel="icon">
        <link href="{{ asset('anyar')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('anyar')}}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="{{ asset('anyar')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('anyar')}}/assets/css/style.css" rel="stylesheet">

        <!-- ======================================================= * Template Name:
        Anyar - v4.7.0 * Template URL:
        https://bootstrapmade.com/anyar-free-multipurpose-one-page-bootstrap-theme/ *
        Author: BootstrapMade.com * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>

    <body>

        <!-- ======= Top Bar ======= -->
        <div id="topbar" class="fixed-top d-flex align-items-center ">
            <div
                class="container d-flex align-items-center justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope-fill"></i>
                    <a href="mailto:contact@example.com">info@example.com</a>
                    <i class="bi bi-phone-fill phone-icon"></i>
                    +1 5589 55488 55
                </div>
                <div class="cta d-none d-md-block">
                    <a href="#about" class="scrollto">Get Started</a>
                </div>
            </div>
        </div>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top d-flex align-items-center ">
            <div class="container d-flex align-items-center justify-content-between">

                <h1 class="logo">
                    <a href="index.html">Anyar</a>
                </h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href=index.html" class="logo"><img src="{{ asset('anyar')}}/assets/img/logo.png" alt=""
                class="img-fluid"></a>-->

                <nav id="navbar" class="navbar">
                    @include('component.navbarPenduduk')
                </nav>
                <!-- .navbar -->

            </div>
        </header>
        <!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex justify-cntent-center align-items-center">
            <div
                id="heroCarousel"
                data-bs-interval="5000"
                class="container carousel carousel-fade"
                data-bs-ride="carousel">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="carousel-container">
                        <h2 class="animate__animated animate__fadeInDown">Welcome to
                            <span>Anyar</span></h2>
                        <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a
                            aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
                            Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque
                            accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                        <a
                            href="#about"
                            class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="carousel-container">
                        <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
                        <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a
                            aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
                            Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque
                            accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                        <a
                            href="#about"
                            class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="carousel-container">
                        <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                        <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a
                            aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam.
                            Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque
                            accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                        <a
                            href="#about"
                            class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
                    </div>
                </div>

                <a
                    class="carousel-control-prev"
                    href="#heroCarousel"
                    role="button"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                </a>

                <a
                    class="carousel-control-next"
                    href="#heroCarousel"
                    role="button"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </section>
        <!-- End Hero -->

        <main id="main">


            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Login SIAP</h2>
                    </div>
                    <div
                        class="row mt-1 d-flex justify-content-center align-items-center"
                        data-aos="fade-right"
                        data-aos-delay="100">

                        {{-- <div class="col-lg-5">
                            <div class="info">
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>

                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email:</h4>
                                    <p>info@example.com</p>
                                </div>

                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>+1 5589 55488 55s</p>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
                            <form
                                action="forms/contact.php"
                                method="post"
                                role="form"
                                class="php-email-form">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="name" class="mb-2">Nama</label>
                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            id="name"
                                            placeholder="Your Name"
                                            required="required">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="col-md form-group mt-3 mt-md-0">
                                        <label for="password" class="mb-2">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            id="password"
                                            placeholder="Your Password"
                                            required="required">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center">
                                    <button class="btn-btn-primary" type="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Contact Section -->

        </main>
        <!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="footer-newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Our Newsletter</h4>
                            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        </div>
                        <div class="col-lg-6">
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Home</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">About us</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Services</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Terms of service</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Privacy policy</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Web Development</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Product Management</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Marketing</a>
                                </li>
                                <li>
                                    <i class="bx bx-chevron-right"></i>
                                    <a href="#">Graphic Design</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h4>Contact Us</h4>
                            <p>
                                A108 Adam Street
                                <br>
                                New York, NY 535022<br>
                                United States
                                <br><br>
                                <strong>Phone:</strong>
                                +1 5589 55488 55<br>
                                <strong>Email:</strong>
                                info@example.com<br>
                            </p>

                        </div>

                        <div class="col-lg-3 col-md-6 footer-info">
                            <h3>About Anyar</h3>
                            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra
                                videa magna derita valies darta donna mare fermentum iaculis eu non diam
                                phasellus.</p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                                <a href="#" class="facebook">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                                <a href="#" class="instagram">
                                    <i class="bx bxl-instagram"></i>
                                </a>
                                <a href="#" class="google-plus">
                                    <i class="bx bxl-skype"></i>
                                </a>
                                <a href="#" class="linkedin">
                                    <i class="bx bxl-linkedin"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="copyright">
                    &copy; Copyright
                    <strong>
                        <span>Anyar</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form:
                    https://bootstrapmade.com/anyar-free-multipurpose-one-page-bootstrap-theme/ -->
                    Designed by
                    <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <div id="preloader"></div>
        <a
            href="#"
            class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('anyar')}}/assets/vendor/aos/aos.js"></script>
        <script src="{{ asset('anyar')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('anyar')}}/assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="{{ asset('anyar')}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="{{ asset('anyar')}}/assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="{{ asset('anyar')}}/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('anyar')}}/assets/js/main.js"></script>

    </body>

</html>