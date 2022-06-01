<section class="b-world">
    <div class="container">
        <h6 class="wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
           {{ __('frontend::main.main_title_blog') }}
        </h6>
        <br/>
        <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">
           {{ __('frontend::main.sub_title_blog') }}
        </h2>
        <div class="row">
            @foreach($last_blogs as $article)
                      @php
                                $dataLink   = route('BlogController@single', ['slug' => $article->slug ? $article->slug : 'test']);
                                $dataDescription     = Str::limit($article->translateOrFirst()->description, 160);
                                $dataTitle           = Str::limit($article->translateOrFirst()->name, 110);
                                $blog_img           = $article->attachments->where('input_name', 'main_contant_img')->take(1)->first();
                            @endphp
            <div class="col-sm-4 col-xs-12">
                <div class="b-world__item j-item wow zoomInRight blog-box_div" data-wow-delay="0.3s" data-wow-offset="100">
                    @if($blog_img)
                    <img alt="{{$blog_img->title . (!is_null($blog_img->description) ? ', ' . $blog_img->description : '') }}" class="img-responsive blog_img" src="{{$blog_img->getThumbnail('280x180')}}">
                        @else
                        <img alt="mazda" class="img-responsive blog_img" src="{{ URL::asset('public/default.png') }}"/>
                        @endif
                        <h2 style="margin: 25px 0px;">
                            {{ $dataTitle }}
                        </h2>
                        {!! \Illuminate\Support\Str::limit($article->translateOrFirst()->description, 100) !!}
                        <a class="btn m-btn btn-blog" href="{{$dataLink}}">
                                       {{ __('frontend::main.read_more') }}
                            <span class="fa fa-angle-right">
                            </span>
                        </a>
                    </img>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<style type="text/css">
    .blog_img{
            height: 180px;
    width: 100%;
    object-fit: cover;
    }
    .blog-box_div{
        padding: 10px;
    border: 1px solid #dddddd;background: #fff;
 /*   border-radius: 25px; */
    min-height: 400px;
    }
    .btn-blog{
        margin-bottom: 0px;
        margin-top: 20px;
    padding: 5px 5px 5px 25px !important;
    }
    .blog-box_div p {
    margin: 10px 0px;
    padding: 5px 0px 0px 0px;
}

</style>
