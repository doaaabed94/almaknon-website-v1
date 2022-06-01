   @extends('frontend::layouts.master')
   @section('content')
    <section class="b-pageHeader">
        <div class="container">
            <h1 class="wow zoomInLeft" data-wow-delay="0.7s">AutoClub Blog</h1>
            <div class="b-pageHeader__search wow zoomInRight" data-wow-delay="0.7s">
                <h3>Read Latest Auto News &amp; Reviews</h3>
            </div>
        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.7s">
            <a href="home.html" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a href="blog.html" class="b-breadCumbs__page">Blog Style 1</a><span class="fa fa-angle-right"></span><a href="article.html" class="b-breadCumbs__page m-active">Blog Post</a>
        </div>
    </div>
    <!--b-breadCumbs-->

    <section class="b-article">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12">
              @include('frontend::blogs.sidebar')
          </div>
          
            </div>
        </div>
    </section>
    <!--b-article-->
    @endsection