<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>GKM POLIJE</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <!-- Fonts -->
    <!-- Icons. Uncomment required icon fonts -->
    <!-- Core CSS -->
    <!-- Vendors CSS -->
    @include('includes.backend.style')

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('backend/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backend/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('backend/img/logo/logo-polije.png') }}" width="35" alt="logo-polije" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">GKM POLIJE</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Forgot Password? 🔒</h4>
                        <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter your email" required autocomplete="email" autofocus />
                            </div>

                            <button type="submit" class="btn btn-primary d-grid w-100">
                                {{ __('Send Reset Link') }}
                            </button>
                        </form>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <!-- endbuild -->
    <!-- Vendors JS -->
    <!-- Main JS -->
    @include('includes.backend.script')

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @include('sweetalert::alert')
</body>

</html>
