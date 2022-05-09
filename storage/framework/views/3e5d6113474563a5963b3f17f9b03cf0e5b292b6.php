<?php $__env->startSection('title'); ?>
    <?php echo __('member::strings.countries'); ?> - <?php echo __('member::strings.add_new'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
            <a href="<?php echo route('member::countries.index'); ?>">
              <?php echo __('member::strings.countries'); ?>

          </a>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_1'); ?>
            <?php echo __('member::strings.add_new'); ?>

        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                    <h4 class="card-title"><?php echo __('member::strings.add_new'); ?></h4>
                
                <div class="card-body">
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="<?php echo route('member::countries.postCreate'); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div id="show_inline_general_error"></div>

      <?php if(auth()->user()->isAn('ROOT')): ?>
                            <?php echo $__env->make('member::common-components.inputs.select', [
                                'options' => [
                                    'name'        => 'deleteable',
                                    'label'       => __('member::inputs.deleteable.label'),
                                    'help'        => null,
                                    'options'     => __('member::inputs.deleteable.options'),
                                    'text'        => function($K, $V){
                                        return $V;
                                    },
                                    'values'      => function($K, $V){
                                        return $K;
                                    },
                                    'select'      => function($K, $V, $value){
                                        return $K == $value;
                                    },
                                    'value'       => old('deleteable', 'Y')
                                ]
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php echo $__env->make('member::common-components.inputs.select', [
                            'options' => [
                                'name'        => 'locale',
                                'label'       => __('member::inputs.locale.label'),
                                'help'        => __('member::inputs.locale.help'),
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
                                'value'       => old('locale', app()->getLocale())
                            ]
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'dial_code',
                                'label'       => __('member::inputs.dial_code.label'),
                                'placeholder' => __('member::inputs.dial_code.placeholder'),
                                'help'        => null,
                                'value'       => old('dial_code')
                            ]
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'iso_2',
                                'label'       => __('member::inputs.country_iso_2.label'),
                                'placeholder' => __('member::inputs.country_iso_2.placeholder'),
                                'help'        => null,
                                'value'       => old('iso_2')
                            ]
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'iso_3',
                                'label'       => __('member::inputs.country_iso_3.label'),
                                'placeholder' => __('member::inputs.country_iso_3.placeholder'),
                                'help'        => null,
                                'value'       => old('iso_3')
                            ]
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'name',
                                'label'       => __('member::inputs.name.label'),
                                'placeholder' => __('member::inputs.name.placeholder'),
                                'help'        => null,
                                'value'       => old('name')
                            ]
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'name'        => 'lat',
                                        'label'       => __('member::inputs.lat.label'),
                                        'placeholder' => __('member::inputs.lat.placeholder'),
                                        'help'        => null,
                                        'value'       => old('lat')
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-sm-6">
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'name'        => 'lng',
                                        'label'       => __('member::inputs.lng.label'),
                                        'placeholder' => __('member::inputs.lng.placeholder'),
                                        'help'        => null,
                                        'value'       => old('lng')
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                                
                              <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="saveBtn" type="submit">
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


<?php $__env->startSection('script'); ?>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/countries/create.blade.php ENDPATH**/ ?>