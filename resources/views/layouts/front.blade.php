<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GKM POLIJE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @stack('before-style')

    <!-- Favicon -->
    <!-- Google Web Fonts -->
    <!-- Icon Font Stylesheet -->
    <!-- Libraries Stylesheet -->
    <!-- Customized Bootstrap Stylesheet -->
    <!-- Template Stylesheet -->
    @include('includes.frontend.style')
    @stack('after-style')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            @include('includes.frontend.navbar')

            @yield('hero')
        </div>
        <!-- Navbar & Hero End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 6rem;">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-8">
                        <h6 class="text-white mb-4">
                            GUGUS KENDALI MUTU <br>
                            POLITEKNIK NEGERI JEMBER
                        </h6>
                        <p>
                            <i class="fa fa-map-marker-alt me-3"></i>
                            Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari,
                            Kabupaten Jember, Jawa Timur 68121
                        </p>
                        <p><i class="fa fa-phone-alt me-3"></i>(0331) 333532</p>
                        <p><i class="fa fa-envelope me-3"></i>polije.ac.id</p>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <h5 class="text-white mb-4">Layanan</h5>
                        <a class="btn btn-link" href="">About Us</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">GKM POLIJE</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @stack('before-script')

    <!-- JavaScript Libraries -->
    <!-- Template Javascript -->
    @include('includes.frontend.script')
    @stack('after-script')

    @include('sweetalert::alert')
</body>

</html>
