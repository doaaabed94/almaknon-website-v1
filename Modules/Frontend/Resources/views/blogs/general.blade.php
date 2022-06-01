@extends('frontend::layouts.master')
   @section('content')


@component('frontend::inc.banner-title')
         @slot('text1')
            {!! __('frontend::main.blogs') !!}
        @endslot

         @slot('text2')
            {!! __('frontend::main.blogs') !!}
        @endslot
    @endcomponent
<!--b-pageHeader-->
@component('frontend::inc.breadcrumbs')
         @slot('li_1')
            {!! __('frontend::main.blogs') !!}
        @endslot
    @endcomponent
<section class="b-article">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-12">
            </div>
            <div class="col-md-3 col-xs-12">
                @include('frontend::blogs.sidebar')
            </div>
        </div>
    </div>
</section>
<!--b-article-->
@endsection
