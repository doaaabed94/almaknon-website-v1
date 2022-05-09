<?php $__env->startSection('title'); ?>
    <?php echo __('maknon::main.currency_list'); ?> - <?php echo __('member::strings.add_new'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
        <a href="<?php echo e(route('currency.index')); ?>" > <?php echo __('maknon::main.currency_list'); ?> </a>
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
                        <div class="col-lg-8 mb-5">


                              <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'code',
                                    'label' => __('maknon::inputs.code.label'),
                                    'placeholder' => __('maknon::inputs.code.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('code' , $data->code),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            

                                      <?php echo $__env->make('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'symbol',
                                    'label' => __('maknon::inputs.symbol.label'),
                                    'placeholder' => __('maknon::inputs.symbol.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('symbol',  $data->symbol),
                                ],
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                                        'value' => old('name[' . $_LOCALE_BASE_CODE . ']',$data->__strict('name', $_LOCALE_BASE_CODE)),
                                                        'attr' => 'data-on-validation-error-click=".lang_tab_'.$_LOCALE_BASE_CODE .'"',
                                                        'label_size' => 'col-lg-2',
                                                        'input_size' => 'col-lg-10',
                                                    ],
                                                ]
                                            , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                      
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="col-lg-2 col-xl-2 m-auto d-flex mt-5">
                            
                            <a href="<?php echo e(route('currency.index')); ?>" class="btn btn-success btn-back mr-2 ml-2 mt-5 w-50">
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

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Maknon/Resources/views/currency/update.blade.php ENDPATH**/ ?>