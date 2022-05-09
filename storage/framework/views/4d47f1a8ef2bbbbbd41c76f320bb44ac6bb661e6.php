   
   <?php $__env->startSection('content'); ?>

        <?php echo $__env->make('frontend::index.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('frontend::index.filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--b-slider-->



   

       <?php echo $__env->make('frontend::index.lists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="b-world">
        <div class="container">
            <h6 class="wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">EVERYTHING YOU NEED TO KNOW</h6><br />
            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">THE WORLD OF CARS</h2>
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                        <img class="img-responsive" src="<?php echo e(URL::asset('public/frontend//media/370x200/wolks.jpg')); ?>" alt="wolks" />
                        <div class="b-world__item-val">
                            <span class="b-world__item-val-title">FIRST DRIVE REVIEW</span>
                            <div class="b-world__item-val-circles">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="m-empty"></span>
                            </div>
                            <span class="b-world__item-num">4.1</span>
                        </div>
                        <h2>2016 Volkswagen Golf R SportWagen</h2>
                        <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae quam. Vivamus et nunc. Nunc consequ
                            sem velde metus imperdiet lacinia.</p>
                        <a href="article.html" class="btn m-btn">READ MORE<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="b-world__item wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">
                        <img class="img-responsive" src="<?php echo e(URL::asset('public/frontend//media/370x200/mazda.jpg')); ?>" alt="mazda" />
                        <div class="b-world__item-val">
                            <span class="b-world__item-val-title">INSTRUMENTED TEST</span>
                            <div class="b-world__item-val-circles">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span class="m-halfEmpty"></span>
                            </div>
                            <span class="b-world__item-num">4.5</span>
                        </div>
                        <h2>2016 Mazda CX-5 2.5L AWD</h2>
                        <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae quam. Vivamus et nunc. Nunc consequ
                            sem velde metus imp erdiet lacinia.</p>
                        <a href="article.html" class="btn m-btn m-active">READ MORE<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="b-world__item j-item wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">
                        <img class="img-responsive" src="<?php echo e(URL::asset('public/frontend//media/370x200/chevrolet.jpg')); ?>" alt="chevrolet" />
                        <div class="b-world__item-val">
                            <span class="b-world__item-val-title">BUYERS INFO</span>
                            <div class="b-world__item-val-circles">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <span class="b-world__item-num">5.0</span>
                        </div>
                        <h2>Advantages of Buying New or Used Vehicle</h2>
                        <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae quam. Vivamus et nunc. Nunc consequ
                            sem velde metus imp erdiet lacinia.</p>
                        <a href="article.html" class="btn m-btn">READ MORE<span class="fa fa-angle-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--b-world-->

    <section class="b-review">
        <div class="container">
            <h2 class="s-title wow zoomInRight text-center" data-wow-delay="0.3s" data-wow-offset="100">Reviews</h2>
            <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div id="carousel-small-rev" class="owl-carousel enable-owl-carousel" data-items="1" data-navigation="true" data-auto-play="true" data-stop-on-hover="true" data-items-desktop="1" data-items-desktop-small="1" data-items-tablet="1" data-items-tablet-small="1">
                    <div class="b-review__main">
                        <div class="b-review__main-person">
                            <div class="b-review__main-person-inside">
                            </div>
                        </div>
                        <h5><span>DONALD BROOKS</span>, Customer, Ferrari 488 GTB 2 Owner<em>"</em></h5>
                        <p>Donec facilisis velit eust. Phasellus cons quat. Aenean vitae quam. Vivamus et nunc. Nunc consequsem
                            velde metus imperdiet lacinia. Nam rutrum congue diam. Vestibulum acda risus eros auctor egestas. Morbids sem magna, viverra quis sollicitudin quis consectetuer quis nec magna.</p>
                    </div>
                    <div class="b-review__main">
                        <div class="b-review__main-person">
                            <div class="b-review__main-person-inside">
                            </div>
                        </div>
                        <h5><span>DONALD BROOKS</span>, Customer, Ferrari 488 GTB 2 Owner<em>"</em></h5>
                        <p>Donec facilisis velit eust. Phasellus cons quat. Aenean vitae quam. Vivamus et nunc. Nunc consequsem
                            velde metus imperdiet lacinia. Nam rutrum congue diam. Vestibulum acda risus eros auctor egestas. Morbids sem magna, viverra quis sollicitudin quis consectetuer quis nec magna.</p>
                    </div>
                    <div class="b-review__main">
                        <div class="b-review__main-person">
                            <div class="b-review__main-person-inside">
                            </div>
                        </div>
                        <h5><span>DONALD BROOKS</span>, Customer, Ferrari 488 GTB 2 Owner<em>"</em></h5>
                        <p>Donec facilisis velit eust. Phasellus cons quat. Aenean vitae quam. Vivamus et nunc. Nunc consequsem
                            velde metus imperdiet lacinia. Nam rutrum congue diam. Vestibulum acda risus eros auctor egestas. Morbids sem magna, viverra quis sollicitudin quis consectetuer quis nec magna.</p>
                    </div>
                </div>
            </div>
        </div>
        <img src="<?php echo e(URL::asset('public/frontend//images/backgrounds/reviews.jpg')); ?>" alt="" class="img-responsive center-block" />
    </section>
    <!--b-review-->

    <div class="b-features">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-3 col-xs-6 col-xs-offset-6">
                    <ul class="b-features__items">
                        <li class="wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">Low Prices, No Haggling</li>
                        <li class="wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">Largest Car Dealership</li>
                        <li class="wow zoomInUp" data-wow-delay="0.3s" data-wow-offset="100">Multipoint Safety Check</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--b-features-->

    <div class="b-info">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <aside class="b-info__aside wow zoomInLeft" data-wow-delay="0.3s">
                        <article class="b-info__aside-article">
                            <h3>OPENING HOURS</h3>
                            <div class="b-info__aside-article-item">
                                <h6>Sales Department</h6>
                                <p>Mon-Sat : 8:00am - 5:00pm<br />
                                    Sunday is closed</p>
                            </div>
                            <div class="b-info__aside-article-item">
                                <h6>Service Department</h6>
                                <p>Mon-Sat : 8:00am - 5:00pm<br />
                                    Sunday is closed</p>
                            </div>
                        </article>
                        <article class="b-info__aside-article">
                            <h3>About us</h3>
                            <p>Vestibulum varius od lio eget conseq
                                uat blandit, lorem auglue comm lodo
                                nisl non ultricies lectus nibh mas lsa
                                Duis scelerisque aliquet. Ante donec
                                libero pede porttitor dacu msan esct
                                venenatis quis.</p>
                        </article>
                        <a href="about.html" class="btn m-btn">Read More<span class="fa fa-angle-right"></span></a>
                    </aside>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="b-info__latest">
                        <h3>LATEST CARS</h3>
                        <div class="b-info__latest-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__latest-article-photo m-audi"></div>
                            <div class="b-info__latest-article-info">
                                <h6><a href="detail.html">MERCEDES-AMG GT S</a></h6>
                                <p><span class="fa fa-tachometer"></span> 35,000 KM</p>
                            </div>
                        </div>
                        <div class="b-info__latest-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__latest-article-photo m-audiSpyder"></div>
                            <div class="b-info__latest-article-info">
                                <h6><a href="#">AUDI R8 SPYDER V-8</a></h6>
                                <p><span class="fa fa-tachometer"></span> 35,000 KM</p>
                            </div>
                        </div>
                        <div class="b-info__latest-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__latest-article-photo m-aston"></div>
                            <div class="b-info__latest-article-info">
                                <h6><a href="#">ASTON MARTIN VANTAGE</a></h6>
                                <p><span class="fa fa-tachometer"></span> 35,000 KM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="b-info__twitter">
                        <h3>from twitter</h3>
                        <div class="b-info__twitter-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__twitter-article-icon"><span class="fa fa-twitter"></span></div>
                            <div class="b-info__twitter-article-content">
                                <p>Duis scelerisque aliquet ante donec libero pede porttitor dacu</p>
                                <span>20 minutes ago</span>
                            </div>
                        </div>
                        <div class="b-info__twitter-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__twitter-article-icon"><span class="fa fa-twitter"></span></div>
                            <div class="b-info__twitter-article-content">
                                <p>Duis scelerisque aliquet ante donec libero pede porttitor dacu</p>
                                <span>20 minutes ago</span>
                            </div>
                        </div>
                        <div class="b-info__twitter-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__twitter-article-icon"><span class="fa fa-twitter"></span></div>
                            <div class="b-info__twitter-article-content">
                                <p>Duis scelerisque aliquet ante donec libero pede porttitor dacu</p>
                                <span>20 minutes ago</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <address class="b-info__contacts wow zoomInUp" data-wow-delay="0.3s">
                        <p>contact us</p>
                        <div class="b-info__contacts-item">
                            <span class="fa fa-map-marker"></span>
                            <em>202 W 7th St, Suite 233 Los Angeles,
                                California 90014 USA</em>
                        </div>
                        <div class="b-info__contacts-item">
                            <span class="fa fa-phone"></span>
                            <em>Phone: +49 172 0000000</em>
                        </div>
                        <div class="b-info__contacts-item">
                            <span class="fa fa-fax"></span>
                            <em>FAX: +49 172 0000000</em>
                        </div>
                        <div class="b-info__contacts-item">
                            <span class="fa fa-envelope"></span>
                            <em>Email: info@almaknon.com</em>
                        </div>
                    </address>
                    <address class="b-info__map">
                        <a href="contacts.html">Open Location Map</a>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <!--b-info-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Frontend/Resources/views/index.blade.php ENDPATH**/ ?>