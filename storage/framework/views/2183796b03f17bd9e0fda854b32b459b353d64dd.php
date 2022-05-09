
        <?php echo $__env->yieldContent('css'); ?>

        <!-- App css -->
        <link href="<?php echo e(URL::asset('public/css/bootstrap-dark.min.css')); ?>" id="bootstrap-dark" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::asset('public/css/bootstrap.min.css')); ?>" id="bootstrap-light" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(URL::asset('public/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <?php if($_LOCALE_ == "ar"): ?>
        <link href="<?php echo e(URL::asset('public/css/app-rtl.min.css')); ?>" id="app-rtl" rel="stylesheet" type="text/css" />
        <?php else: ?>
        <link href="<?php echo e(URL::asset('public/css/app.min.css')); ?>" id="app-light" rel="stylesheet" type="text/css" />
        <?php endif; ?>
        <link href="<?php echo e(URL::asset('public/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .page-title a{
                color: #fff;
            }
        </style><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/layouts/head.blade.php ENDPATH**/ ?>