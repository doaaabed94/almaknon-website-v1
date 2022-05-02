    
    <section class="b-auto">
        <div class="container">
            <h5 class="s-titleBg wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">GIVING OUR CUSTOMERS BEST DEALS</h5><br />
            <h2 class="s-title wow zoomInRight" data-wow-delay="0.3s" data-wow-offset="100">BEST OFFERS FROM AUTOCLUB</h2>
            <div class="row">
                <div class="col-xs-5 col-sm-4 col-md-3">
                    <aside class="b-auto__main-nav wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                        <ul>
                            <li class="active"><a href="#">All Manufacturers</a><span class="fa fa-angle-right"></span></li>
                           @foreach($markas as $data)
                            <li><a href="#">{{ $data->name }}</a></li>
                            @endforeach
                         
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
                            @foreach($last_cars as $data)

                            @php
                                $dataLink   = route('CarController@single', ['slug' => $data->slug ? $data->slug : 'test']);
                                $dataDescription     = Str::limit($data->translateOrFirst()->description, 100);
                                $dataTitle           = Str::limit($data->translateOrFirst()->name, 110);
                            @endphp

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="b-auto__main-item wow slideInUp" data-wow-delay="0.3s" data-wow-offset="100">
                                    @if($data->imgae)
                                    <img class="img-responsive" src="{{ URL::asset('public/frontend//media/270x150/acura.jpg') }}" alt="mazda" />
                                    @else
                                    <img class="img-responsive" src="{{ URL::asset('public/frontend//media/270x150/acura.jpg') }}" alt="mazda" />
                                    @endif
                                    <div class="b-world__item-val">
                                        <span class="b-world__item-val-title">REGISTERED @if($data->years)<span>{{ $data->years }}</span>@endif</span>
                                    </div>
                                    <h2><a href="{{ $dataLink }}">{{ $dataTitle }}</a></h2>
                                    <div class="b-auto__main-item-info">
                                         @if($data->price) <span class="m-price">
                                            $ {{ $data->price }}
                                        </span>@endif
                                        @if($data->kilometer)<span class="m-number">
                                            <span class="fa fa-tachometer"></span>{{ $data->kilometer }} KM
                                        </span>@endif
                                    </div>
                                    <div class="b-featured__item-links m-auto">
                                        @if($data->marka_id)<a href="#">{{ $data->marka->translateOrFirst()->name ? $data->Marka->translateOrFirst()->name :  $data->Marka->name }}</a>@endif
                                        @if($data->fuel_id)<a href="#">{{ $data->fuel->translateOrFirst()->name ? $data->fuel->translateOrFirst()->name :  $data->fuel->name }}</a>@endif
                                        @if($data->condition_id)<a href="#">{{ $data->condition->translateOrFirst()->name ? $data->condition->translateOrFirst()->name :  $data->condition->name }}</a>@endif
                                        @if($data->years)<a href="#">{{ $data->years }}</a>@endif
                                        @if($data->colors)<a href="#">{{ $data->colors }}</a>@endif
                                        @if($data->transmission)<a href="#">{{ $data->transmission }}</a>@endif
                                       
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
