
        @yield('css')

        <!-- App css -->
        <link href="{{ URL::asset('public/css/bootstrap-dark.min.css')}}" id="bootstrap-dark" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/css/bootstrap.min.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        @if($_LOCALE_ == "ar")
        <link href="{{ URL::asset('public/css/app-rtl.min.css')}}" id="app-rtl" rel="stylesheet" type="text/css" />
        @else
        <link href="{{ URL::asset('public/css/app.min.css')}}" id="app-light" rel="stylesheet" type="text/css" />
        @endif
        <link href="{{ URL::asset('public/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .page-title a{
                color: #fff;
            }
        </style>