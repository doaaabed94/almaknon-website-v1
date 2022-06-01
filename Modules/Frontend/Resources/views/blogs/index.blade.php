@extends('frontend::layouts.master')
   @section('content')

@component('frontend::inc.banner-title')
         @slot('text1')
            {!! __('frontend::main.blogs') !!}
        @endslot

         @slot('text2')
            {!! __('frontend::main.blogs') !!}
        @endslot
    @endcomponent
<!--b-pageHeader-->
@component('frontend::inc.breadcrumbs')
         @slot('li_1')
            {!! __('frontend::main.blogs') !!}
        @endslot
    @endcomponent
<!--b-breadCumbs-->
<section class="b-article">
    <div class="container">
        <div class="row">
               <div class="col-md-9 col-xs-12">
                    <div class="b-article__main">
                        <div class="b-blog__posts-one">
                            <div class="row m-noBlockPadding">
                                <div class="col-sm-1 col-xs-2">
                                    <div class="b-blog__posts-one-author wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="b-blog__posts-one-author-img">

                                        </div>
                                        <div class="b-blog__posts-one-share s-lineDownCenter">SHARE THIS</div>
                                        <div class="b-blog__posts-one-social">
                                            <div>
                                                <a href="#"><span class="fa fa-google-plus-square "></span></a>
                                                <a href="#"><span class="fa  fa-facebook-square"></span></a>
                                            </div>
                                            <div>
                                                <a href="#"><span class="fa fa-twitter-square "></span></a>
                                                <a href="#"><span class="fa fa-pinterest-square"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-11 col-xs-10">
                                    <div class="b-blog__posts-one-body">
                                        <header class="b-blog__posts-one-body-head wow zoomInUp" data-wow-delay="0.5s">
                                            <h2 class="s-titleDet">Redesigned 2016 Nissan Maxima Introduced</h2>
                                            <div class="b-blog__posts-one-body-head-notes">
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-user"></span>Our Admin</span>
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-calendar-o"></span>20th May 2015</span>
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-comment"></span>5 Comments</span>
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-pencil"></span>AutoMarket, Tips &amp; Advice</span>
                                            </div>
                                        </header>
                                        <div class="b-blog__posts-one-body-main wow zoomInUp" data-wow-delay="0.5s">
                                            <div class="b-blog__posts-one-body-main-img">
                                                <ul class="bxslider enable-bx-slider" data-pager-custom="#bx-pager" data-mode="fade" data-pager-slide="false" data-mode-pager="horizontal" data-pager-qty="0">
                                                    <li><img class="img-responsive" src="media/750x300/blogBig1.jpg" alt="jaguar" /></li>
                                                    <li><img class="img-responsive" src="media/750x300/blogBig2.jpg" alt="jaguar" /></li>
                                                    <li><img class="img-responsive" src="media/750x300/blogBig3.jpg" alt="jaguar" /></li>
                                                </ul>
                                                <div class="b-blog__posts-one-body-main-img-small" id="bx-pager">
                                                    <a href="#" data-slide-index="0"><img src="media/90x65/smallBlog1.jpg" alt="car" /></a>
                                                    <a href="#" data-slide-index="1"><img src="media/90x65/smallBlog2.jpg" alt="car" /></a>
                                                    <a href="#" data-slide-index="2"><img src="media/90x65/smallBlog3.jpg" alt="car" /></a>
                                                </div>
                                            </div>
                                            <p>Et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo con equat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaec cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque <a href="#">laudantium totam rem aperiam, eaque ipsa</a> quae ab illo inventore veritatis quas architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>
                                            <blockquote>
                                                Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae quam. Vivamus nunc. Nunc conseq usemd veld metus imperdiet lacinia. In viverra dolor non justo. Proin molest erat inder rhoncus posuere de nibh quam onsectet uer lectus acwl vulputate ligula lorem dolor. Donec nunc. Suspendisse potent.
                                            </blockquote>
                                            <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae quam. Vivamus etdu nunc. Nunc conseq sem velde metus imperdiet lacinia. Cras ornare pretium tortor.<a href="#">Donec sed augue sed nunc rutrum egestas.</a> Bulum ante ipsum mis in faucibus orci luctus et ultrices posuere.</p>
                                        </div>
                                        <div class="b-blog__posts-one-body-why wow zoomInUp" data-wow-delay="0.5s">
                                            <div class="s-lineDownLeft  s-titleLeft">
                                                <div>
                                                    <h2 class="s-titleDet">WHY NISSAN maxima is top the line</h2>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae quam. Vivamus etdug nunc. Nunc conseq sem velde metus imperdiet lacinia. Cras ornare pretium tortor. Donec sed augue sed nunc rutrum egestas. Bulum ante ipsum mis in faucibus orci luctus et ultrices posuere.</p>
                                            <ul class="s-list">
                                                <li><span class="fa fa-check"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor </li>
                                                <li><span class="fa fa-check"></span>ncididunt ut labore et dolore magna aliqua. Ut enim ad minim </li>
                                                <li><span class="fa fa-check"></span>Veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea </li>
                                                <li><span class="fa fa-check"></span>Commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse Billum </li>
                                                <li><span class="fa fa-check"></span>dolore eu fugiat nulla pariatur. Excepteur sint occaecat </li>
                                                <li><span class="fa fa-check"></span>Mupidatat non proident sunt in culpa qui officia deserun </li>
                                            </ul>
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <img src="media/articles/article.jpg" class="img-responsive" alt="nissan" />
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <p class="m-smallMargin">Lorem ipsum dolor sit amet, consectetur adipisic aing elit sed do eiusmod tempor incididunt ut labore etern dolore magna aliqua. Ut enim ad minim veniam, quis nost ruder exercitation ullamco laboris nisi ut aliquip ex commod oil consequat. Duis aute irure do reprehenderit ind voluptat velit esse cillum dolore fugiat nulla pariatur. </p>
                                                    <p>Excepteur sint occaecat cupidatat non proident sunter in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                                                </div>
                                            </div>
                                            <p>Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo en
                                                ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magn dolores eos qu rat voluptatem
                                                sequi nesciunt. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectet derur adipisci velit sed quia non
                                                numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
                                        </div>
                                        <div class="b-blog__posts-one-body-tags wow zoomInUp" data-wow-delay="0.5s">
                                            <span class="fa fa-tags"></span>
                                            TAGS:
                                            <a href="#">bmw</a>
                                            <a href="#">comparison</a>
                                            <a href="#">comparison test</a>
                                            <a href="#">coupe</a>
                                            <a href="#">f-type</a>
                                            <a href="#">jaguar</a>
                                            <a href="#">m4</a>
                                            <a href="#">slideshow</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-article__main-related s-shadow">
                            <div class="s-lineDownLeft  s-titleLeft">
                                <div>
                                    <h2 class="s-titleDet wow zoomInUp" data-wow-delay="0.5s">More Related Articles</h2>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="b-article__main-related-item wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="row m-smallPadding">
                                            <div class="col-xs-4">
                                                <img class="center-block img-responsive" src="media/100x80/related1.jpg" alt="related" />
                                            </div>
                                            <div class="col-xs-8">
                                                <h5><a href="article.html">2015 Jaguar F-Type Coupe in the Spanish Pyrenees</a></h5>
                                                <div class="b-blog__posts-one-body-head-notes">
                                                    <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-user"></span>Our Admin</span>
                                                    <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-calendar-o"></span>20th May 2015</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="b-article__main-related-item wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="row m-smallPadding">
                                            <div class="col-xs-4">
                                                <img class="center-block img-responsive" src="media/100x80/related2.jpg" alt="related" />
                                            </div>
                                            <div class="col-xs-8">
                                                <h5><a href="article.html">Used 2008 to 2014 Mercedes-Benz C-Class Review</a></h5>
                                                <div class="b-blog__posts-one-body-head-notes">
                                                    <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-user"></span>Our Admin</span>
                                                    <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-calendar-o"></span>20th May 2015</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-article__main-author wow zoomInUp" data-wow-delay="0.5s">
                            <div class="row">
                                <div class="col-xs-2 pull-right">
                                    <div class="b-blog__posts-one-author-img pull-right"></div>
                                </div>
                                <div class="col-xs-10 pull-right">
                                    <h3><span>AUTHOR: </span> JOHN SMITH</h3>
                                    <div class="b-article__main-author-social">
                                        <a href="#" class=""><span class="fa fa-facebook"></span></a>
                                        <a href="#" class=""><span class="fa fa-twitter"></span></a>
                                        <a href='#' class=""><span class="fa fa-google-plus"></span></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p>Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                                        Neen ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntu mag dolores eo quv
                                        ol up tatem sequi nesciunt. Neque porro quisquam est qui dolorem ipsum quia dolor.</p>
                                </div>
                            </div>
                        </div>
                        <div class="b-article__main-comments">
                            <div class="s-lineDownLeft  s-titleLeft">
                                <div class=" wow zoomInUp" data-wow-delay="0.5s">
                                    <h2 class="s-titleDet">COMMENTS</h2>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="b-article__main-comments-one wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="b-article__main-comments-one-person">
                                            <div class="b-blog__posts-one-author-img"></div>
                                        </div>
                                        <div class="b-article__main-comments-one-text">
                                            <header class="b-article__main-comments-one-text-head">
                                                <h6>William Shane</h6>
                                                <div class="b-article__main-comments-one-text-head-date">
                                                    <span>30 MAY 2015</span>
                                                    <span>Posted at 12:25 AM</span>
                                                </div>
                                                <a class="b-article__main-comments-one-text-head-answer  pull-right" href="#"><span class="fa fa-long-arrow-left"></span></a>
                                            </header>
                                            <p>
                                                In eget dolor. Lorem ipsum dolor sit amet consectetuer adipiscing elit. Ut ornare cursus nibh. Sed lorem volutpat purus scel erisque dapibus. Etiam adipiscing ante nec nibh. In in felis in metus mollis blandit.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="b-article__main-comments-one m-second wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="b-article__main-comments-one-person">
                                            <div class="b-blog__posts-one-author-img m-woomen"></div>
                                        </div>
                                        <div class="b-article__main-comments-one-text">
                                            <header class="b-article__main-comments-one-text-head">
                                                <h6>Martina Kathrine</h6>
                                                <div class="b-article__main-comments-one-text-head-date">
                                                    <span>30 MAY 2015</span>
                                                    <span>Posted at 12:25 AM</span>
                                                </div>
                                                <a class="b-article__main-comments-one-text-head-answer  pull-right" href="#"><span class="fa fa-long-arrow-left"></span></a>
                                            </header>
                                            <p>
                                                In eget dolor. Lorem ipsum dolor sit amet consectetuer adipiscing elit. Ut ornare cursus nibh. Sed lorem volutpat purus scel erisque dapibus. Etiam adipiscing ante nec nibh. In in felis in metus mollis blandit.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-article__main-add wow zoomInUp" data-wow-delay="0.5s">
                            <div class="s-lineDownLeft  s-titleLeft">
                                <div>
                                    <h2 class="s-titleDet">ADD A REPLY</h2>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <form action="/" method="POST">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input placeholder="YOUR NAME" type="text" name="name" />
                                    </div>
                                    <div class="col-xs-4">
                                        <input placeholder="EMAIL ADDRESS" type="text" name="email" />
                                    </div>
                                    <div class="col-xs-4">
                                        <input placeholder="WEBSITE" type="text" name="website" />
                                    </div>
                                </div>
                                <textarea name="text" placeholder="MESSAGE"></textarea>
                                <button type="submit" class="btn m-btn">SEND COMMENT<span class="fa fa-angle-right"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <aside class="b-blog__aside">
                        <form class="b-blog__aside-search wow zoomInUp" data-wow-delay="0.5s" action="/" method="post">
                            <div>
                                <input type="text" name="search" value="" placeholder="Search" />
                                <button type="submit"><span class="fa fa-search"></span></button>
                            </div>
                        </form>
                        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.5s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">CATEGORIES</h2>
                            </header>
                            <nav>
                                <ul class="b-blog__aside-categories-list">
                                    <li><a href="#">Auto Buying Tips &amp; Advice</a></li>
                                    <li><a href="#">Latest Models News</a></li>
                                    <li class="m-active"><a href="#">Test Drives</a></li>
                                    <li><a href="#">Video Reviews</a></li>
                                    <li><a href="#">Analysis &amp; Features</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="b-blog__aside-popular wow zoomInUp" data-wow-delay="0.5s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">POPULAR POSTS</h2>
                            </header>
                            <div class="b-blog__aside-popular-posts">
                                <div class="b-blog__aside-popular-posts-one">
                                    <img class="img-responsive" src="media/270x150/mercBlog.png" alt="merc" />
                                    <h4><a href="article.html">2016 Mercedes-Benz GLE-Class Debuts</a></h4>
                                    <div class="b-blog__aside-popular-posts-one-date"><span class="fa fa-calendar-o"></span>20th May 2015</div>
                                </div>
                                <div class="b-blog__aside-popular-posts-one">
                                    <img class="img-responsive" src="media/270x150/outlander.png" alt="outlander" />
                                    <h4><a href="article.html">Refreshed 2016 Mitsubishi Outlander</a></h4>
                                    <div class="b-blog__aside-popular-posts-one-date"><span class="fa fa-calendar-o"></span>20th May 2015</div>
                                </div>
                            </div>
                        </div>
                        <div class="b-blog__aside-text wow zoomInUp" data-wow-delay="0.5s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">WHY CHOOSE US?</h2>
                            </header>
                            <p>Curabitur libero. Donec facilisis velit edu est
                                Phasellus conside quat. Aenean vitae quam.
                                Vivamus etdu nunc. Nunc conseq sem velde
                                metus imperdiet lacinia. Cras ornare pretum
                                tortor. Donec sed augue sed nunc rutru me
                                egestas. Bulum ante ipsum primisn faucibus
                                orci luctus et ultrices posuere.</p>
                        </div>
                        <div class="b-blog__aside-reviews wow zoomInUp" data-wow-delay="0.5s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">LATEST REVIEWS</h2>
                            </header>
                            <div class="b-blog__aside-reviews-posts">
                                <div class="b-blog__aside-reviews-posts-one">
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-5">
                                            <img src="media/100x80/audiRev.jpg" alt="audi" class="img-responsive pull-right" />
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="b-blog__aside-reviews-posts-one-info">
                                                <p>First Drive:<br />2016 Audi Q3</p>
                                                <div class="b-world__item-val">
                                                    <div class="b-world__item-val-circles">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span class="m-empty"></span>
                                                    </div>
                                                    <span class="b-world__item-num">4.1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-blog__aside-reviews-posts-one">
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-5">
                                            <img src="media/100x80/mercRev.jpg" alt="merc" class="img-responsive  pull-right" />
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="b-blog__aside-reviews-posts-one-info">
                                                <p>Mercedes-Benz GLA Class 2015 Hottest Hatch</p>
                                                <div class="b-world__item-val">
                                                    <div class="b-world__item-val-circles">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span class="m-empty"></span>
                                                    </div>
                                                    <span class="b-world__item-num">4.1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-blog__aside-reviews-posts-one">
                                    <div class="row m-smallPadding">
                                        <div class="col-xs-5">
                                            <img src="media/100x80/mazdaRev.jpg" alt="" class="img-responsive  pull-right" />
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="b-blog__aside-reviews-posts-one-info">
                                                <p>First Look: <br />2016 Mazda CX-3</p>
                                                <div class="b-world__item-val">
                                                    <div class="b-world__item-val-circles">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span class="m-empty"></span>
                                                    </div>
                                                    <span class="b-world__item-num">4.1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="b-blog__aside-archives wow zoomInUp" data-wow-delay="0.5s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">ARCHIVES</h2>
                            </header>
                            <nav>
                                <ul class="b-blog__aside-categories-list">
                                    <li><a href="#">April 2015</a></li>
                                    <li><a href="#">March 2015</a></li>
                                    <li class="m-active"><a href="#">February 2015</a></li>
                                    <li><a href="#">January 2105</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="b-items__aside-sell wow zoomInUp" data-wow-delay="0.5s">
                            <div class="b-items__aside-sell-img">
                                <h3>SELL YOUR CAR</h3>
                            </div>
                            <div class="b-items__aside-sell-info">
                                <p>
                                    Nam tellus enimds eleifend dignis lsim
                                    biben edum tristique sed metus fusce
                                    Maecenas lobortis.
                                </p>
                                <a href="submit1.html" class="btn m-btn">REGISTER NOW<span class="fa fa-angle-right"></span></a>
                            </div>
                        </div>
                        <div class="b-detail__main-aside-about-call wow zoomInUp" data-wow-delay="0.5s">
                            <span class="fa fa-phone"></span>
                            <div>1-888-378-4027</div>
                            <p>QUESTIONS? CALL US 24/7</p>
                        </div>
                    </aside>
                </div>
            <div class="col-md-3 col-xs-12">
                @include('frontend::blogs.sidebar')
            </div>
        </div>
    </div>
</section>
<!--b-article-->
@endsection
