<section class="b-featured">
    <div class="container">
        <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">
            Featured Vehicles
        </h2>
        <div class="owl-carousel enable-owl-carousel" data-auto-play="true" data-items="4" data-items-desktop="4" data-items-desktop-small="4" data-items-tablet="3" data-items-tablet-small="2" data-navigation="true" data-stop-on-hover="true" id="carousel-small">
            @foreach($last_cars as $data)
                                 
                            @php
                                $dataLink   = route('CarController@single', ['slug' => $data->slug ? $data->slug : 'test']);
                                $dataDescription     = Str::limit($data->translateOrFirst()->description, 100);
                                $dataTitle           = Str::limit($data->translateOrFirst()->name, 110);
                                $image_car           = $data->attachments->where('input_name', 'car_profile_img')->take(1)->first();
                            @endphp
            <div>
                <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                    <a href="{{ $dataLink }}">
                        @if($image_car)
                        <img alt="{{$image_car->title . (!is_null($image_car->description) ? ', ' . $image_car->description : '') }}" class="img-responsive last_car_box_img" src="{{$image_car->getThumbnail('280x180')}}">
                            @else
                            <img alt="mazda" class="img-responsive last_car_box_img" src="{{ URL::asset('public/default.png') }}" />
                            @endif
                            <span class="m-premium">
                                @if($data->offer_id)
                            {{ $data->Offer->translateOrFirst()->name ? $data->Offer->translateOrFirst()->name :  $data->Offer->name }}
                        @endif
                            </span>
                        </img>
                    </a>
                    <div class="b-featured__item-price">
                        @if($data->price)
                        <span class="m-price">
                            $ {{ $data->price }}
                        </span>
                        @endif
                    </div>
                    <div class="clearfix">
                    </div>
                    <h5>
                        <a href="{{ $dataLink }}">
                            {{ $dataTitle }}
                        </a>
                    </h5>
                    <div class="b-featured__item-count">
                       
                         @if($data->years)
                        <span>
                            {{ $data->years }}
                        </span>
                        @endif
                                        @if($data->kilometer)
                        <span class="m-number">
                            <span class="fa fa-tachometer">
                            </span>
                            {{ $data->kilometer }} KM
                        </span>
                        @endif
                    </div>
                    <div class="b-featured__item-links">
                        @if($data->marka_id)
                        <a href="{{ $dataLink }}">
                            {{ $data->marka->translateOrFirst()->name ? $data->marka->translateOrFirst()->name :  $data->Marka->name }}
                        </a>
                        @endif
                                        @if($data->fuel_id)
                        <a href="{{ $dataLink }}">
                            {{ $data->fuel->translateOrFirst()->name ? $data->fuel->translateOrFirst()->name :  $data->fuel->name }}
                        </a>
                        @endif
                                        @if($data->condition_id)
                        <a href="{{ $dataLink }}">
                            {{ $data->condition->translateOrFirst()->name ? $data->condition->translateOrFirst()->name :  $data->condition->name }}
                        </a>
                        @endif
                                        @if($data->years)
                        <a href="{{ $dataLink }}">
                            {{ $data->years }}
                        </a>
                        @endif
                                        @if($data->colors)
                        <a href="{{ $dataLink }}">
                            {{ $data->colors }}
                        </a>
                        @endif
                                        @if($data->transmission)
                        <a href="{{ $dataLink }}">
                            {{ $data->transmission }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style type="text/css">
    
    .last_car_box_img{
        height: 180px;
        width: 288px;
        object-fit: cover;
    }
</style>
