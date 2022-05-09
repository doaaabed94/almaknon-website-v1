    <section class="b-search">
        <div class="container">
            <form action="listings.html" method="POST" class="b-search__main">
                <div class="b-search__main-form wow zoomInUp" data-wow-delay="0.3s">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">

                                <?php echo $__env->make(
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
                                        'container_class' => 'col-lg-4',
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
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                       

                            <?php echo $__env->make(
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
                                        'container_class' => 'col-lg-4',
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
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make(
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
                                        'container_class' => 'col-lg-4',
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
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                             <?php echo $__env->make(
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
                                        'container_class' => 'col-lg-4',
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
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                             <?php 
                                $current_year = date('Y');
                                $date_range = range($current_year, $current_year-100);
                                ?>
                            <?php echo $__env->make(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'max_price',
                                        'searchable' => true,
                                        'label' => __('maknon::inputs.max_price.label'),
                                        'nullable' =>__('maknon::inputs.max_price.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4',
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
                                        'value' => old('max_price')
                                            ],
                                ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php echo $__env->make(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'min_price',
                                        'searchable' => true,
                                        'label' => __('maknon::inputs.min_price.label'),
                                        'nullable' =>__('maknon::inputs.min_price.placeholder'),
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-4',
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
                                        'value' => old('min_price')
                                            ],
                                ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md-4 col-xs-12 text-left s-noPadding">
                            <div class="b-search__main-form-range">
                                <label>PRICE RANGE</label>
                                <div class="slider"></div>
                                <input type="hidden" name="min" class="j-min" />
                                <input type="hidden" name="max" class="j-max" />
                            </div>
                            <div class="b-search__main-form-submit">
                                <button type="submit" class="btn m-btn">Search the Vehicle<span class="fa fa-angle-right"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--b-search--><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Frontend/Resources/views/index/filter.blade.php ENDPATH**/ ?>