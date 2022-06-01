<section class="b-pageHeader">
    <div class="container">
        @if(isset($text1))
        <h1 class="wow zoomInLeft" data-wow-delay="0.7s">
            {{ $text1 }}
        </h1>
        @endif

        @if(isset($text2))
        <div class="b-pageHeader__search wow zoomInRight" data-wow-delay="0.7s">
            <h3>
                {{ $text2 }}
            </h3>
        </div>
        @endif
    </div>
</section>