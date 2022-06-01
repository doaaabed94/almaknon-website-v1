@extends('member::layouts.master')

@section('title')
{!! __('maknon::main.cars_list') !!}
@endsection

@section('content')

@component('member::common-components.breadcrumb')
@slot('title')
<a href="{{ route('cars.index') }}">
    {!! __('maknon::main.favourite_list') !!}
</a>
@endslot

@endcomponent
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    {!! __('maknon::main.favourite_list') !!} 
                </h4>
                <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable-buttons" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                              <th>
                                {{ __('member::strings.datatable.car') }}
                            </th>
                            <th>
                                {{ __('member::strings.datatable.member') }}
                            </th>
                            <th>
                                {{ __('member::strings.datatable.status') }}
                            </th>
                            <th>
                                {{ __('member::strings.datatable.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_data as $data)
                        <tr  @if($data->trashed()) style="background: #ffdbda;" @endif @if($data->isDisabled()) style="background: #ffebe8;" @endif>
                              <td>
                                {{ $data->Car->translateOrFirst()->name }}
                            </td>
                            @if($data->Member)
                            <td>
                                {{$data->Member->full_name}}
                                <br>
                                    {{$data->Member->email}}
                                </br>
                            </td>
                            @else
                            <td>
                                {{$data->name}}
                            </td>
                            @endif
                            <td>
                                <span class="btn btn-bold btn-sm btn-font-sm btn-{{ $data->status == 'DISABLED' ? 'danger' : 'info' }}">
                                    {{ $data->status ? $data->status : '------' }}
                                </span>
                            </td>
                            <td>
                                @include('member::common-components.action_datatable', [
                                    'id'                        => $data->id,
                                    'can_postRestore'           => (auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_CAR')) && $data->trashed(),
                                    'can_postDelete'            => (auth()->user()->isAn('ROOT') OR auth()->user()->can('DELETE_CAR')) && !$data->trashed(),
                                    'can_postPermaDelete'       => auth()->user()->isAn('ROOT') OR auth()->user()->can('PERMA_DELETE_CAR'),
                                    'can_disabled'              => (auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CAR')) && $data->isEnabled(),
                                    'can_enabled'               => (auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_CAR')) && $data->isDisabled(),

                                    'delete_url'                => route('cars.postDelete', ['model' => $data->id]) ,
                                    'restore_url'               => route('cars.postRestore', ['model' => $data->id]) ,
                                    'permdelete_url'            => route('cars.postPermaDelete', ['model' => $data->id]),
                                    'status_url'                => route('cars.postStatusFavourite', ['model' => $data->id]),
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
<script src="{{ URL::asset('/libs/datatables/datatables.min.js') }}">
</script>
<script src="{{ URL::asset('/libs/jszip/jszip.min.js') }}">
</script>
<script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js') }}">
</script>
<script src="{{ URL::asset('/js/pages/datatables.init.js') }}">
</script>
<script src="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.js') }}">
</script>
@endsection
