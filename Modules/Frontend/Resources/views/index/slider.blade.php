    <section class="b-slider">
        <div id="carousel" class="slide carousel carousel-fade">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{ URL::asset('public/frontend//media/main-slider/5.jpg') }}" alt="sliderImg" />
                    <div class="container">
                        <div class="carousel-caption b-slider__info">
                            <h3>{!! __('frontend::main.Find_your_Car') !!}</h3>
                            <h2>Lamborghini Aventador</h2>
                            <p>Model 2022 <span>$234,900</span></p>
                            <a class="btn m-btn" href="/">see details<span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ URL::asset('public/frontend//media/main-slider/6.jpg') }}" alt="sliderImg" />
                    <div class="container">
                        <div class="carousel-caption b-slider__info">
                            <h3>{!! __('frontend::main.Find_your_Car') !!}</h3>
                            <h2>Lamborghini Aventador</h2>
                            <p>Model 2022 <span>$200,900</span></p>
                            <a class="btn m-btn" href="/">see details<span class="fa fa-angle-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control right" href="#carousel" data-slide="next">
                <span class="fa fa-angle-right m-control-right"></span>
            </a>
            <a class="carousel-control left" href="#carousel" data-slide="prev">
                <span class="fa fa-angle-left m-control-left"></span>
            </a>
        </div>
    </section>