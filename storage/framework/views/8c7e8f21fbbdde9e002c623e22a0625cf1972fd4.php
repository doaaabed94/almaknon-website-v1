<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" id="page-header-search-dropdown" type="button">
                        <i class="mdi mdi-magnify">
                        </i>
                    </button>
                    <div aria-labelledby="page-header-search-dropdown" class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input aria-label="Recipient's username" class="form-control" placeholder="Search ..." type="text">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="mdi mdi-magnify">
                                                </i>
                                            </button>
                                        </div>
                                    </input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-none d-sm-inline-block">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item waves-effect" data-toggle="dropdown" type="button">
                        <img alt="<?php echo e($_LOCALE_); ?>" class="" height="16" src="<?php echo e(\Module::asset('member:images/flags/' . $_LOCALE_ . '.jpg')); ?>">
                        </img>
                    </button>
                    <?php if(count($_ALL_LOCALES_) > 1): ?>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php $__currentLoopData = $_ALL_LOCALES_; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="dropdown-item notify-item" href="<?php echo e(LaravelLocalization::getLocalizedURL($_LOCALE_BASE_CODE, request()->fullUrl(), [])); ?>">
                            <img alt="user-image" class="mr-1 <?php echo e($_LOCALE_BASE_CODE == $_LOCALE_ ? 'active' : ''); ?>" height="12" src="<?php echo e(\Module::asset('member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg')); ?>">
                                <span class="align-middle">
                                    <?php echo e($_LOCALE_DETAILS['native']); ?>

                                </span>
                            </img>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button class="btn header-item noti-icon waves-effect" data-toggle="fullscreen" type="button">
                        <i class="mdi mdi-fullscreen">
                        </i>
                    </button>
                </div>
                
                <div class="dropdown d-inline-block">
                    <button aria-expanded="false" aria-haspopup="true" class="btn header-item waves-effect" data-toggle="dropdown" id="page-header-user-dropdown" type="button">
                        <img alt="Header Avatar" class="rounded-circle header-profile-user" src="<?php echo e(\Module::asset('member:images/users/avatar-2.jpg')); ?>">
                            <span class="d-none d-xl-inline-block ml-1">
                                <?php echo e(ucfirst(auth()->user()->first_name) .' '. ucfirst(auth()->user()->last_name)); ?>

                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block">
                            </i>
                        </img>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="<?php echo route('member::ProfileController@update'); ?>">
                            <i class="bx bx-user font-size-16 align-middle mr-1">
                            </i>
                            <?php echo e(__('member::strings.my_profile')); ?>

                        </a>
                        
                        
                        
                        <div class="dropdown-divider">
                        </div>
                        
                                        <?php if(!empty(session()->get('OLD_USER_JWT_TOKEN'))): ?>
                        <a class="dropdown-item" href="javascript:;" onclick="$('#back-to-old-logged-in-account').submit();" style="margin-left: 5px; margin-right: 5px;">
                            <?php echo e(__('member::strings.back_to_old_logged_in_account')); ?>

                        </a>
                        <form action="<?php echo route('member::users.loginAsFromToken'); ?>" class="hidden" id="back-to-old-logged-in-account" method="POST">
                            <?php echo e(csrf_field()); ?>

                        </form>
                        <?php endif; ?>
                        <form action="<?php echo route('postLogout'); ?>" class="hidden" id="logout-form" method="POST">
                            <?php echo e(csrf_field()); ?>

                        </form>
                        <a class="dropdown-item text-danger" href="javascript:;" onclick="$('#logout-form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger">
                            </i>
                            <?php echo e(__('member::strings.sign_out')); ?>

                        </a>
                    </div>
                </div>
                
            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a class="logo logo-dark" href="<?php echo e(route('member::index')); ?>">
                        <span class="logo-sm">
                            <img alt="" height="20" src="<?php echo __('member::main.logo-sm'); ?>">
                            </img>
                        </span>
                        <span class="logo-lg">
                            <img alt="" height="17" src="<?php echo __('member::main.logo-dark'); ?>">
                            </img>
                        </span>
                    </a>
                    <a class="logo logo-light" href="<?php echo e(route('member::index')); ?>">
                        <span class="logo-sm">
                            <img alt="" height="20" src="<?php echo e(__('member::main.logo-sm')); ?>">
                            </img>
                        </span>
                        <span class="logo-lg">
                            <img alt="" height="19" src="<?php echo __('member::main.logo-light'); ?>">
                            </img>
                        </span>
                    </a>
                </div>
                <button class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn" type="button">
                    <i class="fa fa-fw fa-bars">
                    </i>
                </button>
                <!-- App Search-->
                <form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input class="form-control" placeholder="Search..." type="text">
                            <span class="bx bx-search-alt">
                            </span>
                        </input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/layouts/topbar.blade.php ENDPATH**/ ?>