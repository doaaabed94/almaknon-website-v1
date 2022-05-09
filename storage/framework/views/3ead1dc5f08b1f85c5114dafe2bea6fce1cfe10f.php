<?php $__env->startSection('title'); ?>
<?php echo __('member::strings.countries'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
            <?php echo __('member::strings.countries'); ?>

        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title_li'); ?>
            <?php if(auth()->user()->isAn('ROOT') or auth()->user()->can('CREATE_COUNTRIES')): ?>
                <a href="<?php echo route('member::countries.create'); ?>" class="btn btn-warning">
                    <?php echo __('member::strings.add_new'); ?>

                </a>
            <?php endif; ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><?php echo __('member::strings.countries'); ?></h4>
                    <p class="card-title-desc"><?php echo __('member::strings.countries'); ?></p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th><?php echo e(__('member::strings.datatable.name')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.status')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.actions')); ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($data->name); ?> <?php echo e($data->name); ?></td>
                                    <td><span class="btn btn-bold btn-sm btn-font-sm btn-<?php echo e($data->status  == 'DISABLED' ? 'danger' : 'info'); ?>">
                                      <?php echo e($data->status ? $data->status : '------'); ?></span></td>
                                    <td>
                                      <?php echo $__env->make('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_read' => auth()->user()->can('READ_COUNTRIES'),
                                        'can_update' => auth()->user()->can('UPDATE_COUNTRIES'),
                                        'can_postRestore' => auth()->user()->can('RESTORE_COUNTRIES') && $data->trashed(),
                                        'can_postDelete' => auth()->user()->can('DELETE_COUNTRIES') && ! $data->trashed() ,
                                        'can_postPermaDelete' => auth()->user()->can('PERMA_DELETE_COUNTRIES')  ,
                                        'can_disabled' => auth()->user()->can('STATUS_UPDATE_COUNTRIES') && $data->isEnabled(),
                                        'can_enabled' => auth()->user()->can('STATUS_UPDATE_COUNTRIES') && $data->isDisabled(),
                                        
                                        'delete_url' => route('member::countries.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::countries.postRestore', ['model' => $data->id]) ,
                                        'update_url' => route('member::countries.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::countries.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::countries.postStatus', ['model' => $data->id]),
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <!-- Required datatable js -->
    <script src="<?php echo e(URL::asset('/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/libs/pdfmake/pdfmake.min.js')); ?>"></script>
    <!-- Datatable init js -->
    <script src="<?php echo e(URL::asset('/js/pages/datatables.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/countries/index.blade.php ENDPATH**/ ?>