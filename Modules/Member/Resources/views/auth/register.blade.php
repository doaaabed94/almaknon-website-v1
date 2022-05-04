@extends('member::layouts.master-without-nav')

@section('title') {!! __('member::auth.register_new_account') !!} @endsection

@section('body')

<body>
    @endsection

    @section('content')

    <div class="home-btn d-none d-sm-block">
        <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">{!! __('member::auth.register_new_account') !!}</h5>
<!--                                 <p class="text-white-50 mb-0">Get your free Qovex account now</p>
 -->                                <a href="index" class="logo logo-admin mt-4">
                                    <img src="/images/logo-sm-dark.png" alt="" height="30">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">

                            <div class="p-2">
                                <form method="POST" action="{{ route('member::postRegister') }}" class="crud-ajax-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="useremail">{!! __('member::inputs.email.label') !!}</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="useremail" placeholder="Enter email" autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">{!! __('member::inputs.first_name.label') !!}</label>
                                        <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" class="form-control @error('name') is-invalid @enderror" autofocus id="name" placeholder="Enter name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">{!! __('member::inputs.last_name.label') !!}</label>
                                        <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" class="form-control @error('name') is-invalid @enderror" autofocus id="name" placeholder="Enter name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">{!! __('member::inputs.password.label') !!}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="userpassword" placeholder="Enter password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">{!! __('member::inputs.password_confirmation.label') !!}</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="userconfirmpassword" placeholder="Confirm password">
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" id="register" type="submit"> {{ __('Register') }}</button>
                                    </div>

                                    <!-- <div class="mt-4 text-center">
                                        <p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>
                                    </div> -->
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>{!! __('member::auth.allready_have_an_account') !!} <a href="login" class="font-weight-medium text-primary"> {!! __('member::auth.sign_in') !!}</a> </p>
                        <p>© <script> document.write(new Date().getFullYear()) </script>{!! __('member::main.website_name') !!}<i class="mdi mdi-heart text-danger"></i></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('public/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('public/libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('public/libs/metismenu/metismenu.min.js')}}"></script>
    <script src="{{ URL::asset('public/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('public/libs/node-waves/node-waves.min.js')}}"></script>

    <script src="{{ URL::asset('public/js/app.min.js')}}"></script>

    @endsection