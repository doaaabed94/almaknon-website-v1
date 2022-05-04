    <!-- JAVASCRIPT -->
        <script src="<?php echo e(URL::asset('public/libs/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/libs/bootstrap/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/libs/metismenu/metismenu.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/libs/simplebar/simplebar.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/libs/node-waves/node-waves.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
        <script src="<?php echo e(URL::asset('public/js/pages/sweet-alerts.init.js')); ?>"></script>

        <?php echo $__env->yieldContent('script'); ?>

        <!-- App js -->
        <script src="<?php echo e(URL::asset('public/js/app.min.js')); ?>"></script>
        <?php echo $__env->make('member::inc.action_crud', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('script-bottom'); ?><?php /**PATH C:\Users\isc\Desktop\almaknon.com\Modules/Member\Resources/views/layouts/footer-script.blade.php ENDPATH**/ ?>