

<?php $__env->startSection('title'); ?>
    <?php echo __('member::strings.profile'); ?> - <?php echo __('member::strings.update'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
            <?php echo __('member::strings.my_profile'); ?>

        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

   <div class="row">
        <div class="col-12">
            <div class="card">                
                <div class="card-body">
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="<?php echo route('member::ProfileController@postUpdate'); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="model" value="<?php echo e($model->id); ?>">
                        <div id="show_inline_general_error"></div>
                    
                
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'first_name',
                                        'label'       => __('member::inputs.first_name.label'),
                                        'placeholder' => __('member::inputs.first_name.placeholder'),
                                        'value'       => old('first_name', $model->first_name)
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'last_name',
                                        'label'       => __('member::inputs.last_name.label'),
                                        'placeholder' => __('member::inputs.last_name.placeholder'),
                                        'value'       => old('last_name', $model->last_name)
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('member::common-components.inputs.select', [
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
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'username',
                                        'label'       => __('member::inputs.username.label'),
                                        'placeholder' => __('member::inputs.username.placeholder'),
                                        'value'       => old('username', $model->username)
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'email',
                                        'label'       => __('member::inputs.email.label'),
                                        'placeholder' => __('member::inputs.email.placeholder'),
                                        'value'       => old('email', $model->email)
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                

                                

                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'view'        => 'INLINE',
                                        'name'        => 'phone_number',
                                        'label'       => __('member::inputs.phone_number.label') . ' <span class="text-success dial_code"></span>',
                                        'placeholder' => __('member::inputs.phone_number.placeholder'),
                                        'value'       => old('phone_number', $model->phone_number)
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                
                                
                                

                                <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'type'        => 'password',
                                        'view'        => 'INLINE',
                                        'name'        => 'current_password',
                                        'label'       => __('member::inputs.current_password.label'),
                                        'placeholder' => __('member::inputs.current_password.placeholder'),
                                        'value'       => null
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'type'        => 'password',
                                        'view'        => 'INLINE',
                                        'name'        => 'password',
                                        'label'       => __('member::inputs.password.label'),
                                        'placeholder' => __('member::inputs.password.placeholder'),
                                        'value'       => null
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'type'        => 'password',
                                        'view'        => 'INLINE',
                                        'name'        => 'password_confirmation',
                                        'label'       => __('member::inputs.password_confirmation.label'),
                                        'placeholder' => __('member::inputs.password_confirmation.placeholder'),
                                        'value'       => null
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     


                    
                             <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="updateBtn" type="submit">
                                    <?php echo __('member::strings.save'); ?>

                                </button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
   
<?php $__env->stopSection(); ?>


<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/profile/update.blade.php ENDPATH**/ ?>