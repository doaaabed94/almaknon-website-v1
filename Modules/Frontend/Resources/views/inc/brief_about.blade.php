        <section class="b-contact">
        <div class="container">
            <div class="row wow zoomInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                <div class="col-xs-4">
                    <div class="b-contact-title">
                        <h5 style="text-align: center;">{{ __('frontend::main.main_title_subscribe') }}</h5><br />
                        <h2 style="text-align: center;">{{ __('frontend::main.sub_title_subscribe') }}</h2>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="b-contact__form">
                        <p style="text-align: inherit;">{{ __('frontend::main.subscribe_desc') }}</p>
                                @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('danger'))
                                <div class="alert alert-danger">
                                    {{ session('danger') }}
                                </div>
                            @endif
                        <form action="{{ route('newsletter@postCreate') }}" method="POST">
                            @csrf
                            <div><input type="text" name="name" value="" placeholder="Your Name" /></div>
                            <div><input type="text" name="email" value="" placeholder="Your Email" /></div>
                            <button type="submit"><span class="fa fa-angle-right"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<style type="text/css">
    .b-contact__form input[type='text'] {
    width: 100%;
    margin-top: 10px;
}
.b-contact-title {
     margin:  0px;
}
.b-contact__form form > div {
    width: 80%;
}
</style>