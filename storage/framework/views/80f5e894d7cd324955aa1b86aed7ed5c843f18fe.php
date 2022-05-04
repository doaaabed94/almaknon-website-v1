<?php $__env->startSection('title'); ?>
    <?php echo __('member::auth.sign_in_to_account'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

    <body>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
        <div class="home-btn d-none d-sm-block">
            <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-login text-center">
                                <div class="bg-login-overlay"></div>
                                <div class="position-relative">
                                    <h5 class="text-white font-size-20"><?php echo __('member::main.welcome_back'); ?></h5>
                                    <!-- <p class="text-white-50 mb-0"><?php echo __('member::auth.dont_have_an_account'); ?></p> -->
                                    <a href="index" class="logo logo-admin mt-4">
                                        <img src="#" alt="" height="30">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div class="p-2">
                                    <form method="POST" action="<?php echo e(route('postLogin')); ?>"
                                        class="crud-ajax-form needs-validation action-ajax-form" novalidate>
                                        <?php echo csrf_field(); ?>
                                        <div id="show_inline_general_error"></div>
                                        <div class="form-group">
                                            <label for="username"><?php echo __('member::main.email'); ?></label>
                                            <input id="email_username_phone" type="email" class="form-control"
                                                name="email_username_phone"
                                                <?php if(old('email')): ?> value="<?php echo e(old('email')); ?>" <?php endif; ?>
                                                required autocomplete="email" autofocus>
                                        </div>

                                        <div class="form-group">
                                            <label for="userpassword"><?php echo __('member::main.password'); ?></label>
                                            <input id="password" type="password" class="form-control" value="123456"
                                                name="password" required autocomplete="current-password">
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember"
                                                id="customControlInline" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                            <label class="custom-control-label"
                                                for="customControlInline"><?php echo e(__('Remember Me')); ?></label>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" id="login"
                                                type="submit"><?php echo __('member::auth.sign_in'); ?></button>
                                        </div>

                                        <!-- <div class="mt-4 text-center">
    <a href="#" class="text-muted"><i class="mdi mdi-lock mr-1" id="signin_forgot"></i> <?php echo __('member::auth.forgot_password'); ?></a>
    </div> -->
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <!-- <p><?php echo __('member::auth.dont_have_an_account'); ?> <a href="register" class="font-weight-medium text-primary"><?php echo __('member::auth.sign_up'); ?></a> </p> -->
                            <p>©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> <?php echo __('member::main.website_name'); ?> <i class="mdi mdi-heart text-danger"></i>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>


<?php echo $__env->make('member::layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\isc\Desktop\almaknon.com\Modules/Member\Resources/views/auth/login.blade.php ENDPATH**/ ?>