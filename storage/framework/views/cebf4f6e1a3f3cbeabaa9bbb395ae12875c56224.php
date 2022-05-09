<?php $__env->startSection('title'); ?> <?php echo __('member::strings.dashboard'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('member::common-components.breadcrumb'); ?>
         <?php $__env->slot('title'); ?> <?php echo __('member::strings.dashboard'); ?>   <?php $__env->endSlot(); ?>
         <?php $__env->slot('title_li'); ?> <?php echo __('member::strings.welcome_dashboard'); ?>   <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>

                    <div class="row">
                        <div class="col-xl-3">
                            
     <?php $__env->startComponent('member::common-components.dashboard-widget'); ?>
     
         <?php $__env->slot('title'); ?> <?php echo __('member::strings.number_cars'); ?>  <?php $__env->endSlot(); ?>
         <?php $__env->slot('iconClass'); ?> mdi mdi-tag-plus-outline  <?php $__env->endSlot(); ?>
         <?php $__env->slot('price'); ?> 1,368  <?php $__env->endSlot(); ?>
        
     <?php echo $__env->renderComponent(); ?>
     
     <?php $__env->startComponent('member::common-components.dashboard-widget'); ?>
     
         <?php $__env->slot('title'); ?> <?php echo __('member::strings.number_blogs'); ?> <?php $__env->endSlot(); ?>
         <?php $__env->slot('iconClass'); ?> mdi mdi-account-multiple-outline  <?php $__env->endSlot(); ?>
         <?php $__env->slot('price'); ?> 2,456  <?php $__env->endSlot(); ?>
        
     <?php echo $__env->renderComponent(); ?>
     
                        </div>

   <div class="col-xl-3">
                            
     <?php $__env->startComponent('member::common-components.dashboard-widget'); ?>
     
         <?php $__env->slot('title'); ?> <?php echo __('member::strings.number_testimonal'); ?>  <?php $__env->endSlot(); ?>
         <?php $__env->slot('iconClass'); ?> mdi mdi-tag-plus-outline  <?php $__env->endSlot(); ?>
         <?php $__env->slot('price'); ?> 1,368  <?php $__env->endSlot(); ?>
        
     <?php echo $__env->renderComponent(); ?>
     
     <?php $__env->startComponent('member::common-components.dashboard-widget'); ?>
     
         <?php $__env->slot('title'); ?> <?php echo __('member::strings.number_last_week'); ?>  <?php $__env->endSlot(); ?>
         <?php $__env->slot('iconClass'); ?> mdi mdi-account-multiple-outline  <?php $__env->endSlot(); ?>
         <?php $__env->slot('price'); ?> 2,456  <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
     
                        </div>


                              <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4"><?php echo __('member::strings.Reviews'); ?> </h4>
                                    <div class="mb-3">
                                        <i class="fas fa-quote-left h4 text-primary"></i>
                                    </div>
                                    <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>
                                                    <p>To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words</p>
                                                    <div class="media mt-4">
                                                        <div class="avatar-sm mr-3">
                                                            <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                                    J
                                                                </span>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="font-size-16 mb-1">Jessie Mitchell</h5>
                                                            <p class="mb-2">CEO of ABC Company</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>

                                        <a class="carousel-control-prev" href="#reviewExampleControls" role="button" data-slide="prev">
                                            <i class="mdi mdi-chevron-left carousel-control-icon"></i>
                                        </a>
                                        <a class="carousel-control-next" href="#reviewExampleControls" role="button" data-slide="next">
                                            <i class="mdi mdi-chevron-right carousel-control-icon"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                          <div class="col-xl-3">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="text-white-50">
                                        <h5 class="text-white"><?php echo __('member::strings.who_we_are'); ?></h5>
                                        <p> </p>
                                        <div>
                                            <a href="#" class="btn btn-outline-success btn-sm"><?php echo __('member::strings.view_more'); ?></a>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-8">
                                            <div class="mt-4">
                                                <img src="<?php echo e(URL::asset('/public/images/widget-img.png')); ?> " alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                    <!-- end row -->

     
                    <!-- end row -->

                    <div class="row">
                            <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Overview</h4>

                                    <div>

                                    <?php $__env->startComponent('member::common-components.dashboard-overview'); ?>
                                         <?php $__env->slot('mainClass'); ?> pb-3 border-bottom  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('title'); ?> New Visitors  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('total'); ?> 3,524  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('percentage'); ?>  2.06 %   <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('pClass'); ?> progress-bar bg-success  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('pValue'); ?> 62   <?php $__env->endSlot(); ?>
                                        
                                     <?php echo $__env->renderComponent(); ?>
                                    <?php $__env->startComponent('member::common-components.dashboard-overview'); ?>

                                         <?php $__env->slot('mainClass'); ?> pb-3 border-bottom mt-2  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('title'); ?> Product Views  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('total'); ?> 2,465 <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('percentage'); ?>   0.37 %  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('pClass'); ?>  progress-bar bg-warning  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('pValue'); ?> 48   <?php $__env->endSlot(); ?>
                                     <?php echo $__env->renderComponent(); ?>

                                    <?php $__env->startComponent('member::common-components.dashboard-overview'); ?>
                                         <?php $__env->slot('mainClass'); ?> pb-3  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('title'); ?> Revenue  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('total'); ?> $ 4,653 <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('percentage'); ?>   2.18 %  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('pClass'); ?>  progress-bar bg-success  <?php $__env->endSlot(); ?>
                                         <?php $__env->slot('pValue'); ?> 78   <?php $__env->endSlot(); ?>
                                     <?php echo $__env->renderComponent(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Latest Transactions</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Id no.</th>
                                                    <th scope="col">Billing Name</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col" colspan="2">Payment Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>15/01/2020</td>
                                                    <td>
                                                        <a href="#" class="text-body font-weight-medium">#SK1235</a>
                                                    </td>
                                                    <td>Werner Berlin</td>
                                                    <td>$ 125</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Paid</span></td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>16/01/2020</td>
                                                    <td>
                                                        <a href="#" class="text-body font-weight-medium">#SK1236</a>
                                                    </td>
                                                    <td>Robert Jordan</td>
                                                    <td>$ 118</td>
                                                    <td><span class="badge badge-soft-danger font-size-12">Chargeback</span></td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>17/01/2020</td>
                                                    <td>
                                                        <a href="#" class="text-body font-weight-medium">#SK1237</a>
                                                    </td>
                                                    <td>Daniel Finch</td>
                                                    <td>$ 115</td>
                                                    <td><span class="badge badge-soft-success font-size-12">Paid</span></td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>18/01/2020</td>
                                                    <td>
                                                        <a href="#" class="text-body font-weight-medium">#SK1238</a>
                                                    </td>
                                                    <td>James Hawkins</td>
                                                    <td>$ 121</td>
                                                    <td><span class="badge badge-soft-warning font-size-12">Refund</span></td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">View</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('member::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/index.blade.php ENDPATH**/ ?>