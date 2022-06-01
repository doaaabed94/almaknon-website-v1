    <!-- Loader -->
    <div id="page-preloader"><span class="spinner"></span></div>
    <!-- Loader end -->

    <header class="b-topBar wow slideInDown" data-wow-delay="0.7s">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="b-topBar__addr">
                        <span class="fa fa-map-marker"></span>
                        {!! __('frontend::main.adress') !!}
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="b-topBar__tel">
                        <span class="fa fa-phone"></span>
                        {!! __('frontend::main.phone') !!}
                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <nav class="b-topBar__nav">
                        <ul>
                            <li><a href="{{ route('VisitorController@favorite') }}">{!! __('frontend::main.favorite') !!}</a></li>
                            <li><a href="{{ route('VisitorController@login') }}">{!! __('frontend::main.register') !!}</a></li>
                            <li><a href="{{ route('VisitorController@register') }}">{!! __('frontend::main.sign_in') !!}</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="b-topBar__lang">
                        @if(count($_ALL_LOCALES_) > 1)
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle='dropdown'> {!! __('frontend::main.Language') !!}</a>
                            <ul class="dropdown-menu h-lang">
                                  @foreach($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
                                <li><a class="m-langLink dropdown-toggle" href="{{  LaravelLocalization::getLocalizedURL($_LOCALE_BASE_CODE, request()->fullUrl(), []) }}"><span class="b-topBar__lang-flag m-en"></span>{{ $_LOCALE_DETAILS['native'] }}</a></li>
                                 @endforeach
                            </ul>
                        </div>
                         @endif
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!--b-topBar-->

    <nav class="b-nav">
        <div class="container">
            <div class="row d-flex">
                <div class="col-sm-3 col-xs-4">
                    <div class="b-nav__logo wow slideInLeft" data-wow-delay="0.3s">
                        <h3><a href="/">{!! __('frontend::main.name_logo_css') !!}</a></h3>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-8">
                    <div class="b-nav__list wow slideInRight" data-wow-delay="0.3s">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse navbar-main-slide" id="nav">
                            <ul class="navbar-nav-menu">
                                <li><a href="{{ route('frontend.home') }}">{!! __('frontend::main.home') !!}</a></li>
                                <li><a href="{{ route('CarController@index') }}">{!! __('frontend::main.List_of_Car') !!}</a></li>
                                <li><a href="{{ route('BlogController@static' , ['slug' => 'aboutus']) }}">{!! __('frontend::main.About') !!}</a></li>
                                <li><a href="{{ route('BlogController@index') }}">{!! __('frontend::main.Blog') !!}</a></li>
                                <li><a href="{{ route('BlogController@static', ['slug' => 'contactus']) }}">{!! __('frontend::main.Contact') !!}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--b-nav-->