

<?php $__env->startSection('title'); ?>
    <?php echo __('member::strings.users'); ?> - <?php echo __('member::strings.update'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
            <?php echo __('member::strings.users'); ?>

        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_1'); ?>
            <?php echo __('member::strings.account_information'); ?>

        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo __('member::strings.account_information'); ?></h4>
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="<?php echo route('member::users.postUpdate', ['model' => $model->id]); ?>" method="POST">
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
                            <?php if(count($_ALL_LOCALES_) > 1): ?>
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
                            <?php endif; ?>

                            <?php if($CurrentUser->can('PERMISSIONS_UPDATE_USERS') OR $CurrentUser->isAn('ROOT')): ?>
                                <?php echo $__env->make('member::common-components.inputs.select', [
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
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

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

                            <?php echo $__env->make('member::common-components.inputs.textarea', [
                                'options' => [
                                    'view'        => 'INLINE',
                                    'name'        => 'address',
                                    'label'       => __('member::inputs.address.label'),
                                    'placeholder' => __('member::inputs.address.placeholder'),
                                    'value'       => old('address', $model->address)
                                ]
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 


                            <?php echo $__env->make('member::common-components.inputs.select', [
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

                            <?php if($CurrentUser->can('STATUS_UPDATE_USERS') OR $CurrentUser->isAn('ROOT')): ?>
                                <?php echo $__env->make('member::common-components.inputs.select', [
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
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>

                             <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="saveBtn" type="submit">
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
                url    : "<?php echo route('member::CityController@ajaxList'); ?>",
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
                                <?php echo e(__('member::inputs.city.placeholder')); ?>

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/users/update.blade.php ENDPATH**/ ?>