<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" id="page-header-search-dropdown" type="button">
                        <i class="mdi mdi-magnify">
                        </i>
                    </button>
                    <div aria-labelledby="page-header-search-dropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input aria-label="Recipient's username" class="form-control" placeholder="Search ..." type="text">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="mdi mdi-magnify">
                                                </i>
                                            </button>
                                        </div>
                                    </input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-none d-sm-inline-block">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item waves-effect" data-toggle="dropdown" type="button">
                        <img alt="{{ $_LOCALE_ }}" class="" height="16" src="{{ \Module::asset('member:images/flags/' . $_LOCALE_ . '.jpg') }}">
                        </img>
                    </button>
                    @if(count($_ALL_LOCALES_) > 1)
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
                        <a class="dropdown-item notify-item" href="{{  LaravelLocalization::getLocalizedURL($_LOCALE_BASE_CODE, request()->fullUrl(), []) }}">
                            <img alt="user-image" class="mr-1 {{ $_LOCALE_BASE_CODE == $_LOCALE_ ? 'active' : ''}}" height="12" src="{{ \Module::asset('member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg') }}">
                                <span class="align-middle">
                                    {{ $_LOCALE_DETAILS['native'] }}
                                </span>
                            </img>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button class="btn header-item noti-icon waves-effect" data-toggle="fullscreen" type="button">
                        <i class="mdi mdi-fullscreen">
                        </i>
                    </button>
                </div>
                {{--
                <div class="dropdown d-inline-block">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" id="page-header-notifications-dropdown" type="button">
                        <i class="mdi mdi-bell-outline">
                        </i>
                        <span class="badge badge-danger badge-pill">
                            3
                        </span>
                    </button>
                    <div aria-labelledby="page-header-notifications-dropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0">
                                        Notifications
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <a class="small" href="#!">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar="" style="max-height: 230px;">
                            <a class="text-reset notification-item" href="">
                                <div class="media">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-cart">
                                            </i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1">
                                            Your order is placed
                                        </h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">
                                                If several languages coalesce the grammar
                                            </p>
                                            <p class="mb-0">
                                                <i class="mdi mdi-clock-outline">
                                                </i>
                                                3 min ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle mr-1">
                                </i>
                                View More..
                            </a>
                        </div>
                    </div>
                </div>
                --}}
                <div class="dropdown d-inline-block">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item waves-effect" data-toggle="dropdown" id="page-header-user-dropdown" type="button">
                        <img alt="Header Avatar" class="rounded-circle header-profile-user" src="{{ \Module::asset('member:images/users/avatar-2.jpg') }}">
                            <span class="d-none d-xl-inline-block ml-1">
                                {{ ucfirst(auth()->user()->first_name) .' '. ucfirst(auth()->user()->last_name) }}
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block">
                            </i>
                        </img>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{!! route('member::ProfileController@update') !!}">
                            <i class="bx bx-user font-size-16 align-middle mr-1">
                            </i>
                            {{ __('member::strings.my_profile') }}
                        </a>
                        {{--
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-wallet font-size-16 align-middle mr-1">
                            </i>
                            My Wallet
                        </a>
                        --}}
                        {{--
                        <a class="dropdown-item d-block" href="#">
                            <span class="badge badge-success float-right">
                                11
                            </span>
                            <i class="bx bx-wrench font-size-16 align-middle mr-1">
                            </i>
                            Settings
                        </a>
                        --}}
                        {{--
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-lock-open font-size-16 align-middle mr-1">
                            </i>
                            Lock screen
                        </a>
                        --}}
                        <div class="dropdown-divider">
                        </div>
                        {{--
                        <a class="kt-notification__item" href="{!! route('ProfileController@update') !!}">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-calendar-3 kt-font-success">
                                </i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    {{ __('member::strings.my_profile') }}
                                </div>
                                <div class="kt-notification__item-time">
                                    {{ __('member::strings.my_profile_update') }}
                                </div>
                            </div>
                        </a>
                        --}}
                                        @if (!empty(session()->get('OLD_USER_JWT_TOKEN')))
                        <a class="dropdown-item" href="javascript:;" onclick="$('#back-to-old-logged-in-account').submit();" style="margin-left: 5px; margin-right: 5px;">
                            {{ __('member::strings.back_to_old_logged_in_account') }}
                        </a>
                        <form action="{!! route('member::users.loginAsFromToken') !!}" class="hidden" id="back-to-old-logged-in-account" method="POST">
                            {{ csrf_field() }}
                        </form>
                        @endif
                        <form action="{!! route('postLogout') !!}" class="hidden" id="logout-form" method="POST">
                            {{ csrf_field() }}
                        </form>
                        <a class="dropdown-item text-danger" href="javascript:;" onclick="$('#logout-form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger">
                            </i>
                            {{ __('member::strings.sign_out') }}
                        </a>
                    </div>
                </div>
                {{--
                <div class="dropdown d-inline-block">
                    <button class="btn header-item noti-icon right-bar-toggle waves-effect" type="button">
                        <i class="mdi mdi-settings-outline">
                        </i>
                    </button>
                </div>
                --}}
            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a class="logo logo-dark" href="{{ route('member::index') }}">
                        <span class="logo-sm">
                            <img alt="" height="20" src="{!! __('member::main.logo-sm') !!}">
                            </img>
                        </span>
                        <span class="logo-lg">
                            <img alt="" height="17" src="{!! __('member::main.logo-dark') !!}">
                            </img>
                        </span>
                    </a>
                    <a class="logo logo-light" href="{{ route('member::index') }}">
                        <span class="logo-sm">
                            <img alt="" height="20" src="{{ __('member::main.logo-sm') }}">
                            </img>
                        </span>
                        <span class="logo-lg">
                            <img alt="" height="19" src="{!! __('member::main.logo-light') !!}">
                            </img>
                        </span>
                    </a>
                </div>
                <button class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn" type="button">
                    <i class="fa fa-fw fa-bars">
                    </i>
                </button>
                <!-- App Search-->
                <form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input class="form-control" placeholder="Search..." type="text">
                            <span class="bx bx-search-alt">
                            </span>
                        </input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>