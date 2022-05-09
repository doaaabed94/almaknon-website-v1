<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{!! __('frontend::main.name_website') !!}</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/frontend.css') }}"> --}}


        <link href="{{ URL::asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/theme.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/listings.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/detail.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/compare.css') }}" rel="stylesheet">

        <link href="{{ URL::asset('public/frontend/css/blog.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/pages.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/submits.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/site-colors.css') }}" rel="stylesheet">


        @if($_LOCALE_ == 'ar' )
        <link href="{{ URL::asset('public/frontend/css/bootstrap-rtl.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/home-rtl.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/custom.css') }}" rel="stylesheet">
        @else
        <link href="{{ URL::asset('public/frontend/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/home.css') }}" rel="stylesheet">
        @endif

        <link href="{{ URL::asset('public/frontend/assets/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/assets/owl-carousel/owl.carousel') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/assets/bxslider/jquery.bxslider.css') }}" rel="stylesheet">

    </head>
    <body class="m-index" data-scrolling-animations="true" data-equal-height=".b-auto__main-item">
        @include('frontend::layouts.header')

        @yield('content')

        @include('frontend::layouts.footer')


    <!--b-footer-->
    <!--Main-->
    <script src="{{ URL::asset('public/frontend/js/jquery-latest.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/modernizr.custom.js') }}"></script>

    <script src="{{ URL::asset('public/frontend/assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>

    <script src="{{ URL::asset('public/frontend/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/classie.js') }}"></script>

    <!--Switcher-->
    <script src="{{ URL::asset('public/frontend/assets/switcher/js/switcher.js') }}"></script>
    <!--Owl Carousel-->
    <script src="{{ URL::asset('public/frontend/assets/owl-carousel/owl.carousel.min.js') }}"></script>
    <!--bxSlider-->
    <script src="{{ URL::asset('public/frontend/assets/bxslider/jquery.bxslider.js') }}"></script>
    <!-- jQuery UI Slider -->
    <script src="{{ URL::asset('public/frontend/assets/slider/jquery.ui-slider.js') }}"></script>

    <!--Theme-->
    <script src="{{ URL::asset('public/frontend/js/jquery.smooth-scroll.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/wow.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/theme.js') }}"></script>

</body>

</html>
