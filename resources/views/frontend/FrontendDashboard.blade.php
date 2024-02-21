{{--  --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Real Estate</title>

<!-- Fav Icon -->
<link rel="icon" href="{{ asset('frontend_assets/images') }}/favicon.ico" type="image/x-icon">
{{-- <link rel="icon" href="" type="image/x-icon"> --}}

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{ asset('frontend_assets/css') }}/font-awesome-all.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/flaticon.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/owl.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/bootstrap.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/jquery.fancybox.min.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/animate.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/jquery-ui.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/nice-select.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/color/theme-color.css" id="jssDefault" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/switcher-style.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/style.css" rel="stylesheet">
<link href="{{ asset('frontend_assets/css') }}/responsive.css" rel="stylesheet">

</head>

<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">

        @include('frontend.home.preloader')

        @include('frontend.home.header')

        @include('frontend.home.mobileMenu')

        @yield('main')

        @include('frontend.home.footer')

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>

    <!-- jequery plugins -->
    <script src="{{ asset('frontend_assets/js') }}/jquery.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/popper.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/owl.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/wow.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/validation.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jquery.fancybox.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/appear.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/scrollbar.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/isotope.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jquery.nice-select.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jQuery.style.switcher.min.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/jquery-ui.js"></script>
    <script src="{{ asset('frontend_assets/js') }}/nav-tool.js"></script>

    <!-- main-js -->
    <script src="{{ asset('frontend_assets/js') }}/script.js"></script>

</body><!-- End of .page_wrapper -->
</html>
