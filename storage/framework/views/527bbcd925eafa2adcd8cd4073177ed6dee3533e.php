<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title> <?php echo __('member::main.website_name'); ?> | <?php echo $__env->yieldContent('title'); ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo __('member::main.website_name'); ?>e" name="description" />
        <meta content="<?php echo __('member::main.website_name'); ?>" name="author" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(URL::asset('public/images/favicon.ico')); ?>">
        <?php echo $__env->make('member::layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
    <?php echo $__env->yieldContent('body'); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('member::layouts.footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html><?php /**PATH C:\Users\isc\Desktop\almaknon.com\Modules/Member\Resources/views/layouts/master-without-nav.blade.php ENDPATH**/ ?>