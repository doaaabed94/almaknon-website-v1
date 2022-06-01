
<!--   <div class="b-features">
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
 -->
    <div class="b-info footer">
        <div class="container">
            <div class="row">
 <div class="col-md-2 col-xs-6">

     <div class="col-xs-12">
                    <div class="b-footer__company wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="b-nav__logo">
                            <h3><a href="/">{!! __('frontend::main.name_logo_css') !!}</a></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12">
                    <address class="b-info__contacts wow zoomInUp" data-wow-delay="0.3s">
                        @if($configs->where('name', 'phone_main')->first()->value !== null)
                        <div class="b-info__contacts-item">
                            <span class="fa fa-phone"></span>
                            <em>Phone: {{ $configs->where('name', 'phone_main')->first()->value}}</em>
                        </div>
                        @endif
                        @if($configs->where('name', 'email')->first()->value !== null)
                        <div class="b-info__contacts-item">
                            <span class="fa fa-envelope"></span>
                            <em>Email: {{ $configs->where('name', 'email')->first()->value}}</em>
                        </div>
                        @endif
                    </address>
                </div>
               
                <div class="col-xs-12">
                    <div class="b-footer__content wow fadeInRight" data-wow-delay="0.3s">
                        <div class="b-footer__content-social">
                            <a href="{{ $configs->where('name', 'facebook')->first()->value}}"><span class="fa fa-facebook-square"></span></a>
                            <a href="{{ $configs->where('name', 'twitter')->first()->value}}"><span class="fa fa-twitter-square"></span></a>
                            <a href="{{ $configs->where('name', 'linkedin')->first()->value}}"><span class="fa fa-linkedin-square"></span></a>
                            <a href="{{ $configs->where('name', 'instagram')->first()->value}}"><span class="fa fa-instagram"></span></a>
                     
                    </div>
                </div>
            </div>
            </div>

 <div class="col-md-2 col-xs-6">
               <nav class="b-footer__content-nav col-xs-12">
                            <ul class="d-block">
                                <li><a href="/">{!! __('frontend::main.home') !!}</a></li>
                                <li><a href="/cars">{!! __('frontend::main.List_of_Car') !!}</a></li>
                                <li><a href="/about">{!! __('frontend::main.About') !!}</a></li>
                                <li><a href="/article">{!! __('frontend::main.Blog') !!}</a></li>
                                <li><a href="/contacts">{!! __('frontend::main.Contact') !!}</a></li>
                            </ul>
                        </nav>
            </div>


                 <div class="col-md-4 col-xs-6">
                    <div class="b-info__latest">
                        <h3>{!! __('frontend::main.last_cars') !!} </h3>
