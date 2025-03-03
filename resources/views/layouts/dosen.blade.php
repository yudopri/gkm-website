<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>GKM POLIJE</title>

    <meta name="description" content="" />

    @stack('before-style')

    <!-- Favicon -->
    <!-- Fonts -->
    <!-- Icons. Uncomment required icon fonts -->
    <!-- Core CSS -->
    <!-- Vendors CSS -->
    @include('includes.backend.style')

    <!-- Page CSS -->
    @stack('after-style')

    <!-- Helpers -->
    <script src="{{ asset('backend/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backend/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            @include('includes.backend.sidebar-dosen')
            <!-- / Sidebar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('includes.backend.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('includes.backend.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @stack('before-script')

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <!-- endbuild -->
    <!-- Vendors JS -->
    <!-- Main JS -->
    @include('includes.backend.script')

    <!-- Page JS -->
    @stack('after-script')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @include('sweetalert::alert')
</body>

</html>
