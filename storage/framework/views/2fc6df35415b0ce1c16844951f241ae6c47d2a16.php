<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo __('member::main.website_name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo __('member::main.website_name'); ?> " name="description" />
    <meta content="<?php echo __('member::main.website_name'); ?> " name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(URL::asset('images/favicon.ico')); ?>">
    <?php echo $__env->make('member::layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<?php $__env->startSection('body'); ?>
<?php echo $__env->yieldSection(); ?>
<body data-layout="detached" data-topbar="colored">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            <?php echo $__env->make('member::layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('member::layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- End Page-content -->
                <?php echo $__env->make('member::layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->


    <!-- Right Sidebar -->
    <?php echo $__env->make('member::layouts.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    <?php echo $__env->make('member::layouts.footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/layouts/master.blade.php ENDPATH**/ ?>