@foreach($last_cars->take(2) as $data)
                            @php
                                $dataLink            = route('CarController@single', ['slug' => $data->slug ? $data->slug : 'test']);
                                $dataDescription     = Str::limit($data->translateOrFirst()->description, 100);
                                $image_car           = $data->attachments->where('input_name', 'car_profile_img')->take(1)->first();
                                $dataTitle           = Str::limit($data->translateOrFirst()->name, 110);
                            @endphp

                        <div class="b-info__latest-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__latest-article-photo m-audi">  @if($image_car)
                        <img alt="{{$image_car->title . (!is_null($image_car->description) ? ', ' . $image_car->description : '') }}" class="img-responsive img8080" src="{{$image_car->getThumbnail('80x80')}}">
                            @else
                            <img alt="mazda" class="img-responsive img8080" src="{{ URL::asset('public/default.png') }}" />
                            @endif</div>
                                 <div class="b-info__latest-article-info">
                                <h6><a href="{{$dataLink}}">{{ $dataTitle }}</a></h6>
                               {!! \Illuminate\Support\Str::limit($data->translateOrFirst()->description, 80) !!}
                            </div>
                        </div>
                      @endforeach
                     
                    </div>
                </div>


                 <div class="col-md-4 col-xs-6">
                    <div class="b-info__latest">
                        <h3>{!! __('frontend::main.last_blogs') !!} </h3>
                        @foreach($last_blogs->take(2) as $article)
                      @php
                                $dataLink   = route('BlogController@single', ['slug' => $article->slug ? $article->slug : 'test']);
                                $dataTitle           = Str::limit($article->translateOrFirst()->name, 110);
                                $blog_img           = $article->attachments->where('input_name', 'main_contant_img')->take(1)->first();
                            @endphp
                        <div class="b-info__latest-article wow zoomInUp" data-wow-delay="0.3s">
                            <div class="b-info__latest-article-photo m-audi">
                                @if($blog_img)
                    <img alt="{{$blog_img->title . (!is_null($blog_img->description) ? ', ' . $blog_img->description : '') }}" class="img8080 img-responsive " src="{{$blog_img->getThumbnail('80x80')}}">
                        @else
                        <img alt="mazda" class="img-responsive img8080" src="{{ URL::asset('public/default.png') }}"/>
                        @endif
                            </div>
                            <div class="b-info__latest-article-info">
                                <h6><a href="{{$dataLink}}">{{ $dataTitle }}</a></h6>
                               {!! \Illuminate\Support\Str::limit($article->translateOrFirst()->description, 80) !!}

                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>

        </div>
    </div>
<style type="text/css">
    .b-footer__content-nav ul li {
    list-style: none;
    float: unset !important;
    margin-left: 15px;
    margin-top: 15px !important;
}
.b-footer__content-social {
    text-align: inherit !important;
}
.b-info__contacts, .b-info__map {
    margin-left: 15px;
    margin-bottom: 0;
    margin: 20px 0px 0px 0px !important;
}
.b-footer__content {
    float: unset !important;
    
}
.b-info {
    padding: 38px 0 30px 0;
}
.footer .b-nav__logo h3 a {
    color: #1e74ff;
}
.footer .b-nav__logo h3 a span {
    color: #ffffff;
}
.footer a {
    color: #d8d8d8;
}

.footer .b-info__latest > h3, .footer .b-info__aside-article > h3, .footer .b-info__twitter > h3,.footer .b-info__contacts > p {
    color: #1e74ff;
}
.img8080{
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 1px solid #ddd;
}
.b-auto {
    padding: 80px 0 0px 0 !important;
    }
</style>
<!-- 
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
    <footer class="b-footer">
        <a id="to-top" href="#this-is-top"><i class="fa fa-chevron-up"></i></a>
        <div class="container">
            <div class="row">
                <div class="col-xs-4">
                    <div class="b-footer__company wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="b-nav__logo">
                            <h3><a href="/">{!! __('frontend::main.name_logo_css') !!}</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="b-footer__content wow fadeInRight" data-wow-delay="0.3s">
                        <div class="b-footer__content-social">
                            <a href="#"><span class="fa fa-facebook-square"></span></a>
                            <a href="#"><span class="fa fa-twitter-square"></span></a>
                            <a href="#"><span class="fa fa-google-plus-square"></span></a>
                            <a href="#"><span class="fa fa-instagram"></span></a>
                            <a href="#"><span class="fa fa-youtube-square"></span></a>
                            <a href="#"><span class="fa fa-skype"></span></a>
                        </div>
                        <nav class="b-footer__content-nav">
                            <ul>
                                <li><a href="/">{!! __('frontend::main.home') !!}</a></li>
                                <li><a href="/cars">{!! __('frontend::main.List_of_Car') !!}</a></li>
                                <li><a href="/about">{!! __('frontend::main.About') !!}</a></li>
                                <li><a href="/article">{!! __('frontend::main.Blog') !!}</a></li>
                                <li><a href="/contacts">{!! __('frontend::main.Contact') !!}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

    <style type="text/css">
        .8080{
            width:80px;
            height: 80px;
            object-fit: cover;
        }
    </style>