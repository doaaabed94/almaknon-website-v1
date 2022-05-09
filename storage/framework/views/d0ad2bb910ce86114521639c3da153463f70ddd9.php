<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div class="h-100">
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img alt="" class="avatar-md mx-auto rounded-circle" src="<?php echo e(URL::asset('/public/modules/member/images/users/avatar-2.jpg')); ?>">
                </img>
            </div>
            <div class="mt-3">
                <a class="text-dark font-weight-medium font-size-16" href="#">
                    <?php echo e(ucfirst(auth()->user()->first_name) .' '. ucfirst(auth()->user()->last_name)); ?>

                </a>
                <p class="text-body mt-1 mb-0 font-size-13">
                    <?php echo e(ucfirst(auth()->user()->type)); ?>

                </p>
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php
                $IS_ROOT = auth()->user()->isAn('ROOT');
                ?>

                <?php echo $__env->yieldContent('sidebar'); ?>

               <?php if($IS_ROOT OR auth()->user()->can('READ_CAR') 
               OR auth()->user()->can('READ_MARKA')
               OR auth()->user()->can('READ_OFFERS')
               OR auth()->user()->can('READ_FUELS')
               OR auth()->user()->can('READ_COLOR')
               OR auth()->user()->can('READ_CONDITIONS') ): ?>
                <li class="menu-title">
                    <?php echo __('maknon::main.cars_management'); ?>

                </li>
                <?php if($IS_ROOT OR auth()->user()->can('READ_CAR') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.cars'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_CAR') ): ?>
                        <li>
                            <a href="<?php echo e(route('cars.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_CAR') ): ?>
                        <li>
                            <a href="<?php echo e(route('cars.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                 <?php if($IS_ROOT OR auth()->user()->can('READ_COLOR') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.colors'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_COLOR') ): ?>
                        <li>
                            <a href="<?php echo e(route('colors.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_COLOR') ): ?>
                        <li>
                            <a href="<?php echo e(route('colors.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                       <?php if($IS_ROOT OR auth()->user()->can('READ_OFFERS') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.offers'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_OFFERS') ): ?>
                        <li>
                            <a href="<?php echo e(route('offers.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_OFFERS') ): ?>
                        <li>
                            <a href="<?php echo e(route('offers.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                       <?php if($IS_ROOT OR auth()->user()->can('READ_CONDITIONS') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.conditions'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_CONDITIONS') ): ?>
                        <li>
                            <a href="<?php echo e(route('conditions.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_CONDITIONS') ): ?>
                        <li>
                            <a href="<?php echo e(route('conditions.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>


                       <?php if($IS_ROOT OR auth()->user()->can('READ_FUELS') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.fuels'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_FUELS') ): ?>
                        <li>
                            <a href="<?php echo e(route('fuels.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_FUELS') ): ?>
                        <li>
                            <a href="<?php echo e(route('fuels.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                       <?php if($IS_ROOT OR auth()->user()->can('READ_MARKA') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.markas'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_MARKA') ): ?>
                        <li>
                            <a href="<?php echo e(route('markas.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_MARKA') ): ?>
                        <li>
                            <a href="<?php echo e(route('markas.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($IS_ROOT OR auth()->user()->can('READ_CURRENCY') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('maknon::main.currency'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if($IS_ROOT OR auth()->user()->can('READ_CURRENCY') ): ?>
                        <li>
                            <a href="<?php echo e(route('currency.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if($IS_ROOT OR auth()->user()->can('CREATE_CURRENCY') ): ?>
                        <li>
                            <a href="<?php echo e(route('colors.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php endif; ?>
                <!--------------------------------------->
             <?php if($IS_ROOT OR auth()->user()->can('READ_CONTENTS') 
               OR auth()->user()->can('READ_CATEGORY')
               OR auth()->user()->can('READ_SUB_CATEGORY') ): ?>
                <li class="menu-title">
                    <?php echo __('cms::strings.cms_management'); ?>

                </li>
                <?php if( $IS_ROOT OR auth()->user()->can('READ_CONTENTS') OR auth()->user()->can('CREATE_CONTENTS') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('cms::strings.contents_management'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if( $IS_ROOT OR auth()->user()->can('READ_CONTENTS') ): ?>
                        <li>
                            <a href="<?php echo e(route('cms::contents.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if( $IS_ROOT OR auth()->user()->can('CREATE_CONTENTS') ): ?>
                        <li>
                            <a href="<?php echo e(route('cms::contents.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>


                <?php if( $IS_ROOT OR auth()->user()->can('READ_CATEGORY') OR auth()->user()->can('CREATE_CATEGORY') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('cms::strings.category_management'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if( $IS_ROOT OR auth()->user()->can('READ_CATEGORY') ): ?>
                        <li>
                            <a href="<?php echo e(route('cms::categories.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if( $IS_ROOT OR auth()->user()->can('CREATE_CATEGORY') ): ?>
                        <li>
                            <a href="<?php echo e(route('cms::categories.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>


                
                <?php endif; ?>
                <!----------------------------------------->
                <?php if($IS_ROOT 
               OR auth()->user()->can('READ_ROLES')
               OR auth()->user()->can('READ_USERS')
              ): ?>
                <li class="menu-title">
                    <?php echo __('member::strings.users_and_permissions'); ?>

                </li>
                <?php if( $IS_ROOT OR auth()->user()->can('READ_USERS') OR auth()->user()->can('CREATE_USERS') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('member::strings.users'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if( $IS_ROOT OR auth()->user()->can('READ_USERS') ): ?>
                        <li>
                            <a href="<?php echo e(route('member::users.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if( $IS_ROOT OR auth()->user()->can('CREATE_USERS') ): ?>
                        <li>
                            <a href="<?php echo e(route('member::users.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if( $IS_ROOT OR auth()->user()->can('READ_ROLES') OR auth()->user()->can('CREATE_ROLES') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('member::strings.roles'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if( $IS_ROOT OR auth()->user()->can('READ_ROLES') ): ?>
                        <li>
                            <a href="<?php echo e(route('member::roles.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if( $IS_ROOT OR auth()->user()->can('CREATE_ROLES') ): ?>
                        <li>
                            <a href="<?php echo e(route('member::roles.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>


                    <?php if( $IS_ROOT OR auth()->user()->can('READ_COUNTRIES') OR auth()->user()->can('CREATE_COUNTRIES') ): ?>
                <li>
                    <a class="has-arrow waves-effect" href="javascript: void(0);">
                        <i class="mdi mdi-inbox-full">
                        </i>
                        <span>
                            <?php echo __('member::strings.countries'); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="sub-menu">
                        <?php if( $IS_ROOT OR auth()->user()->can('READ_COUNTRIES') ): ?>
                        <li>
                            <a href="<?php echo e(route('member::countries.index')); ?>">
                                <?php echo trans_choice('member::strings.list_all', 0); ?>

                            </a>
                        </li>
                        <?php endif; ?>

                       <?php if( $IS_ROOT OR auth()->user()->can('CREATE_COUNTRIES') ): ?>
                        <li>
                            <a href="<?php echo e(route('member::countries.create')); ?>">
                                <?php echo __('member::strings.add_new'); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>