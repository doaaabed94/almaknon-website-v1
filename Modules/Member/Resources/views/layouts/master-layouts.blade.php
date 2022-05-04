<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Qovex - Responsive Bootstrap 4 Admin Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Member Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('public/images/favicon.ico')}}">
    @include('member::layouts.head')
</head>

@yield('body')
@show
<body data-layout="horizontal" data-topbar="dark">
<!-- Begin page -->
<div class="container-fluid">
    <div id="layout-wrapper">
        @include('member::layouts.hor-menu')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                @yield('content')
            </div>
            @include('member::layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
</div>
<!-- Right Sidebar -->
@include('member::layouts.right-sidebar')
<!-- END Right Sidebar -->

@include('member::layouts.footer-script')
</body>

</html>