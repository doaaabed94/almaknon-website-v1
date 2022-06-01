@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.users') !!} - {!! __('member::strings.update') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
            {!! __('member::strings.users') !!}
        @endslot
        @slot('li_1')
            {!! __('member::strings.account_information') !!}
        @endslot
    @endcomponent

   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{!! __('member::strings.account_information') !!}</h4>
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="{!! route('member::users.postUpdate', ['model' => $model->id]) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="model" value="{{ $model->id }}">
                        <div id="show_inline_general_error"></div>
                    
                         {{-- 
                            @include('member::common-components.inputs.image', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'avatar',
                                    'label'       => __('member::inputs.avatar.label'),
                                    'placeholder' => __('member::inputs.avatar.placeholder'),
                                    'value_src'   => app('GraphManager')->src('400x400', 'user', $model->avatar),
                                    'default_src' => app('GraphManager')->defaultSrc('400x400', 'user'),
                                    'value'       => old('avatar', $model->avatar)
                                ]
                            ]) --}}
                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'first_name',
                                    'label'       => __('member::inputs.first_name.label'),
                                    'placeholder' => __('member::inputs.first_name.placeholder'),
                                    'value'       => old('first_name', $model->first_name)
                                ]
                            ])
                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'last_name',
                                    'label'       => __('member::inputs.last_name.label'),
                                    'placeholder' => __('member::inputs.last_name.placeholder'),
                                    'value'       => old('last_name', $model->last_name)
                                ]
                            ])
                            @if(count($_ALL_LOCALES_) > 1)
                                @include('member::common-components.inputs.select', [
                                    'options' => [
                                        'size'        => 5,
                                        'view'        => 'INLINE',
                                        'name'        => 'user_locale',
                                        'label'       => __('member::inputs.locale.label'),
                                        'nullable'    => null,
                                        'nullable_v'  => null,
                                        'options'     => $_ALL_LOCALES_,
                                        'text'        => function($K, $V){
                                            return $V['native'];
                                        },
                                        'values'      => function($K, $V){
                                            return $K;
                                        },
                                        'select'      => function($K, $V, $value){
                                            return $K == $value;
                                        },
                                        'value'       => old('user_locale', $model->locale)
                                    ]
                                ])
                            @endif

                            @if($CurrentUser->can('PERMISSIONS_UPDATE_USERS') OR $CurrentUser->isAn('ROOT'))
                                @include('member::common-components.inputs.select', [
                                    'options' => [
                                        'size'        => 4,
                                        'searchable'  => true,
                                        'view'        => 'INLINE',
                                        'name'        => 'roles',
                                        'label'       => __('member::inputs.roles.label'),
                                        'nullable'    => __('member::inputs.roles.placeholder'),
                                        'nullable_v'  => null,
                                        'options'     => $Roles,
                                        'text'        => function($K, $V){
                                            return $V->SmartTranslation('title', app()->getLocale());
                                        },
                                        'subText'     => function($K, $V){
                                            return $V->SmartTranslation('description', app()->getLocale());
                                        },
                                        'values'      => function($K, $V){
                                            return $V->name;
                                        },
                                        'select'      => function($K, $V, $value){
                                            if(empty($value)){
                                                return false;
                                            }
                                            return $V->name == $value;
                                        },
                                        'value'       => old('roles', empty($vv = $model->roles->first()) ? null : $vv->name)
                                    ]
                                ])
                            @endif

                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'username',
                                    'label'       => __('member::inputs.username.label'),
                                    'placeholder' => __('member::inputs.username.placeholder'),
                                    'value'       => old('username', $model->username)
                                ]
                            ])
                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'email',
                                    'label'       => __('member::inputs.email.label'),
                                    'placeholder' => __('member::inputs.email.placeholder'),
                                    'value'       => old('email', $model->email)
                                ]
                            ])

                         {{--  @include('member::common-components.inputs.select', [
                                'options' => [
                                    'size'        => 7,
                                    'searchable'  => true,
                                    'view'        => 'INLINE',
                                    'name'        => 'country',
                                    'label'       => __('member::inputs.country.label'),
                                    'nullable'    => __('member::inputs.country.placeholder'),
                                    'nullable_v'  => null,
                                    'options'     => $Countries,
                                    'option_attr' => function($K, $V){
                                        return 'data-dial="'. $V->dial_code .'"';
                                    },
                                    'text'        => function($K, $V){
                                        return $V->translateOrFirst(app()->getLocale())->name;
                                    },
                                    'values'      => function($K, $V){
                                        return $V->id;
                                    },
                                    'select'      => function($K, $V, $value){
                                        return $V->id == $value;
                                    },
                                    'value'       => old('country', $model->country_id)
                                ]
                            ])

                            @include('member::common-components.inputs.select', [
                                'options' => [
                                    'container_class' => 'city-container',
                                    'size'        => 7,
                                    'searchable'  => true,
                                    'view'        => 'INLINE',
                                    'name'        => 'city',
                                    'label'       => __('member::inputs.city.label'),
                                    'nullable'    => __('member::inputs.city.placeholder'),
                                    'nullable_v'  => null,
                                    'options'     => !old('country', $model->country_id) ? [] : \Modules\Member\Entities\City::where('country_id', old('country', $model->country_id))->with('translations', 'Country')->get(),
                                    'text'        => function($K, $V)use($locale){
                                        return $V->__('name', $locale);
                                    },
                                    'subText'     => function($K, $V)use($locale){
                                        return !$V->Country ? null : $V->Country->iso_2;
                                    },
                                    'values'      => function($K, $V){
                                        return $V->id;
                                    },
                                    'select'      => function($K, $V, $value){
                                        return $V->id == $value;
                                    },
                                    'value'       => old('city', $model->city_id)
                                ]
                            ])

                               @include('member::common-components.inputs.datepicker', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'birthday',
                                    'label'       => __('member::inputs.birthday.label'),
                                    'placeholder' => __('member::inputs.birthday.placeholder'),
                                    'value'       => old('birthday', empty($model->birthday) ? null : \Carbon\Carbon::parse($model->birthday)->format('Y-m-d'))
                                ]
                            ])  


                        --}}
                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'phone_number',
                                    'label'       => __('member::inputs.phone_number.label') . ' <span class="text-success dial_code"></span>',
                                    'placeholder' => __('member::inputs.phone_number.placeholder'),
                                    'value'       => old('phone_number', $model->phone_number)
                                ]
                            ])

                            @include('member::common-components.inputs.textarea', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'address',
                                    'label'       => __('member::inputs.address.label'),
                                    'placeholder' => __('member::inputs.address.placeholder'),
                                    'value'       => old('address', $model->address)
                                ]
                            ]) 


                            @include('member::common-components.inputs.select', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'gender',
                                    'label'       => __('member::inputs.gender.label'),
                                    'nullable'    => __('member::inputs.gender.placeholder'),
                                    'nullable_v'  => null,
                                    'options'     => [
                                        [
                                            'value' => 'M',
                                            'text'  => __('member::strings.male'),
                                        ],
                                        [
                                            'value' => 'F',
                                            'text'  => __('member::strings.female'),
                                        ],
                                        [
                                            'value' => 'U',
                                            'text'  => __('member::strings.unspecified'),
                                        ]
                                    ],
                                    'text'        => function($K, $V){
                                        return $V['text'];
                                    },
                                    'values'      => function($K, $V){
                                        return $V['value'];
                                    },
                                    'select'      => function($K, $V, $value){
                                        return $V['value'] == $value;
                                    },
                                    'value'       => old('gender', $model->gender)
                                ]
                            ])

                          
                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'type'        => 'password',
                                    'view'        => 'INLINE',
                                    'name'        => 'password',
                                    'label'       => __('member::inputs.password.label'),
                                    'placeholder' => __('member::inputs.password.placeholder'),
                                    'value'       => null
                                ]
                            ])

                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'type'        => 'password',
                                    'view'        => 'INLINE',
                                    'name'        => 'password_confirmation',
                                    'label'       => __('member::inputs.password_confirmation.label'),
                                    'placeholder' => __('member::inputs.password_confirmation.placeholder'),
                                    'value'       => null
                                ]
                            ])

                            @if($CurrentUser->can('STATUS_UPDATE_USERS') OR $CurrentUser->isAn('ROOT'))
                                @include('member::common-components.inputs.select', [
                                    'options' => [
                                        'size'        => 5,
                                        'view'        => 'INLINE',
                                        'name'        => 'status',
                                        'label'       => __('member::inputs.status.label'),
                                        'nullable'    => null,
                                        'nullable_v'  => null,
                                        'options'     => [
                                            [
                                                'value' => 'ACTIVE',
                                                'text'  => __('member::strings.active'),
                                            ],
                                            [
                                                'value' => 'DISABLED',
                                                'text'  => __('member::strings.disabled'),
                                            ]
                                        ],
                                        'text'        => function($K, $V){
                                            return $V['text'];
                                        },
                                        'values'      => function($K, $V){
                                            return $V['value'];
                                        },
                                        'select'      => function($K, $V, $value){
                                            return $V['value'] == $value;
                                        },
                                        'value'       => old('status', $model->status)
                                    ]
                                ])
                            @endif

                             <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="saveBtn" type="submit">
                                    {!! __('member::strings.save') !!}
                                </button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>

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

