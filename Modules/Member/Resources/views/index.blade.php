@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.dashboard') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
            {!! __('member::strings.dashboard') !!}
        @endslot
        @slot('title_li')
            {!! __('member::strings.welcome_dashboard') !!}
        @endslot
    @endcomponent





@endsection
