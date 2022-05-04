@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.users') !!} - {!! __('member::strings.add_new') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
            {!! __('member::strings.users') !!}
        @endslot
        @slot('li_1')
            {!! __('member::strings.add_new') !!}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{!! __('member::strings.add_new') !!}</h4>
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="{!! route('member::users.postCreate') !!}" method="POST">
                        {!! csrf_field() !!}
                        <div id="show_inline_general_error"></div>
                                    {{-- @include('member::common-components.inputs.image', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'avatar',
                                            'label' => __('member::inputs.avatar.label'),
                                            'placeholder' => __('member::inputs.avatar.placeholder'),
                                            //'default_src' => app('GraphManager')->defaultSrc('400x400', 'user'),
                                            'value' => old('avatar'),
                                        ],
                                    ]) --}}
                                    @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'first_name',
                                            'label' => __('member::inputs.first_name.label'),
                                            'placeholder' => __('member::inputs.first_name.placeholder'),
                                            'value' => old('first_name'),
                                        ],
                                    ])
                                    @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'last_name',
                                            'label' => __('member::inputs.last_name.label'),
                                            'placeholder' => __('member::inputs.last_name.placeholder'),
                                            'value' => old('last_name'),
                                        ],
                                    ])
                                    @if (count($_ALL_LOCALES_) > 1)
                                        @include(
                                            'member::common-components.inputs.select',
                                            [
                                                'options' => [
                                                    'size' => 5,
                                                    'view' => 'INLINE',
                                                    'name' => 'user_locale',
                                                    'label' => __('member::inputs.locale.label'),
                                                    'nullable' => null,
                                                    'nullable_v' => null,
                                                    'options' => $_ALL_LOCALES_,
                                                    'text' => function ($K, $V) {
                                                        return $V['native'];
                                                    },
                                                    'values' => function ($K, $V) {
                                                        return $K;
                                                    },
                                                    'select' => function ($K, $V, $value) {
                                                        return $K == $value;
                                                    },
                                                    'value' => old('user_locale', app()->getLocale()),
                                                ],
                                            ]
                                        )
                                    @endif

                                    @if ($CurrentUser->can('PERMISSIONS_UPDATE_USERS') or $CurrentUser->isAn('ROOT'))
                                        @include(
                                            'member::common-components.inputs.select',
                                            [
                                                'options' => [
                                                    'size' => 4,
                                                    'searchable' => true,
                                                    'view' => 'INLINE',
                                                    'name' => 'roles',
                                                    'label' => __('member::inputs.roles.label'),
                                                    'nullable' => __('member::inputs.roles.placeholder'),
                                                    'nullable_v' => null,
                                                    'options' => $Roles,
                                                    'text' => function ($K, $V) {
                                                        return $V->__('title', app()->getLocale());
                                                    },
                                                    'subText' => function ($K, $V) {
                                                        return $V->__('description', app()->getLocale());
                                                    },
                                                    'values' => function ($K, $V) {
                                                        return $V->name;
                                                    },
                                                    'select' => function ($K, $V, $value) {
                                                        return $V->name == $value;
                                                    },
                                                    'value' => old('roles'),
                                                ],
                                            ]
                                        )
                                    @endif


                                    @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'username',
                                            'label' => __('member::inputs.username.label'),
                                            'placeholder' => __('member::inputs.username.placeholder'),
                                            'value' => old('username'),
                                        ],
                                    ])
                                    @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'email',
                                            'label' => __('member::inputs.email.label'),
                                            'placeholder' => __('member::inputs.email.placeholder'),
                                            'value' => old('email'),
                                        ],
                                    ])



                              {{-- @include('member::common-components.inputs.select', [
                                        'options' => [
                                            'size' => 7,
                                            'searchable' => true,
                                            'view' => 'INLINE',
                                            'name' => 'country',
                                            'label' => __('member::inputs.country.label'),
                                            'nullable' => __('member::inputs.country.placeholder'),
                                            'nullable_v' => null,
                                            'options' => $Countries,
                                            'option_attr' => function ($K, $V) {
                                                return 'data-dial="' . $V->dial_code . '"';
                                            },
                                            'text' => function ($K, $V) {
                                                return $V->SmartTranslation('name', app()->getLocale());
                                            },
                                            'values' => function ($K, $V) {
                                                return $V->id;
                                            },
                                            'select' => function ($K, $V, $value) {
                                                return $V->id == $value;
                                            },
                                            'value' => old('country'),
                                        ],
                                    ])

                                    @include('member::common-components.inputs.select', [
                                        'options' => [
                                            'container_class' => 'city-container',
                                            'size' => 7,
                                            'searchable' => true,
                                            'view' => 'INLINE',
                                            'name' => 'city',
                                            'label' => __('member::inputs.city.label'),
                                            'nullable' => __('member::inputs.city.placeholder'),
                                            'nullable_v' => null,
                                            'options' => !old('country')
                                                ? []
                                                : \Modules\Admin\Entities\City::where(
                                                    'country_id',
                                                    old('country')
                                                )->with('translations', 'Country')->get(),
                                            'text' => function ($K, $V) use ($locale) {
                                                return $V->SmartTranslation('name', $locale);
                                            },
                                            'subText' => function ($K, $V) use ($locale) {
                                                return !$V->Country ? null : $V->Country->iso_2;
                                            },
                                            'values' => function ($K, $V) {
                                                return $V->id;
                                            },
                                            'select' => function ($K, $V, $value) {
                                                return $V->id == $value;
                                            },
                                            'value' => old('city'),
                                        ],
                                    ])

                                 @include(
                                        'member::common-components.inputs.datepicker',
                                        [
                                            'options' => [
                                                'view' => 'INLINE',
                                                'name' => 'birthday',
                                                'label' => __('member::inputs.birthday.label'),
                                                'placeholder' => __('member::inputs.birthday.placeholder'),
                                                'value' => old('birthday'),
                                            ],
                                        ]
                                    )
                                    --}}

                                    @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'phone_number',
                                            'label' =>
                                                __('member::inputs.phone_number.label') .
                                                ' <span class="text-success dial_code"></span>',
                                            'placeholder' => __('member::inputs.phone_number.placeholder'),
                                            'value' => old('phone_number'),
                                        ],
                                    ])

                                    @include(
                                        'member::common-components.inputs.textarea',
                                        [
                                            'options' => [
                                                'view' => 'INLINE',
                                                'name' => 'address',
                                                'label' => __('member::inputs.address.label'),
                                                'placeholder' => __('member::inputs.address.placeholder'),
                                                'value' => old('address'),
                                            ],
                                        ]
                                    )



                                    @include('member::common-components.inputs.select', [
                                        'options' => [
                                            'view' => 'INLINE',
                                            'name' => 'gender',
                                            'label' => __('member::inputs.gender.label'),
                                            'nullable' => __('member::inputs.gender.placeholder'),
                                            'nullable_v' => null,
                                            'options' => [
                                                [
                                                    'value' => 'M',
                                                    'text' => __('member::strings.male'),
                                                ],
                                                [
                                                    'value' => 'F',
                                                    'text' => __('member::strings.female'),
                                                ],
                                                [
                                                    'value' => 'U',
                                                    'text' => __('member::strings.unspecified'),
                                                ],
                                            ],
                                            'text' => function ($K, $V) {
                                                return $V['text'];
                                            },
                                            'values' => function ($K, $V) {
                                                return $V['value'];
                                            },
                                            'select' => function ($K, $V, $value) {
                                                return $V['value'] == $value;
                                            },
                                            'value' => old('gender'),
                                        ],
                                    ])


                               @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'type' => 'password',
                                            'view' => 'INLINE',
                                            'name' => 'password',
                                            'label' => __('member::inputs.password.label'),
                                            'placeholder' => __('member::inputs.password.placeholder'),
                                            'value' => old('password'),
                                        ],
                                    ])

                                    @include('member::common-components.inputs.text', [
                                        'options' => [
                                            'type' => 'password',
                                            'view' => 'INLINE',
                                            'name' => 'password_confirmation',
                                            'label' => __('member::inputs.password_confirmation.label'),
                                            'placeholder' => __(
                                                'member::inputs.password_confirmation.placeholder'
                                            ),
                                            'value' => old('password_confirmation'),
                                        ],
                                    ])



                                    @if ($CurrentUser->can('STATUS_UPDATE_USERS') or $CurrentUser->isAn('ROOT'))
                                        @include(
                                            'member::common-components.inputs.select',
                                            [
                                                'options' => [
                                                    'size' => 5,
                                                    'view' => 'INLINE',
                                                    'name' => 'status',
                                                    'label' => __('member::inputs.status.label'),
                                                    'nullable' => null,
                                                    'nullable_v' => null,
                                                    'options' => [
                                                        [
                                                            'value' => 'ACTIVE',
                                                            'text' => __('member::strings.active'),
                                                        ],
                                                        [
                                                            'value' => 'DISABLED',
                                                            'text' => __('member::strings.disabled'),
                                                        ],
                                                    ],
                                                    'text' => function ($K, $V) {
                                                        return $V['text'];
                                                    },
                                                    'values' => function ($K, $V) {
                                                        return $V['value'];
                                                    },
                                                    'select' => function ($K, $V, $value) {
                                                        return $V['value'] == $value;
                                                    },
                                                    'value' => old('status', 'ACTIVE'),
                                                ],
                                            ]
                                        )
                                    @endif

                                    {{-- @include('member::common-components.inputs.checkbox', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'send_confirmation_by_email',
                                    'label'       => __('member::inputs.send_confirmation_by_email.label'),
                                    'input_label' => __('member::inputs.send_confirmation_by_email.input_label'),
                                    'help'        => ' - ' . __('member::inputs.send_confirmation_by_email.help'),
                                    'value'       => old('send_confirmation_by_email')
                                ]
                            ])

                            @include('member::common-components.inputs.checkbox', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'send_confirmation_by_sms',
                                    'input_label' => __('member::inputs.send_confirmation_by_sms.input_label'),
                                    'help'        => ' - ' . __('member::inputs.send_confirmation_by_sms.help'),
                                    'value'       => old('send_confirmation_by_sms')
                                ]
                            ]) --}}

                            <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="saveBtn" type="submit">
                                    {!! __('member::strings.save') !!}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection


@section('script')
    <script>
        $(document).on('change', 'select[name=country]', function(){
            if(!$(this).val()){
                return;
            }
            var country_id           = $(this).val(),
                city_input_container = $(this).closest('form').find('.city-container').first(),
                dial_code            = $('[name=country]').find(`[value=${country_id}]`).data('dial');
                $('.dial_code').html(`(+${dial_code})`);
            city_input_container.html("");
            $.ajax({
                url    : "{!! route('member::CityController@ajaxList') !!}",
                data : {
                    country_id: country_id
                },
                statusCode: {
                    200: function(data) {
                        var E = `
                            <select name="city" class="form-control kt-selectpicker" data-live-search="true" data-size="7">
                        `;
                        E += `
                            <option value="">
                                {{ __('member::inputs.city.placeholder') }}
                            </option>
                        `;
                        $.each(data, function(k, v){
                            E += `
                                <option value="${v.value}" data-subtext="${v.subText}">
                                    ${v.text}
                                </option>
                            `;
                        });
                        E += `
                            </select>
                        `;
                        city_input_container.html(E);
                        $(".kt-selectpicker").selectpicker();
                    }
                }
            });
        });
    </script>
@endsection
