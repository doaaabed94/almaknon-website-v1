<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div class="h-100">
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img alt="" class="avatar-md mx-auto rounded-circle" src="{{URL::asset('/public/modules/member/images/users/avatar-2.jpg') }}">
                </img>
            </div>
            <div class="mt-3">
                <a class="text-dark font-weight-medium font-size-16" href="#">
                    {{ ucfirst(auth()->user()->first_name) .' '. ucfirst(auth()->user()->last_name) }}
                </a>
                <p class="text-body mt-1 mb-0 font-size-13">
                    {{ ucfirst(auth()->user()->type) }}
                </p>
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

               @if ($IS_ROOT OR auth()->user()->can('READ_CAR') 
               OR auth()->user()->can('READ_MARKA')
               OR auth()->user()->can('READ_OFFERS')
               OR auth()->user()->can('READ_FUELS')
               OR auth()->user()->can('READ_COLOR')
               OR auth()->user()->can('READ_CONDITIONS') )
                <li class="menu-title">
                    {!! __('maknon::main.cars_management') !!}
                </li>
                @if ($IS_ROOT OR auth()->user()->can('READ_CAR') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.cars') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_CAR') )
                        <li>
                            <a href="{{ route('cars.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_CAR') )
                        <li>
                            <a href="{{route('cars.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                 @if ($IS_ROOT OR auth()->user()->can('READ_COLOR') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.colors') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_COLOR') )
                        <li>
                            <a href="{{ route('colors.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_COLOR') )
                        <li>
                            <a href="{{route('colors.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                       @if ($IS_ROOT OR auth()->user()->can('READ_OFFERS') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.offers') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_OFFERS') )
                        <li>
                            <a href="{{ route('offers.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_OFFERS') )
                        <li>
                            <a href="{{route('offers.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                       @if ($IS_ROOT OR auth()->user()->can('READ_CONDITIONS') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.conditions') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_CONDITIONS') )
                        <li>
                            <a href="{{ route('conditions.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_CONDITIONS') )
                        <li>
                            <a href="{{route('conditions.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                       @if ($IS_ROOT OR auth()->user()->can('READ_FUELS') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.fuels') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_FUELS') )
                        <li>
                            <a href="{{ route('fuels.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_FUELS') )
                        <li>
                            <a href="{{route('fuels.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                       @if ($IS_ROOT OR auth()->user()->can('READ_MARKA') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.markas') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_MARKA') )
                        <li>
                            <a href="{{ route('markas.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_MARKA') )
                        <li>
                            <a href="{{route('markas.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($IS_ROOT OR auth()->user()->can('READ_CURRENCY') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('maknon::main.currency') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ($IS_ROOT OR auth()->user()->can('READ_CURRENCY') )
                        <li>
                            <a href="{{ route('currency.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ($IS_ROOT OR auth()->user()->can('CREATE_CURRENCY') )
                        <li>
                            <a href="{{route('colors.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @endif
                <!--------------------------------------->
             @if ($IS_ROOT OR auth()->user()->can('READ_CONTENTS') 
               OR auth()->user()->can('READ_CATEGORY')
               OR auth()->user()->can('READ_SUB_CATEGORY') )
                <li class="menu-title">
                    {!! __('cms::strings.cms_management') !!}
                </li>
                @if ( $IS_ROOT OR auth()->user()->can('READ_CONTENTS') OR auth()->user()->can('CREATE_CONTENTS') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('cms::strings.contents_management') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CONTENTS') )
                        <li>
                            <a href="{{ route('cms::contents.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CONTENTS') )
                        <li>
                            <a href="{{route('cms::contents.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                @if ( $IS_ROOT OR auth()->user()->can('READ_CATEGORY') OR auth()->user()->can('CREATE_CATEGORY') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('cms::strings.category_management') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_CATEGORY') )
                        <li>
                            <a href="{{ route('cms::categories.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_CATEGORY') )
                        <li>
                            <a href="{{route('cms::categories.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                {{--   @if ( $IS_ROOT OR auth()->user()->can('READ_SUB_CATEGORY') OR auth()->user()->can('CREATE_SUB_CATEGORY') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('cms::strings.sub_category_management') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_SUB_CATEGORY') )
                        <li>
                            <a href="{{ route('cms::sub_categories.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_SUB_CATEGORY') )
                        <li>
                            <a href="{{route('cms::sub_categories.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif --}}
                @endif
                <!----------------------------------------->
                @if ($IS_ROOT 
               OR auth()->user()->can('READ_ROLES')
               OR auth()->user()->can('READ_USERS')
              )
                <li class="menu-title">
                    {!! __('member::strings.users_and_permissions') !!}
                </li>
                @if ( $IS_ROOT OR auth()->user()->can('READ_USERS') OR auth()->user()->can('CREATE_USERS') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('member::strings.users') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_USERS') )
                        <li>
                            <a href="{{ route('member::users.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_USERS') )
                        <li>
                            <a href="{{route('member::users.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ( $IS_ROOT OR auth()->user()->can('READ_ROLES') OR auth()->user()->can('CREATE_ROLES') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('member::strings.roles') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_ROLES') )
                        <li>
                            <a href="{{ route('member::roles.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_ROLES') )
                        <li>
                            <a href="{{route('member::roles.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                    @if ( $IS_ROOT OR auth()->user()->can('READ_COUNTRIES') OR auth()->user()->can('CREATE_COUNTRIES') )
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            {!! __('member::strings.countries') !!}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        @if ( $IS_ROOT OR auth()->user()->can('READ_COUNTRIES') )
                        <li>
                            <a href="{{ route('member::countries.index') }}">
                                {!! trans_choice('member::strings.list_all', 0) !!}
                            </a>
                        </li>
                        @endif

                       @if ( $IS_ROOT OR auth()->user()->can('CREATE_COUNTRIES') )
                        <li>
                            <a href="{{route('member::countries.create')}}">
                                {!! __('member::strings.add_new') !!}
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
