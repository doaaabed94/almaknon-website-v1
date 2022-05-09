<?php $__env->startSection('title'); ?>
    <?php echo __('cms::strings.contents_list'); ?> - <?php echo __('member::strings.add_new'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
        <a href="<?php echo e(route('cms::contents.index')); ?>" > <?php echo __('cms::strings.contents_list'); ?> </a>
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
                    <form class="crud-ajax-form needs-validation action-ajax-form" action="#" method="POST">
                        <?php echo csrf_field(); ?>

                        <div id="show_inline_general_error"></div>
                        <input type="hidden" name="model" value="<?php echo e($data->id); ?>">

                           <?php echo $__env->make(
                            'member::common-components.inputs.select',
                            [
                                'options' => [
                                    'size' => 5,
                                    'view' => 'INLINE',
                                    'name' => 'category_id',
                                    'searchable' => true,
                                    'label' => __('cms::inputs.categories.label'),
                                    'nullable' =>__('cms::inputs.categories.placeholder'),
                                    'nullable_v' => null,
                                    'container_class' => 'col-lg-8',
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                    'options' => $categories,
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
                                    'value' => old('categories' , $data->category_id  )
                                ],
                            ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'slug',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.slug.label') ,
                                    'placeholder' =>__('cms::inputs.slug.placeholder'),
                                    'help' => ' ',
                                    'value' => old('slug', $data->slug  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'views',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.views.label') ,
                                    'placeholder' =>__('cms::inputs.views.placeholder'),
                                    'help' => ' ',
                                    'value' => old('views', $data->views  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'order',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.order.label') ,
                                    'placeholder' =>__('cms::inputs.order.placeholder'),
                                    'help' => ' ',
                                    'value' => old('order', $data->order  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'link',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.link.label') ,
                                    'placeholder' =>__('cms::inputs.link.placeholder'),
                                    'help' => ' ',
                                    'value' => old('link', $data->link  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                                            __('member::inputs.title.label') .
                                                            ' <span class="text-danger"> [' .
                                                            $_LOCALE_BASE_CODE .
                                                            '] <span>',
                                                        'placeholder' => __(
                                                            'member::inputs.title.placeholder'
                                                        ),
                                                        'help' => __('member::inputs.title.help'),
                                                        'value' => old('name[' . $_LOCALE_BASE_CODE . ']',$data->__strict('name', $_LOCALE_BASE_CODE)),
                                                        'attr' => 'data-on-validation-error-click=".lang_tab_'.$_LOCALE_BASE_CODE .'"',
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
                                                        __('member::inputs.description.label') .
                                                        ' <span class="text-danger"> [' .
                                                        $_LOCALE_BASE_CODE .
                                                        '] <span>',
                                                    'placeholder' => __(
                                                        'member::inputs.description.placeholder'
                                                    ),
                                                    'help' => __('member::inputs.description.help'),
                                                    'value' => $data->__strict('description', $_LOCALE_BASE_CODE),
                                                    'rows' => 20,
                                                    'label_size' => 'col-lg-2',
                                                    'input_size' => 'col-lg-10',
                                                ],
                                            ]
                                        , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                <?php echo $__env->make(
                    'member::common-components.inputs.select',
                    [
                        'options' => [
                            'size' => 5,
                            'view' => 'INLINE',
                            'name' => 'show_in_site',
                            'label' => __('cms::inputs.show_in_site.label') ,
                            'placeholder' =>__('cms::inputs.show_in_site.placeholder'),
                            'help' => ' ',
                            'nullable' => null,
                            'nullable_v' => null,
                            'label_size' => 'col-lg-2',
                            'input_size' => 'col-lg-10',
                            'options' => [
                                [
                                    'value' => 'yes',
                                    'text' => __('cms::strings.yes'),
                                ],
                                [
                                    'value' => 'no',
                                    'text' => __('cms::strings.no'),
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
                            'value' => old('show_in_site', $data->show_in_site  ),
                        ],
                    ]
                    , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('member::common-components.inputs.text', [
                    'options' => [
                        'view' => 'INLINE',
                        'name' => 'meta_title',
                        'label' => __('cms::inputs.meta_title.label'),
                        'placeholder' => __('cms::inputs.meta_title.placeholder'),
                        'label_size' => 'col-lg-2',
                        'input_size' => 'col-lg-10',
                        'value' => old('meta_title', $data->meta_title  ),
                    ],
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('member::common-components.inputs.text', [
                    'options' => [
                        'view' => 'INLINE',
                        'name' => 'meta_description',
                        'label' => __('cms::inputs.meta_description.label'),
                        'placeholder' => __('cms::inputs.meta_description.placeholder'),
                        'label_size' => 'col-lg-2',
                        'input_size' => 'col-lg-10',
                        'value' => old('meta_description', $data->meta_description  ),
                    ],
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('member::common-components.inputs.text', [
                    'options' => [
                        'view' => 'INLINE',
                        'name' => 'meta_keyword',
                        'label' => __('cms::inputs.meta_keyword.label'),
                        'placeholder' => __('cms::inputs.meta_keyword.placeholder'),
                        'label_size' => 'col-lg-2',
                        'input_size' => 'col-lg-10',
                        'value' => old('meta_keyword', $data->meta_keyword  ),
                    ],
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if($CurrentUser->can('STATUS_UPDATE_CONENT') or $CurrentUser->isAn('ROOT')): ?>
                    <?php echo $__env->make(
                        'member::common-components.inputs.select',
                        [
                            'options' => [
                                'size' => 5,
                                'view' => 'INLINE',
                                'name' => 'status',
                                'label' => __('member::inputs.status.label'),
                                'nullable' => null,
                                'nullable_v' => null,
                                'container_class' => 'col-lg-8',
                                'label_size' => 'col-lg-2',
                                'input_size' => 'col-lg-10',
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
                                'value' => old('status', $data->status  ),
                            ],
                        ]
                        , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        </div>

                        <div class="col-lg-2 col-xl-2 m-auto d-flex mt-5">
                            
                            <a href="<?php echo e(route('cms::contents.index')); ?>" class="btn btn-success btn-back mr-2 ml-2 mt-5 w-50">
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
        <!-- end col -->
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/CMS/Resources/views/contents/update.blade.php ENDPATH**/ ?>