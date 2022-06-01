@extends('member::layouts.master')

@section('title')
{!! __('maknon::main.cars_list') !!} - {!! __('member::strings.add_new') !!}
@endsection

@section('content')
@component('member::common-components.breadcrumb')
@slot('title')
<a href="{{ route('cars.index') }}">
    {!! __('maknon::main.cars_list') !!}
</a>
@endslot
@slot('li_1')
{!! __('member::strings.add_new') !!}
@endslot
@endcomponent
<form action="#" class="crud-ajax-form needs-validation action-ajax-form" method="POST">
    {!! csrf_field() !!}
    <div id="show_inline_general_error">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#data_base" role="tab">
                                <span class="d-block d-sm-none">
                                    <i class="fas fa-home">
                                    </i>
                                </span>
                                <span class="d-none d-sm-block">
                                    {{ __('maknon::main.base_information') }}
                                </span>
                            </a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#details" role="tab">
                                <span class="d-block d-sm-none">
                                    <i class="far fa-envelope">
                                    </i>
                                </span>
                                <span class="d-none d-sm-block">
                                    {{ __('maknon::main.details_information') }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#files" role="tab">
                                <span class="d-block d-sm-none">
                                    <i class="far fa-envelope">
                                    </i>
                                </span>
                                <span class="d-none d-sm-block">
                                    {{ __('maknon::main.media') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="data_base" role="tabpanel">
                            <div class="timeline-count mt-5">
                                <div class="row">
                                    @include('maknon::cars.inc.create.main')
                                </div>
                            </div>
                        </div>
                         <div class="tab-pane " id="details" role="tabpanel">
                            <div class="timeline-count mt-5">
                                <div class="row">
                                    @include('maknon::cars.inc.create.details')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="files" role="tabpanel">
                            <div class="timeline-count mt-5">
                                <div class="row">
                                    @include('maknon::cars.inc.create.media')
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-6 col-xl-6 m-auto d-flex mt-5">
                        <a class="btn btn-success btn-back mr-2 ml-2 mt-5 w-50" href="{{ route('cars.index') }}">
                            {!! __('member::strings.back') !!}
                        </a>
                        <button class="btn btn-primary btn-block btn-m mr-2 ml-2 mt-5 w-50" id="saveBtn" type="submit">
                            {!! __('member::strings.save') !!}
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</form>

@endsection
