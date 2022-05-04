<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{URL::asset('/public/modules/member/images/users/avatar-2.jpg') }}"  alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16">{{ ucfirst(auth()->user()->first_name) .' '. ucfirst(auth()->user()->last_name) }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ ucfirst(auth()->user()->type) }}</p>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                @php
                $IS_ROOT = auth()->user()->isAn('ROOT');
                @endphp

                @yield('sidebar')

                <li class="menu-title">{!! __('maknon::main.cars_management') !!}</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('maknon::main.cars') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       @if ($IS_ROOT OR auth()->user()->can('READ_CARS') )
                            <li><a href="{{ route('cars.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_CARS') )
                             <li><a href="{{route('cars.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('maknon::main.offers') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       @if ($IS_ROOT OR auth()->user()->can('READ_OFFERS') )
                            <li><a href="{{ route('offers.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_OFFERS') )
                             <li><a href="{{route('offers.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('maknon::main.conditions') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       @if ($IS_ROOT OR auth()->user()->can('READ_CONDITIONS') )
                            <li><a href="{{ route('conditions.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_CONDITIONS') )
                             <li><a href="{{route('conditions.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('maknon::main.fuels') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       @if ($IS_ROOT OR auth()->user()->can('READ_FUELS') )
                            <li><a href="{{ route('fuels.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_FUELS') )
                             <li><a href="{{route('fuels.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('maknon::main.markas') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       @if ($IS_ROOT OR auth()->user()->can('READ_MARKAS') )
                            <li><a href="{{ route('markas.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_MARKAS') )
                             <li><a href="{{route('markas.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li class="menu-title">{!! __('member::strings.cms_management') !!}</li>

                @if ( $IS_ROOT OR auth()->user()->can('READ_CMS') OR auth()->user()->can('CREATE_CMS') )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.cms') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CMS') )
                            <li><a href="{{ route('member::users.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CMS') )
                             <li><a href="{{route('member::users.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.who_we_are') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CMS') )
                            <li><a href="{{ route('member::users.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CMS') )
                             <li><a href="{{route('member::users.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.testimonials') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CMS') )
                            <li><a href="{{ route('member::users.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CMS') )
                             <li><a href="{{route('member::users.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.privacy') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CMS') )
                            <li><a href="{{ route('member::users.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CMS') )
                             <li><a href="{{route('member::users.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.services') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CMS') )
                            <li><a href="{{ route('member::users.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CMS') )
                             <li><a href="{{route('member::users.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>
                @endif

                <li class="menu-title">{!! __('member::strings.users_and_permissions') !!}</li>

                @if ( $IS_ROOT OR auth()->user()->can('READ_USERS') OR auth()->user()->can('CREATE_USERS') )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.users') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_USERS') )
                            <li><a href="{{ route('member::users.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_USERS') )
                             <li><a href="{{route('member::users.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>
                @endif

                @if ( $IS_ROOT OR auth()->user()->can('READ_ROLES') OR auth()->user()->can('CREATE_ROLES') )
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-inbox-full"></i>
                        <span>{!! __('member::strings.roles') !!}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_ROLES') )
                            <li><a href="{{ route('member::roles.index') }}">{!! trans_choice('member::strings.list_all', 0) !!}</a></li>
                       @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_ROLES') )
                             <li><a href="{{route('member::roles.create')}}">{!! __('member::strings.add_new') !!}</a></li>
                       @endif
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->