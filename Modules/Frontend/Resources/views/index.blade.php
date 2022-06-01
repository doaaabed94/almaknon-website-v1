   @extends('frontend::layouts.master')
   @section('content')

        @include('frontend::index.slider')
        @include('frontend::index.filter')
        @include('frontend::index.last_cars')

        @include('frontend::inc.brief_about')
 

       @include('frontend::index.lists')
   {{--     @include('frontend::inc.newslatter') --}}

        @include('frontend::index.last_blogs')

@endsection