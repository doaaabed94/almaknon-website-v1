                        @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'marka_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.marka'),
                                        'nullable' =>__('maknon::inputs.marka.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-6',
                                        'options' => $markas,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V->id .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V->__('name', app()->getLocale());
                                            },
                                        'values' => function($K, $V){
                                                return $V->id;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V->id == $value;
                                            },
                                        'value' => old('markas',$data->marka_id)
                                            ],
                                ]
                            )

                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'offer_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.offer'),
                                        'nullable' =>__('maknon::inputs.offer.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-6',
                                        'options' => $offers,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V->id .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V->__('name', app()->getLocale());
                                            },
                                        'values' => function($K, $V){
                                                return $V->id;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V->id == $value;
                                            },
                                        'value' => old('offers',$data->offer_id)
                                            ],
                                ]
                            )

                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'condition_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.condition'),
                                        'nullable' =>__('maknon::inputs.condition.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-6',
                                        'options' => $conditions,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V->id .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V->__('name', app()->getLocale());
                                            },
                                        'values' => function($K, $V){
                                                return $V->id;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V->id == $value;
                                            },
                                        'value' => old('conditions',$data->condition_id)
                                            ],
                                ]
                            )

                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'fuel_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.fuel'),
                                        'nullable' =>__('maknon::inputs.fuel.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-6',
                                        'options' => $fuels,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V->id .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V->__('name', app()->getLocale());
                                            },
                                        'values' => function($K, $V){
                                                return $V->id;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V->id == $value;
                                            },
                                        'value' => old('fuels',$data->fuel_id)
                                            ],
                                ]
                            )

                          
                             @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'transmission',
                                        'label' => __('maknon::inputs.transmission.label'),
                                        'nullable' => null,
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-6',
                                        'options' => [
                                            [
                                                'value' => 'yes',
                                                'text' => __('maknon::main.yes'),
                                            ],
                                            [
                                                'value' => 'no',
                                                'text' => __('maknon::main.no'),
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
                                        'value' => old('transmission',$data->transmission),
                                    ],
                                ]
                            )


                           @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'years',
                                    'label' => __('maknon::inputs.years.label'),
                                    'placeholder' => __('maknon::inputs.years.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('years',$data->years),
                                ],
                            ])

                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'kilometer',
                                    'label' => __('maknon::inputs.kilometer.label'),
                                    'placeholder' => __('maknon::inputs.kilometer.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('kilometer',$data->kilometer),
                                ],
                            ])
                              @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'color_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.color'),
                                        'nullable' =>__('maknon::inputs.color.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4',
                                        'options' => $colors,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V->id .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V->__('name', app()->getLocale());
                                            },
                                        'values' => function($K, $V){
                                                return $V->id;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V->id == $value;
                                            },
                                        'value' => old('color_id',$data->color_id)
                                            ],
                                ]
                            )
                        <div class="col-md-6">
                        </div>
                        <hr style="width: 100%">
                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'currency_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.currency'),
                                        'nullable' =>__('maknon::inputs.currency.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4',
                                        'options' => $currencies,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V->id .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V->__('name', app()->getLocale());
                                            },
                                        'values' => function($K, $V){
                                                return $V->id;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V->id == $value;
                                            },
                                        'value' => old('currency_id',$data->currency_id)
                                            ],
                                ]
                            )
                             @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'price',
                                    'label' => __('maknon::inputs.price.label'),
                                    'placeholder' => __('maknon::inputs.price.placeholder'),
                                        'container_class' => 'col-lg-4',
                                    'value' => old('price',$data->price),
                                ],
                            ])

                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'price_after',
                                    'label' => __('maknon::inputs.price_after.label'),
                                    'placeholder' => __('maknon::inputs.price_after.placeholder'),
                                        'container_class' => 'col-lg-4',
                                    'value' => old('price_after',$data->price_after),
                                ],
                            ])
                            <hr>
                 