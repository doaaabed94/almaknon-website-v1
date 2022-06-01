      @php
                            $defaultArticleImage = route('image', ['size' => '1000x750', 'path' => 'defaults/base.png']);
                        @endphp
                             @foreach ($articles->take(2) as $article)
                               @php
                                $dataLink   = route('BlogController@single', ['slug' => $article->slug ? $article->slug : 'test']);
                                $dataDescription     = Str::limit($article->translateOrFirst()->description, 160);
                                $dataTitle           = Str::limit($article->translateOrFirst()->name, 110);
                                $blog_img           = $article->attachments->where('input_name', 'main_contant_img')->take(1)->first();
                            @endphp
            <div class="b-blog__aside-popular-posts">
                <div class="b-blog__aside-popular-posts-one">
                    @if($blog_img)
                    <img alt="{{$blog_img->title . (!is_null($blog_img->description) ? ', ' . $blog_img->description : '') }}" class="img-responsive blog_img" src="{{$blog_img->getThumbnail('280x180')}}">
                        @else
                        <img alt="mazda" class="img-responsive blog_img" src="{{ URL::asset('public/default.png') }}"/>
                        @endif
                        <h4>
                            <a href="{{$dataLink}}">
                                {{ $dataTitle }}
                            </a>
                        </h4>
                        <div class="b-blog__aside-popular-posts-one-date">
                            <span class="fa fa-calendar-o">
                            </span>
                            {{\Modules\CMS\Entities\Traits\Helpers::parseDate($article->created_at, 'dS F Y')}}
                        </div>
                        <p>
                            {!! $dataDescription !!}
                        </p>
                </div>
            </div>
            <hr>
                @endforeach
            </hr>