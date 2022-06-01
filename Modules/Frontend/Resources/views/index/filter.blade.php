    <section class="b-search">
        <div class="container">
            <form action="{{ route('CarController@filter') }}" method="POST" class="b-search__main">
                <div class="b-search__main-form wow zoomInUp" data-wow-delay="0.3s">
                    <div class="row">
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
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
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
                                        'value' => old('markas')
                                            ],
                                ]
                            )

                       {{--      @include(
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
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
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
                                        'value' => old('offers')
                                            ],
                                ]
                            ) --}}

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
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
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
                                        'value' => old('conditions')
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
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
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
                                        'value' => old('fuels')
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
                                        'searchable' => true,
                                        'label' => __('maknon::main.transmission'),
                                        'nullable' =>__('maknon::inputs.transmission.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                        'options' => [
                                            [
                                                'value' => 'yes',
                                                'text' => __('maknon::main.manual'),
                                            ], 
                                            [
                                                'value' => 'no',
                                                'text' => __('maknon::main.automatic'),
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
                                        'value' => old('transmission'),
                                    ],
                                ]
                            )

                             @php 
                                $current_year = date('Y')+1;
                                $date_range = range($current_year, $current_year-100);
                                @endphp
                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'min_year',
                                        'searchable' => true,
                                        'label' => __('maknon::inputs.min_year.label'),
                                        'nullable' =>__('maknon::inputs.min_year.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                        'options' => $date_range,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V;
                                            },
                                        'values' => function($K, $V){
                                                return $V;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V == $value;
                                            },
                                        'value' => old('min_year')
                                            ],
                                ]
                            )
                           @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'max_year',
                                        'searchable' => true,
                                        'label' => __('maknon::inputs.max_year.label'),
                                        'nullable' =>__('maknon::inputs.max_year.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                        'options' => $date_range,
                                        'option_attr' => function($K, $V){
                                                return 'data-dial="'. $V .'"';
                                            },
                                        'text' => function($K, $V){
                                                return $V;
                                            },
                                        'values' => function($K, $V){
                                                return $V;
                                            },
                                        'select' => function($K, $V, $value){
                                                return $V == $value;
                                            },
                                        'value' => old('max_year')
                                            ],
                                ]
                            )
                               @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'min_price',
                                    'label' => __('maknon::inputs.min_price.label'),
                                    'placeholder' => __('maknon::inputs.min_price.placeholder'),
                                    'value' => old('max_price'),
                                      'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                ],
                            ])

                               @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'max_price',
                                    'label' => __('maknon::inputs.max_price.label'),
                                    'placeholder' => __('maknon::inputs.max_price.placeholder'),
                                    'value' => old('max_price'),
                                        'container_class' => 'col-lg-4 col-md-6  filter-div',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                ],
                            ])

                        <div class="col-md-4 col-xs-12 text-left s-noPadding">
                            <!-- <div class="b-search__main-form-range">
                                <label>{{ __('frontend::main.PRICE RANGE')}} </label>
                                <div class="slider"></div>
                                <input type="hidden" name="min" class="j-min" />
                                <input type="hidden" name="max" class="j-max" />
                            </div> -->
                            <div class="b-search__main-form-submit">
                                <button type="submit" class="btn m-btn">{{ __('frontend::main.search') }} <span class="fa fa-angle-right"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--b-search-->

    <style type="text/css">
        .b-search__main-form input {
    width: 100%;
    padding: 10px 20px 10px 25px;
    border: 1px solid #eeeeee;
    border-radius: 30px;
    font: 400 13px 'Open Sans', sans-serif;
    background: transparent;
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none !important;
    cursor: pointer;
}
@media screen and (max-width: 599px){
.b-search__main {
    padding: 20px !important;
}
/*.filter-div{
    width: 50%;
}*/

} 
.b-search {
    margin-top: -160px;
}
  </style>