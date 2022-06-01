@extends('frontend::layouts.master')
   @section('content')

@component('frontend::inc.banner-title')
         @slot('text1')
           {{ $model->translateOrFirst()->name }}
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

         @slot('li_1_link')
            {!! __('frontend::main.blogs') !!}
        @endslot

         @slot('title_li')
            {{ $model->translateOrFirst()->name }}
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
                            <div class="col-sm-11 col-xs-10">
                                <div class="b-blog__posts-one-body">
                                    <header class="b-blog__posts-one-body-head wow zoomInUp" data-wow-delay="0.5s">
                                        <h2 class="s-titleDet">
                                            <a href="{{route('BlogController@single' , ['slug' => $model->slug])}}}">
                                                {{ $model->translateOrFirst()->name }}
                                            </a>
                                        </h2>
                                        <div class="b-blog__posts-one-body-head-notes">
                                            <span class="b-blog__posts-one-body-head-notes-note">
                                                <span class="fa fa-user">
                                                </span>
                                                {!! __('frontend::main.Our Admin') !!}
                                            </span>
                                            <span class="b-blog__posts-one-body-head-notes-note">
                                                <span class="fa fa-calendar-o">
                                                </span>
                                                {{\Modules\CMS\Entities\Traits\Helpers::parseDate($model->created_at, 'dS F Y')}}
                                            </span>
                                            <span class="b-blog__posts-one-body-head-notes-note">
                                                <span class="fa fa-pencil">
                                                </span>
                                                views
                                            </span>
                                        </div>
                                    </header>
                                    <div class="b-blog__posts-one-body-main wow zoomInUp" data-wow-delay="0.5s">
                                        <div class="b-blog__posts-one-body-main-img">
                                            @foreach ($model->attachments->where('input_name', 'main_contant_img') as  $attachment)
                                            <img alt="{{$attachment->title . (!is_null($attachment->description) ? ', ' . $attachment->description : '') }}" class="img-responsive" src="{{$attachment->getUid('1920x1079')}}">
                                                @endforeach
                                            </img>
                                        </div>
                                        <p>
                                            {!! $model->translateOrFirst()->description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                @include('frontend::blogs.sidebar')
            </div>
        </div>
    </div>
</section>
<!--b-article-->
@endsection
