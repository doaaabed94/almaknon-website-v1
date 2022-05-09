
<?php if(isset($can_read) and $can_read and isset($read_url)): ?>
<a href="<?php echo e($read_url); ?>" alt="<?php echo __('member::strings.view'); ?>"
class="btn btn-primary btn-sm">
<i class="mdi mdi-view"></i><?php echo __('member::strings.view'); ?></a>
<?php endif; ?>

<?php if(isset($can_update) and isset($update_url) and $can_update ): ?>
<a href="<?php echo e($update_url); ?>" alt="<?php echo __('member::strings.update'); ?>"
class="btn btn-warning btn-sm">
<i class="mdi mdi-view"></i><?php echo __('member::strings.update'); ?></a>
<?php endif; ?>

<?php if(isset($can_postDelete) and isset($delete_url) and $can_postDelete): ?>
<button class="btn btn-danger btn-sm"
onclick="AJAX_ACTION_DB_FUN('<?php echo e(__('member::strings.delete_confirmation.title')); ?>','<?php echo e(__('member::strings.delete_confirmation.description')); ?>','warning','<?php echo e($delete_url); ?>')"
type="button" alt="<?php echo __('member::strings.delete'); ?>">
<i class="mdi mdi-view"></i><?php echo __('member::strings.delete'); ?></button>
<?php endif; ?>

<?php if(isset($can_postRestore) and isset($restore_url) and $can_postRestore): ?>
<button class="btn btn-success btn-sm"
onclick="AJAX_ACTION_DB_FUN('<?php echo e(__('member::strings.restore_confirmation.title')); ?>','<?php echo e(__('member::strings.restore_confirmation.description')); ?>','warning','<?php echo e($restore_url); ?>')"
type="button" alt="<?php echo __('member::strings.restore'); ?>">
<i class="mdi mdi-view"></i><?php echo __('member::strings.restore'); ?></button>
<?php endif; ?>

 <?php if(isset($can_postPermaDelete)and $can_postPermaDelete or isset($can_disabled)and $can_disabled or isset($can_enabled)and $can_enabled or isset($can_loginAs)and $can_loginAs): ?>
<div class="btn-group mr-1">
    <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false"><?php echo __('member::strings.more'); ?></button>

    <div class="dropdown-menu">

        <?php if(isset($can_postPermaDelete) and isset($permdelete_url) and $can_postPermaDelete): ?>
        <button class="dropdown-item"
        onclick="AJAX_ACTION_DB_FUN('<?php echo e(__('member::strings.perma_delete_confirmation.title')); ?>','<?php echo e(__('member::strings.perma_delete_confirmation.description')); ?>','warning','<?php echo e($permdelete_url); ?>')"
        type="button"
        alt="<?php echo __('member::strings.perma_delete'); ?>">
        <i class="mdi mdi-view"></i><?php echo __('member::strings.perma_delete'); ?></button>
        <?php endif; ?>

        <?php if( isset($can_loginAs) and isset($login_as_url) and $can_loginAs): ?>
        <button class="dropdown-item" onclick="AJAX_ACTION_DB_FUN('<?php echo e(__('member::strings.status_confirmation.title')); ?>','<?php echo e(__('member::strings.status_confirmation.description')); ?>','warning','<?php echo e($login_as_url); ?>')" type="button"
        alt="<?php echo __('member::strings.login_as'); ?>">
        <i class="mdi mdi-la la-view"></i><?php echo __('member::strings.login_as'); ?></button>
        <?php endif; ?>

        <?php if(isset($can_disabled) and isset($status_url) and $can_disabled): ?>
        <button class="dropdown-item status_url"
        onclick="AJAX_ACTION_DB_FUN('<?php echo e(__('member::strings.status_confirmation.title')); ?>','<?php echo e(__('member::strings.status_confirmation.description')); ?>','warning','<?php echo e($status_url); ?>')"
        type="button"
        alt="<?php echo __('member::strings.disabled'); ?>">
        <i class="mdi mdi-la la-view"></i><?php echo __('member::strings.disabled'); ?></button>
        <?php endif; ?>

        <?php if(isset($can_enabled) and isset($status_url) and $can_enabled ): ?>
        <button class="dropdown-item "
        onclick="AJAX_ACTION_DB_FUN('<?php echo e(__('member::strings.status_confirmation.title')); ?>','<?php echo e(__('member::strings.status_confirmation.description')); ?>','warning','<?php echo e($status_url); ?>')"  type="button"
        alt="<?php echo __('member::strings.enable'); ?>">
        <i class="mdi mdi-la la-view"></i><?php echo __('member::strings.enable'); ?></button>
        <?php endif; ?>
    </div>
</div>
 <?php endif; ?>
    <?php $__env->startSection('script-bottom'); ?>
    <script type="text/javascript">

        function AJAX_ACTION_DB_FUN(title,description,type,url) {
// alert(url);
var _node = $(this);
//console.log(_node);
Swal.fire({
    title:title,
    text: description,
    type: type,
    showCancelButton: true,
    confirmButtonText: "<?php echo e(__('member::strings.yes')); ?>",
    cancelButtonText: "<?php echo e(__('member::strings.no')); ?>",
    confirmButtonClass: 'btn btn-success mt-2',
    cancelButtonClass: 'btn btn-danger ml-2 mt-2',
    buttonsStyling: false
}).then(function (result) {
    if (result.value) {

        $.ajax({
            url      : url,
            method   : 'POST',
            dataType : 'json',
            data     : {
                _token : '<?php echo csrf_token(); ?>',
            },
            statusCode: {
                404: function(xhr) {
                    var data = xhr.responseJSON;
                    alert( "404" );
                },
                403: function(xhr) {
                    var data = xhr.responseJSON;
                    alert( "403" );
                },
                401: function(xhr) {
                    var data = xhr.responseJSON;
                    alert( "401" );
                },
                500: function(xhr) {
                    var data = xhr.responseJSON;
                    swal.fire(data.message_title, data.message_description, data.message_type);
                },
                200: function(data) {
                    swal.fire({ type: data.message_type,
                        title: data.message_title,
                        text : data.message_description,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        window.location.reload()
                    });

                }
            }
        });

    } else if (
        result.dismiss === Swal.DismissReason.cancel
        ) {
        Swal.fire({
            title: "<?php echo e(__('member::strings.cancelled')); ?>",
            type: "<?php echo e(__('member::strings.error.title')); ?>"
        })
    }
});
}

</script>



<?php $__env->stopSection(); ?>
<?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/common-components/action_datatable.blade.php ENDPATH**/ ?>