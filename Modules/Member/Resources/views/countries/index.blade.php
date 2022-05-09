@extends('member::layouts.master')

@section('title')
{!! __('member::strings.countries') !!}
@endsection

@section('content')

    @component('member::common-components.breadcrumb')
        @slot('title')
            {!! __('member::strings.countries') !!}
        @endslot
        @slot('title_li')
            @if (auth()->user()->isAn('ROOT') or auth()->user()->can('CREATE_COUNTRIES'))
                <a href="{!! route('member::countries.create') !!}" class="btn btn-warning">
                    {!! __('member::strings.add_new') !!}
                </a>
            @endif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{!! __('member::strings.countries') !!}</h4>
                    <p class="card-title-desc">{!! __('member::strings.countries') !!}</p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ __('member::strings.datatable.name') }}</th>
                                <th>{{ __('member::strings.datatable.status') }}</th>
                                <th>{{ __('member::strings.datatable.actions') }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($rows as $data)
                                <tr>
                                    <td>{{$data->name}} {{$data->name}}</td>
                                    <td><span class="btn btn-bold btn-sm btn-font-sm btn-{{ $data->status  == 'DISABLED' ? 'danger' : 'info' }}">
                                      {{ $data->status ? $data->status : '------' }}</span></td>
                                    <td>
                                      @include('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_read' => auth()->user()->can('READ_COUNTRIES'),
                                        'can_update' => auth()->user()->can('UPDATE_COUNTRIES'),
                                        'can_postRestore' => auth()->user()->can('RESTORE_COUNTRIES') && $data->trashed(),
                                        'can_postDelete' => auth()->user()->can('DELETE_COUNTRIES') && ! $data->trashed() ,
                                        'can_postPermaDelete' => auth()->user()->can('PERMA_DELETE_COUNTRIES')  ,
                                        'can_disabled' => auth()->user()->can('STATUS_UPDATE_COUNTRIES') && $data->isEnabled(),
                                        'can_enabled' => auth()->user()->can('STATUS_UPDATE_COUNTRIES') && $data->isDisabled(),
                                        
                                        'delete_url' => route('member::countries.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::countries.postRestore', ['model' => $data->id]) ,
                                        'update_url' => route('member::countries.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::countries.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::countries.postStatus', ['model' => $data->id]),
                                        ])
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


@endsection


@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        @endsection
