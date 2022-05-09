<?php $__env->startSection('title'); ?>
<?php echo __('maknon::main.cars_list'); ?> - <?php echo __('member::strings.add_new'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('member::common-components.breadcrumb'); ?>
<?php $__env->slot('title'); ?>
<a href="<?php echo e(route('cars.index')); ?>" > <?php echo __('maknon::main.cars_list'); ?> </a>
<?php $__env->endSlot(); ?>
<?php $__env->slot('li_1'); ?>
<?php echo __('member::strings.add_new'); ?>

<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo __('member::strings.add_new'); ?></h4>
                <form class="crud-ajax-form form-wizard-wrapper needs-validation action-ajax-form" action="#" method="POST">
                    <?php echo csrf_field(); ?>

                    <div id="show_inline_general_error"></div>

                    <div class="row">

                            <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'slug',
                                    'label' => __('maknon::inputs.slug.label'),
                                    'placeholder' => __('maknon::inputs.slug.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('slug'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
                            
                              <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'order',
                                    'label' => __('maknon::inputs.order.label'),
                                    'placeholder' => __('maknon::inputs.order.placeholder'),
                                    'value' => old('order'),
                                        'container_class' => 'col-lg-6',
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'show_in_site',
                                        'label' => __('maknon::inputs.show_in_site.label'),
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
                                        'value' => old('show_in_site'),
                                    ],
                                ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-lg-12 mb-5">


                            <ul class="nav nav-tabs" role="tablist">
                                <?php $__currentLoopData = $_ALL_LOCALES_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e($_LOCALE_BASE_CODE == $locale ? 'active' : ''); ?> lang_tab_<?php echo e($_LOCALE_BASE_CODE); ?>"
                                    data-toggle="tab" href="#kt_tabs_<?php echo e($_LOCALE_BASE_CODE); ?>">
                                    <img src="<?php echo e(\Module::asset('member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg')); ?>"
                                    alt="" style="width: 20px;">
                                    <?php echo e($_LOCALE_DETAILS['native']); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content">
                            <?php $__currentLoopData = $_ALL_LOCALES_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane <?php echo e($_LOCALE_BASE_CODE == $locale ? 'active' : ''); ?>"
                            id="kt_tabs_<?php echo e($_LOCALE_BASE_CODE); ?>" role="tabpanel">
                            <div class="mt-3">
                                <?php echo $__env->make(
                                'member::common-components.inputs.text',
                                [
                                'options' => [
                                'name' => 'name[' . $_LOCALE_BASE_CODE . ']',
                                'view' => 'INLINE',
                                'label' =>
                                __('maknon::inputs.title.label') .
                                ' <span class="text-danger"> [' .
                                    $_LOCALE_BASE_CODE .
                                    '] <span>',
                                        'placeholder' => __(
                                        'maknon::inputs.title.placeholder'
                                        ),
                                        'help' => __('maknon::inputs.title.help'),
                                        'value' => old(
                                        'title[' . $_LOCALE_BASE_CODE . ']'
                                        ),
                                        'attr' =>
                                        'data-on-validation-error-click=".lang_tab_' .
                                        $_LOCALE_BASE_CODE .
                                        '"',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                        ],
                                        ]
                                        , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>

                                    <?php echo $__env->make(
                                    'member::common-components.inputs.tinymce',
                                    [
                                    'options' => [
                                    'name' =>
                                    'description[' . $_LOCALE_BASE_CODE . ']',
                                    'view' => 'INLINE',
                                    'label' =>
                                    __('maknon::inputs.description.label') .
                                    ' <span class="text-danger"> [' .
                                        $_LOCALE_BASE_CODE .
                                    '] </span>',
                                    'placeholder' => __(
                                    'maknon::inputs.description.placeholder'
                                    ),
                                    'help' => __('maknon::inputs.description.help'),
                                    'value' => old(
                                    'description[' . $_LOCALE_BASE_CODE . ']'
                                    ),
                                    'rows' => 20,
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                    ],
                                    ]
                                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                  
                            <div class="row"> 
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
                                        'value' => old('offers')
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
                                        'value' => old('transmission'),
                                    ],
                                ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                           <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'years',
                                    'label' => __('maknon::inputs.years.label'),
                                    'placeholder' => __('maknon::inputs.years.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('years'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'kilometer',
                                    'label' => __('maknon::inputs.kilometer.label'),
                                    'placeholder' => __('maknon::inputs.kilometer.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('kilometer'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="col-md-6"></div>

                      <hr>



                            <?php echo $__env->make(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'color_id',
                                        'searchable' => true,
                                        'label' => __('maknon::main.currency'),
                                        'nullable' =>__('maknon::inputs.currency.placeholder'),
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
                                        'value' => old('color_id')
                                            ],
                                ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                             <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'price',
                                    'label' => __('maknon::inputs.price.label'),
                                    'placeholder' => __('maknon::inputs.price.placeholder'),
                                        'container_class' => 'col-lg-4',
                                    'value' => old('price'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'price_after',
                                    'label' => __('maknon::inputs.price_after.label'),
                                    'placeholder' => __('maknon::inputs.price_after.placeholder'),
                                        'container_class' => 'col-lg-4',
                                    'value' => old('price_after'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                            <hr>
                        <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'meta_title',
                                    'label' => __('maknon::inputs.meta_title.label'),
                                    'placeholder' => __('maknon::inputs.meta_title.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('meta_title'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'meta_keyword',
                                    'label' => __('maknon::inputs.meta_keyword.label'),
                                    'placeholder' => __('maknon::inputs.meta_keyword.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('meta_keyword'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       
                            <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'meta_description',
                                    'label' => __('maknon::inputs.meta_description.label'),
                                    'placeholder' => __('maknon::inputs.meta_description.placeholder'),
                                        'container_class' => 'col-lg-12',
                                    'value' => old('meta_description'),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           

</div>

  <?php if($CurrentUser->can('STATUS_UPDATE_CAR') or $CurrentUser->isAn('ROOT')): ?>
                        <?php echo $__env->make(
                        'member::common-components.inputs.select',
                        [
                        'options' => [
                        'view' => 'DEFAULT',
                        'name' => 'status',
                        'label' => __('member::inputs.status.label'),
                        'nullable' => null,
                        'nullable_v' => null,
                        'container_class' => 'col-lg-6',
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
                        , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                    <div class="col-lg-2 col-xl-2 m-auto d-flex mt-5">
                        <a href="<?php echo e(route('cars.index')); ?>" class="btn btn-success btn-back mr-2 ml-2 mt-5 w-50">
                            <?php echo __('member::strings.back'); ?>

                        </a>
                        <button class="btn btn-primary btn-block btn-m mr-2 ml-2 mt-5 w-50" id="saveBtn" type="submit">
                            <?php echo __('member::strings.save'); ?>

                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




             <!--    <form id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                    <h3>Seller Details</h3>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Contact Person</label>
                                    <div class="col-lg-9">
                                        <input id="txtFirstNameBilling" name="txtFirstNameBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtLastNameBilling" class="col-lg-3 col-form-label">Mobile No.</label>
                                    <div class="col-lg-9">
                                        <input id="txtLastNameBilling" name="txtLastNameBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtCompanyBilling" class="col-lg-3 col-form-label">Landline No.</label>
                                    <div class="col-lg-9">
                                        <input id="txtCompanyBilling" name="txtCompanyBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtEmailAddressBilling" class="col-lg-3 col-form-label">Email Address</label>
                                    <div class="col-lg-9">
                                        <input id="txtEmailAddressBilling" name="txtEmailAddressBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtAddress1Billing" class="col-lg-3 col-form-label">Address 1</label>
                                    <div class="col-lg-9">
                                        <textarea id="txtAddress1Billing" name="txtAddress1Billing" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtAddress2Billing" class="col-lg-3 col-form-label">Warehouse Address</label>
                                    <div class="col-lg-9">
                                        <textarea id="txtAddress2Billing" name="txtAddress2Billing" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtCityBilling" class="col-lg-3 col-form-label">Company Type</label>
                                    <div class="col-lg-9">
                                        <input id="txtCityBilling" name="txtCityBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtStateProvinceBilling" class="col-lg-3 col-form-label">Live Market A/C</label>
                                    <div class="col-lg-9">
                                        <input id="txtStateProvinceBilling" name="txtStateProvinceBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtTelephoneBilling" class="col-lg-3 col-form-label">Product Category</label>
                                    <div class="col-lg-9">
                                        <input id="txtTelephoneBilling" name="txtTelephoneBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtFaxBilling" class="col-lg-3 col-form-label">Product Sub Category</label>
                                    <div class="col-lg-9">
                                        <input id="txtFaxBilling" name="txtFaxBilling" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3>Company Document</h3>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtFirstNameShipping" class="col-lg-3 col-form-label">PAN Card</label>
                                    <div class="col-lg-9">
                                        <input id="txtFirstNameShipping" name="txtFirstNameShipping" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtLastNameShipping" class="col-lg-3 col-form-label">VAT/TIN No.</label>
                                    <div class="col-lg-9">
                                        <input id="txtLastNameShipping" name="txtLastNameShipping" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtCompanyShipping" class="col-lg-3 col-form-label">CST No.</label>
                                    <div class="col-lg-9">
                                        <input id="txtCompanyShipping" name="txtCompanyShipping" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtEmailAddressShipping" class="col-lg-3 col-form-label">Service Tax No.</label>
                                    <div class="col-lg-9">
                                        <input id="txtEmailAddressShipping" name="txtEmailAddressShipping" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtCityShipping" class="col-lg-3 col-form-label">Company UIN</label>
                                    <div class="col-lg-9">
                                        <input id="txtCityShipping" name="txtCityShipping" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtStateProvinceShipping" class="col-lg-3 col-form-label">Declaration</label>
                                    <div class="col-lg-9">
                                        <input id="txtStateProvinceShipping" name="txtStateProvinceShipping" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <h3>Bank Details</h3>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtNameCard" class="col-lg-3 col-form-label">Name on Card</label>
                                    <div class="col-lg-9">
                                        <input id="txtNameCard" name="txtNameCard" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="ddlCreditCardType" class="col-lg-3 col-form-label">Credit Card Type</label>
                                    <div class="col-lg-9">
                                        <select id="ddlCreditCardType" name="ddlCreditCardType" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="AE">American Express</option>
                                            <option value="VI">Visa</option>
                                            <option value="MC">MasterCard</option>
                                            <option value="DI">Discover</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtCreditCardNumber" class="col-lg-3 col-form-label">Credit Card Number</label>
                                    <div class="col-lg-9">
                                        <input id="txtCreditCardNumber" name="txtCreditCardNumber" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtCardVerificationNumber" class="col-lg-3 col-form-label">Card Verification Number</label>
                                    <div class="col-lg-9">
                                        <input id="txtCardVerificationNumber" name="txtCardVerificationNumber" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="txtExpirationDate" class="col-lg-3 col-form-label">Expiration Date</label>
                                    <div class="col-lg-9">
                                        <input id="txtExpirationDate" name="txtExpirationDate" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3>Confirm Detail</h3>
                    <fieldset>
                        <div class="p-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">I agree with the Terms and Conditions.</label>
                            </div>
                        </div>
                    </fieldset>
                </form> -->
                <?php $__env->stopSection(); ?>

                

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Maknon/Resources/views/cars/create.blade.php ENDPATH**/ ?>