
    <aside class="b-blog__aside">
        <div class="b-blog__aside-popular wow zoomInUp" data-wow-delay="0.3s">
            <header class="s-lineDownLeft">
                <h2 class="s-titleDet">
                    {!! __('frontend::main.last_blogs') !!}
                </h2>
            </header>
                          @include('frontend::inc.box-blog' , ['articles' => $articles])
        </div>
        <div class="b-blog__aside-text wow zoomInUp" data-wow-delay="0.3s">
            <header class="s-lineDownLeft">
                <h2 class="s-titleDet">
                    <a href="{{route('BlogController@single' , ['slug' => $who_we_are->slug])}}">
                        {{ $who_we_are->translateOrFirst()->name }}
                    </a>
                </h2>
            </header>
            <p>
                {!! \Illuminate\Support\Str::limit($who_we_are->translateOrFirst()->description, 160) !!}
            </p>
            <a href="">
                {!! __('frontend::main.read_more') !!}
            </a>
        </div>
    </aside>
