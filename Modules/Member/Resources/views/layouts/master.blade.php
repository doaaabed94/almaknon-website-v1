<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {!! __('member::main.website_name') !!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{!! __('member::main.website_name') !!} " name="description" />
    <meta content="{!! __('member::main.website_name') !!} " name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}">
    @include('member::layouts.head')
</head>

@section('body')
@show
<body data-layout="detached" data-topbar="colored">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('member::layouts.topbar')
            @include('member::layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
                @include('member::layouts.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->


    <!-- Right Sidebar -->
    @include('member::layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('member::layouts.footer-script')
</body>

</html>