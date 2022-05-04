    
    <section class="b-auto">
        <div class="container">
            <h5 class="s-titleBg wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">GIVING OUR CUSTOMERS BEST DEALS</h5><br />
            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">BEST OFFERS FROM AUTOCLUB</h2>
            <div class="row">
                <div class="col-xs-5 col-sm-4 col-md-3">
                    <aside class="b-auto__main-nav wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                        <ul>
                            <li class="active"><a href="#">All Manufacturers</a><span class="fa fa-angle-right"></span></li>
                           <?php $__currentLoopData = $markas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="#"><?php echo e($data->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         
                        </ul>
                        <div class="owl-buttons">
                            <div class="owl-prev j-tab" data-to='#first'></div>
                            <div class="owl-next j-tab" data-to='#second'></div>
                        </div>
                    </aside>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-7">
                    <div class="b-auto__main">
                        <div class="row m-margin" id="first">
                            <?php $__currentLoopData = $last_cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $dataLink   = route('CarController@single', ['slug' => $data->slug ? $data->slug : 'test']);
                                $dataDescription     = Str::limit($data->translateOrFirst()->description, 100);
                                $dataTitle           = Str::limit($data->translateOrFirst()->name, 110);
                            ?>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="b-auto__main-item wow slideInUp" data-wow-delay="0.3s" data-wow-offset="100">
                                    <?php if($data->imgae): ?>
                                    <img class="img-responsive" src="<?php echo e(URL::asset('public/frontend//media/270x150/acura.jpg')); ?>" alt="mazda" />
                                    <?php else: ?>
                                    <img class="img-responsive" src="<?php echo e(URL::asset('public/frontend//media/270x150/acura.jpg')); ?>" alt="mazda" />
                                    <?php endif; ?>
                                    <div class="b-world__item-val">
                                        <span class="b-world__item-val-title">REGISTERED <?php if($data->years): ?><span><?php echo e($data->years); ?></span><?php endif; ?></span>
                                    </div>
                                    <h2><a href="<?php echo e($dataLink); ?>"><?php echo e($dataTitle); ?></a></h2>
                                    <div class="b-auto__main-item-info">
                                         <?php if($data->price): ?> <span class="m-price">
                                            $ <?php echo e($data->price); ?>

                                        </span><?php endif; ?>
                                        <?php if($data->kilometer): ?><span class="m-number">
                                            <span class="fa fa-tachometer"></span><?php echo e($data->kilometer); ?> KM
                                        </span><?php endif; ?>
                                    </div>
                                    <div class="b-featured__item-links m-auto">
                                        <?php if($data->marka_id): ?><a href="#"><?php echo e($data->marka->translateOrFirst()->name ? $data->Marka->translateOrFirst()->name :  $data->Marka->name); ?></a><?php endif; ?>
                                        <?php if($data->fuel_id): ?><a href="#"><?php echo e($data->fuel->translateOrFirst()->name ? $data->fuel->translateOrFirst()->name :  $data->fuel->name); ?></a><?php endif; ?>
                                        <?php if($data->condition_id): ?><a href="#"><?php echo e($data->condition->translateOrFirst()->name ? $data->condition->translateOrFirst()->name :  $data->condition->name); ?></a><?php endif; ?>
                                        <?php if($data->years): ?><a href="#"><?php echo e($data->years); ?></a><?php endif; ?>
                                        <?php if($data->colors): ?><a href="#"><?php echo e($data->colors); ?></a><?php endif; ?>
                                        <?php if($data->transmission): ?><a href="#"><?php echo e($data->transmission); ?></a><?php endif; ?>
                                       
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php /**PATH C:\Users\isc\Desktop\almaknon.com\Modules/Frontend\Resources/views/index/lists.blade.php ENDPATH**/ ?>