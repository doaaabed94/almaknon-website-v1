

<?php $__env->startSection('title'); ?>
    <?php echo __('member::strings.roles'); ?> - <?php echo __('member::strings.update_role'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
           <a href="<?php echo route('member::roles.index'); ?>">
            <?php echo __('member::strings.roles'); ?>

            </a>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('li_1'); ?>
            <?php echo __('member::strings.update_role'); ?>

        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 mt-2"><?php echo __('member::strings.update_role'); ?></h4>
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="<?php echo route('member::roles.postUpdate', ['model' => $model->id]); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="model" value="<?php echo e($model->id); ?>">
                        <div id="show_inline_general_error"></div>
                    
                                <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                        'name'        => 'name',
                                        'label'       => __('member::inputs.code.label'),
                                        'placeholder' => __('member::inputs.code.placeholder'),
                                        'help'        => __('member::inputs.code.help'),
                                        'value'       => old('name', $model->name),
                                        'disabled'    => true,
                                    ]
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                              

                                       <div class="col-lg-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php $__currentLoopData = $_ALL_LOCALES_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e($_LOCALE_BASE_CODE == $locale ? 'active' : ''); ?> lang_tab_<?php echo e($_LOCALE_BASE_CODE); ?>" data-toggle="tab" href="#kt_tabs_<?php echo e($_LOCALE_BASE_CODE); ?>">
                                    <img src="<?php echo e(\Module::asset('public/member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg')); ?>" alt="" style="width: 20px;">
                                    <?php echo e($_LOCALE_DETAILS['native']); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content">
                            <?php $__currentLoopData = $_ALL_LOCALES_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane <?php echo e($_LOCALE_BASE_CODE == $locale ? 'active' : ''); ?>" id="kt_tabs_<?php echo e($_LOCALE_BASE_CODE); ?>" role="tabpanel">
                                  <div class="col-md-6  mt-3">
                                    <?php echo $__env->make('member::common-components.inputs.text', [
                                    'options' => [
                                    'name'        => 'title[' . $_LOCALE_BASE_CODE . ']',
                                    'view' => 'INLINE',
                                    'label' => __('member::inputs.title.label') . ' <span class="text-danger"> [' . $_LOCALE_BASE_CODE . '] <span>',
                                        'placeholder' => __('member::inputs.title.placeholder'),
                                        'help'        => __('member::inputs.title.help'),
                                        'value'       => old('title[' . $_LOCALE_BASE_CODE . ']', $model->__strict('title', $_LOCALE_BASE_CODE)),
                                        'attr' => 'data-on-validation-error-click=".lang_tab_'. $_LOCALE_BASE_CODE .'"'
                                        ]
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $__env->make('member::common-components.inputs.textarea', [
                                        'options' => [
                                        'name'        => 'description[' . $_LOCALE_BASE_CODE . ']',
                                        'view' => 'INLINE',
                                        'label'       => __('member::inputs.description.label'). ' <span class="text-danger"> [' . $_LOCALE_BASE_CODE . '] <span>',
                                        'placeholder' => __('member::inputs.description.placeholder'),
                                        'help'        => __('member::inputs.description.help'),
                                        'value'       => old('description[' . $_LOCALE_BASE_CODE . ']', $model->__strict('description', $_LOCALE_BASE_CODE))
                                        ]
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>



                           <?php $__currentLoopData = $AbilitiesGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php
                                                $disabledClass = ($model->updatable == 1) ? '' : ( auth()->user()->isAn('ROOT') ? '' : 'disabled=""' );
                                            ?>
            <table class="table table-bordered">
                <thead>
                    <tr class="bs-inverse">
                        <th colspan="2">
                            <?php echo $Group->SmartTranslation()->title; ?> <br>
                            <small class="text-muted"><?php echo $Group->SmartTranslation()->description; ?></small>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $Group->Abilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Ability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td width="15%">
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="customSwitch<?php echo e($Ability->id); ?>" name="abilities[]" value="<?php echo e($Ability->id); ?>" 
<?php if(in_array($Ability->id, $modelAbilities)): ?> checked="" <?php endif; ?> <?php echo $disabledClass; ?>>
                                <label class="custom-control-label" for="customSwitch<?php echo e($Ability->id); ?>"></label>
                            </div>
                        </td>
                        <td>
                         <?php echo $Ability->SmartTranslation()->title; ?>

                         <br>
                         <small class="text-muted"><?php echo $Ability->SmartTranslation()->description; ?></small>
                     </td>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tbody>
         </table>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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


<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/roles/update.blade.php ENDPATH**/ ?>