<!DOCTYPE html>
<!--
Author: Ticketify
Product Name: Simpeda
Product Version: 1.0.0
Purchase: https://ticketify.id
Website: https://ticketify.id
Contact: support@ticketify.id
Follow: www.twitter.com/ticketify
Like: www.facebook.com/ticketify
License: For each use you must have a valid license purchased from Ticketify.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="{{ url('/') }}/" />
    <title>Ticketify</title>
    <meta charset="utf-8" />
    <meta name="description" content="Simpeda by Ticketify" />
    <meta name="keywords" content="simpeda, ticketify" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Simpeda - Ticketify" />
    <meta property="og:url" content="https://simpeda-dev.ticketify.id" />
    <meta property="og:site_name" content="Simpeda by Ticketify" />
    <link rel="canonical" href="https://simpeda-dev.ticketify.id" />
    <link rel="shortcut icon" href="assets/media/logos/ticketify.jpg" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                {{-- <div class="text-gray-500 fw-semibold fs-6">Admin Panel</div> --}}
                            </div>

                            {{-- Error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mb-8">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}"
                                    class="form-control bg-transparent" />
                            </div>

                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Password" name="password"
                                    class="form-control bg-transparent" />
                            </div>

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10 mt-8">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                            <!--end::Submit button-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url(assets/media/misc/auth-bg.png)">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    <a href="/">
                        <img alt="Ticketify" src="assets/media/logos/ticketify.jpg" class="h-200px h-lg-250px" style="border-radius: 24px;" />
                    </a>
                    <!--end::Logo-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="assets/js/custom/authentication/sign-in/general.js"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
