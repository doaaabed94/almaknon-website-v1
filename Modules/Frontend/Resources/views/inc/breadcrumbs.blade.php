<div class="b-breadCumbs s-shadow">
    <div class="container wow zoomInUp" data-wow-delay="0.7s">
        <a class="b-breadCumbs__page" href="{{ route('index') }}">
            {{ __('frontend::main.home')}}
        </a>
        @if(isset($title_li))

        @if(isset($li_1))
        <span class="fa fa-angle-right">
        </span>
        <a class="b-breadCumbs__page" href=" {{ $li_1_link }}">
            {{ $li_1 }}
        </a>
        @endif
        <span class="fa fa-angle-right">
        </span>
        <a class="b-breadCumbs__page m-active" href="#">
            {{$title_li}}
        </a>


        @else
        @if(isset($li_1))
        <span class="fa fa-angle-right">
        </span>
        <a class="b-breadCumbs__page m-active" href="#">
            {{ $li_1 }}
        </a>
        @endif

        @endif
    </div>
</div>
