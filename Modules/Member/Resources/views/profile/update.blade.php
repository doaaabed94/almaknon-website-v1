@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.profile') !!} - {!! __('member::strings.update') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
            {!! __('member::strings.my_profile') !!}
        @endslot
    @endcomponent

   <div class="row">
        <div class="col-12">
            <div class="card">                
                <div class="card-body">
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="{!! route('member::ProfileController@postUpdate') !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="model" value="{{ $model->id }}">
                        <div id="show_inline_general_error"></div>
                    
                             @include('member::common-components.inputs.image', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'avatar',
                                        'label'       => __('member::inputs.avatar.label'),
                                        'placeholder' => __('member::inputs.avatar.placeholder'),
                                        'value_src'   => '',
                                        'default_src' => '',
                                        'value'       => old('avatar', $model->avatar)
                                    ]
                                ])
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
                                

                                {{-- @include('member::common-components.inputs.select', [
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
                                            return $V->SmartTranslation('name', app()->getLocale());
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
                                        'options'     => !old('country', $model->country_id) ? [] : \Modules\Admin\Entities\City::where('country_id', old('country', $model->country_id))->with('translations', 'Country')->get(),
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
                                ]) --}}

                                @include('member::common-components.inputs.text', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'phone_number',
                                        'label'       => __('member::inputs.phone_number.label') . ' <span class="text-success dial_code"></span>',
                                        'placeholder' => __('member::inputs.phone_number.placeholder'),
                                        'value'       => old('phone_number', $model->phone_number)
                                    ]
                                ])

                                {{-- @include('member::common-components.inputs.textarea', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'address',
                                        'label'       => __('member::inputs.address.label'),
                                        'placeholder' => __('member::inputs.address.placeholder'),
                                        'value'       => old('address', $model->address)
                                    ]
                                ]) --}}
                                
                                {{-- <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>

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
                                
                                @include('member::common-components.inputs.datepicker', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'birthday',
                                        'label'       => __('member::inputs.birthday.label'),
                                        'placeholder' => __('member::inputs.birthday.placeholder'),
                                        'value'       => old('birthday', empty($model->birthday) ? null : \Carbon\Carbon::parse($model->birthday)->format('Y-m-d'))
                                    ]
                                ]) --}}

                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                
                                @include('member::common-components.inputs.text', [
                                    'options' => [
                                        'type'        => 'password',
                                        'view'        => 'INLINE',
                                        'name'        => 'current_password',
                                        'label'       => __('member::inputs.current_password.label'),
                                        'placeholder' => __('member::inputs.current_password.placeholder'),
                                        'value'       => null
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
                     


                    
                             <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="updateBtn" type="submit">
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
   
@endsection

