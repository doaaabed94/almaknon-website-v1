<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title> {!! __('member::main.website_name') !!} | @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{!! __('member::main.website_name') !!}e" name="description" />
        <meta content="{!! __('member::main.website_name') !!}" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('public/images/favicon.ico')}}">
        @include('member::layouts.head')
  </head>
    @yield('body')

    @yield('content')

    @include('member::layouts.footer-script')
    </body>
</html>