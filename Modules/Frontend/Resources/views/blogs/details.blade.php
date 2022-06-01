   @extends('frontend::layouts.master')
   @section('content')
    <section class="b-pageHeader">
        <div class="container">
            <h1 class="wow zoomInLeft" data-wow-delay="0.7s"></h1>
            <div class="b-pageHeader__search wow zoomInRight" data-wow-delay="0.7s">
                <h3>Read Latest Auto News &amp; Reviews</h3>
            </div>
        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.7s">
            <a href="/" class="b-breadCumbs__page">Home</a>
            <span class="fa fa-angle-right"></span>
            <a href="blog.html" class="b-breadCumbs__page">Blog Style 1</a>
            <span class="fa fa-angle-right"></span>
            <a href="article.html" class="b-breadCumbs__page m-active">Blog Post</a>
        </div>
    </div>
    <!--b-breadCumbs-->

    <section class="b-article">
        <div class="container">
            <div class="row">
                             <div class="col-md-9 col-xs-12">
                    <div class="b-article__main">
                        <div class="b-blog__posts-one">
                            <div class="row m-noBlockPadding">
                                <div class="col-sm-11 col-xs-10">
                                    <div class="b-blog__posts-one-body">
                                        <header class="b-blog__posts-one-body-head wow zoomInUp" data-wow-delay="0.5s">
                                            <h2 class="s-titleDet"><a href="{{route('BlogController@single' , ['slug' => $model->slug])}}}">{{ $model->translateOrFirst()->name }}</a></h2>
                                            <div class="b-blog__posts-one-body-head-notes">
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-user"></span>Our Admin</span>
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-calendar-o"></span>{{\Modules\CMS\Entities\Traits\Helpers::parseDate($model->created_at, 'dS F Y')}}</span>
                                                <span class="b-blog__posts-one-body-head-notes-note"><span class="fa fa-pencil"></span>AutoMarket, Tips &amp; Advice</span>
                                            </div>
                                        </header>
                                        <div class="b-blog__posts-one-body-main wow zoomInUp" data-wow-delay="0.5s">
                                            <div class="b-blog__posts-one-body-main-img">
                                                    @foreach ($model->attachments->where('input_name', 'main_contant_img') as  $attachment)
                                        <img  class="img-responsive" src="{{$attachment->getUid('1920x1079')}}" alt="{{$attachment->title . (!is_null($attachment->description) ? ', ' . $attachment->description : '') }}">
                                    @endforeach
                                            </div>
                                            <p>{!! $model->translateOrFirst()->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>


                </div>

              @include('frontend::blogs.sidebar')
            </div>
        </div>
    </section>

    <!--b-article-->
    @endsection