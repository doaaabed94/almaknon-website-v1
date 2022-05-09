@extends('member::layouts.master')

@section('title')
    {!! __('maknon::main.fuels_list') !!} - {!! __('member::strings.read') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
        <a href="{{ route('fuels.index') }}" >  {!! __('maknon::main.fuels_list') !!} </a>
        @endslot
        @slot('li_1')
            {!! __('member::strings.read') !!}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{!! __('member::strings.read') !!}</h4>
                    <h2>{{$model->translateorfirst()->name}}</h2>
                    <p> {!! $model->translateorfirst()->description !!} </p>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
