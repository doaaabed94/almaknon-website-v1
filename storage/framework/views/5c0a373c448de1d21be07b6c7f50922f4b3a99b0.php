<?php $__env->startSection('title'); ?>
<?php echo __('cms::strings.contents_list'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
        <?php $__env->slot('title'); ?>
        <a href="<?php echo e(route('cms::contents.index')); ?>" > <?php echo __('cms::strings.contents_list'); ?> </a>
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title_li'); ?>
            <?php if(auth()->user()->isAn('ROOT') or auth()->user()->can('CREATE_CONENTS')): ?>
                <a href="<?php echo route('cms::contents.create'); ?>" class="btn btn-warning">
                    <?php echo __('member::strings.add_new'); ?>

                </a>
            <?php endif; ?>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><?php echo __('cms::strings.contents_list'); ?></h4>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th><?php echo e(__('member::strings.datatable.id')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.name')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.status')); ?></th>
                                <th><?php echo e(__('member::strings.datatable.actions')); ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php $__currentLoopData = $all_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr  <?php if($data->trashed()): ?> style="background: #ffdbda;" <?php endif; ?> <?php if($data->isDisabled()): ?> style="background: #ffebe8;" <?php endif; ?>>
                                    <td><?php echo e($data->id); ?></td>
                                    <td><?php echo e($data->translateOrFirst()->name); ?></td>
                                    <td><span class="btn btn-bold btn-sm btn-font-sm btn-<?php echo e($data->status  == 'DISABLED' ? 'danger' : 'info'); ?>">
                                      <?php echo e($data->status ? $data->status : '------'); ?></span></td>
                                    <td>
                                      <?php echo $__env->make('member::common-components.action_datatable', [
                                        'id'                        => $data->id,
                                        'can_read'                  => auth()->user()->isAn('ROOT') OR auth()->user()->can('READ_CONENTS'),
                                        'can_update'                => auth()->user()->isAn('ROOT') OR auth()->user()->can('UPDATE_CONENTS'),
                                        'can_postRestore'           => (auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CONENTS')) && $data->trashed(),
                                        'can_postDelete'            => (auth()->user()->isAn('ROOT') OR auth()->user()->can('DELETE_CONENTS')) && !$data->trashed(),
                                        'can_postPermaDelete'       => auth()->user()->isAn('ROOT') OR auth()->user()->can('PERMA_DELETE_CONENTS'),
                                        'can_disabled'              => (auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CONENTS')) && $data->isEnabled(),
                                        'can_enabled'               => (auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CONENTS')) && $data->isDisabled(),
                                        
                                        'read_url'                  => route('cms::contents.read', ['model' => $data->id]) ,
                                        'delete_url'                => route('cms::contents.postDelete', ['model' => $data->id]) ,
                                        'restore_url'               => route('cms::contents.postRestore', ['model' => $data->id]) ,
                                        'update_url'                => route('cms::contents.update', ['model' => $data->id]),
                                        'permdelete_url'            => route('cms::contents.postPermaDelete', ['model' => $data->id]),
                                        'status_url'                => route('cms::contents.postStatus', ['model' => $data->id]),
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
    <script src="<?php echo e(URL::asset('/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/libs/pdfmake/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/js/pages/datatables.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/CMS/Resources/views/contents/index.blade.php ENDPATH**/ ?>