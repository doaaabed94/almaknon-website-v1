

<?php $__env->startSection('title'); ?>
<?php echo __('member::strings.roles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
            <a href="<?php echo route('member::roles.index'); ?>" class="btn btn-warning">
             <?php echo __('member::strings.roles'); ?>

         </a>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title_li'); ?>
        <a href="<?php echo route('member::roles.create'); ?>" class="btn btn-warning">
                    <?php echo __('member::strings.add_new'); ?>

                </a>
            <?php if(auth()->user()->isAn('ROOT')): ?>
                <a href="<?php echo route('member::roles.create'); ?>" class="btn btn-warning">
                    <?php echo __('member::strings.add_new'); ?>

                </a>
            <?php endif; ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="data">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><?php echo __('member::strings.roles'); ?></h4>

                    <table class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th><?php echo e(__('member::strings.datatable.id')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.name')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.actions')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $Roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr <?php if($data->trashed()): ?> style="background: #ffdbda;" <?php endif; ?>>
                                    <td><?php echo e($data->id); ?></td>
                                    <td><?php echo e($data->name); ?></td>
                                    <td>
                                         <?php echo $__env->make('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_update' =>auth()->user()->can('UPDATE_ROLES'),
                                        'can_postRestore' =>auth()->user()->isAn('ROOT'),
                                        'can_postDelete' => auth()->user()->isAn('ROOT'),
                                        'can_postPermaDelete' => auth()->user()->isAn('ROOT') ,

                                        'delete_url' => route('member::roles.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::roles.postRestore', ['model' => $data->id]),
                                        'update_url' => route('member::roles.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::roles.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::roles.postStatus', ['model' => $data->id]),
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <!--  <?php echo $__env->make('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_update' => auth()->user()->can('UPDATE_ROLES')  && $data->type == 'ROOT' ,
                                        'can_postRestore' => auth()->user()->can('RESTORE_ROLES') && $data->trashed()  && $data->type == 'ROOT',
                                        'can_postDelete' => auth()->user()->can('DELETE_ROLES') && ! $data->trashed() && $data->type == 'ROOT' ,
                                        'can_postPermaDelete' => auth()->user()->can('PERMA_DELETE_ROLES')  && $data->type == 'ROOT' ,

                                        'delete_url' => route('member::roles.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::roles.postRestore', ['model' => $data->id]),
                                        'update_url' => route('member::roles.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::roles.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::roles.postStatus', ['model' => $data->id]),
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->

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
    <!-- end data -->


<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <!-- Required datatable js -->
    <script src="<?php echo e(URL::asset('public/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('public/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('public/libs/pdfmake/pdfmake.min.js')); ?>"></script>
    <!-- Datatable init js -->
    <script src="<?php echo e(URL::asset('public/js/pages/datatables.init.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/roles/index.blade.php ENDPATH**/ ?>