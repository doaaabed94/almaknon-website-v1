@extends('member::layouts.master')

@section('title')
{!! __('maknon::main.colors_list') !!}
@endsection

@section('content')

    @component('member::common-components.breadcrumb')
        @slot('title')
        <a href="{{ route('colors.index') }}" > {!! __('maknon::main.colors_list') !!} </a>
        @endslot
        @slot('title_li')
            @if (auth()->user()->isAn('ROOT') or auth()->user()->can('CREATE_color'))
                <a href="{!! route('colors.create') !!}" class="btn btn-warning">
                    {!! __('member::strings.add_new') !!}
                </a>
            @endif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{!! __('maknon::main.colors_list') !!}</h4>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ __('member::strings.datatable.id') }}</th>
                                <th>{{ __('member::strings.datatable.name') }}</th>
                                <th>{{ __('member::strings.datatable.status') }}</th>
                                <th>{{ __('member::strings.datatable.actions') }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            @foreach ($all_data as $data)
                                <tr  @if($data->trashed()) style="background: #ffdbda;" @endif @if($data->isDisabled()) style="background: #ffebe8;" @endif>
                                    <td>{{$data->id}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td><span class="btn btn-bold btn-sm btn-font-sm btn-{{ $data->status  == 'DISABLED' ? 'danger' : 'info' }}">
                                      {{ $data->status ? $data->status : '------' }}</span></td>
                                    <td>
                                      @include('member::common-components.action_datatable', [
                                        'id'                        => $data->id,
                                        'can_read'                  => auth()->user()->isAn('ROOT') OR auth()->user()->can('READ_colorS'),
                                        'can_update'                => auth()->user()->isAn('ROOT') OR auth()->user()->can('UPDATE_colorS'),
                                        'can_postRestore'           => (auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_colorS')) && $data->trashed(),
                                        'can_postDelete'            => (auth()->user()->isAn('ROOT') OR auth()->user()->can('DELETE_colorS')) && !$data->trashed(),
                                        'can_postPermaDelete'       => auth()->user()->isAn('ROOT') OR auth()->user()->can('PERMA_DELETE_colorS'),
                                        'can_disabled'              => (auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_colorS')) && $data->isEnabled(),
                                        'can_enabled'               => (auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_colorS')) && $data->isDisabled(),
                                        
                                        'read_url'                  => route('colors.read', ['model' => $data->id]) ,
                                        'delete_url'                => route('colors.postDelete', ['model' => $data->id]) ,
                                        'restore_url'               => route('colors.postRestore', ['model' => $data->id]) ,
                                        'update_url'                => route('colors.update', ['model' => $data->id]),
                                        'permdelete_url'            => route('colors.postPermaDelete', ['model' => $data->id]),
                                        'status_url'                => route('colors.postStatus', ['model' => $data->id]),
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
    <script src="{{ URL::asset('/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection