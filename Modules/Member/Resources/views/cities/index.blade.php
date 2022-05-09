@extends('member::layouts.master')

@section('title')
{!! __('member::strings.users') !!}
@endsection

@section('content')

    @component('member::common-components.breadcrumb')
        @slot('title')
            {!! __('member::strings.users') !!}
        @endslot
        @slot('title_li')
            @if (auth()->user()->isAn('ROOT') or auth()->user()->can('CREATE_USERS'))
                <a href="{!! route('member::users.create') !!}" class="btn btn-warning">
                    {!! __('member::strings.add_new') !!}
                </a>
            @endif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{!! __('member::strings.users') !!}</h4>
                    <p class="card-title-desc">{!! __('member::strings.users') !!}</p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ __('member::strings.datatable.user') }}</th>
                                <th>{{ __('member::strings.datatable.email') }}</th>
                                <th>{{ __('member::strings.datatable.type') }}</th>
                                <th>{{ __('member::strings.datatable.status') }}</th>
                                <th>{{ __('member::strings.datatable.actions') }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($Users as $data)
                                <tr>
                                    <td>{{$data->first_name}} {{$data->last_name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->type}}</td>
                                    <td><span class="btn btn-bold btn-sm btn-font-sm btn-{{ $data->status  == 'DISABLED' ? 'danger' : 'info' }}">
                                      {{ $data->status ? $data->status : '------' }}</span></td>
                                    <td>
                                      @include('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_read' => auth()->user()->can('READ_USERS'),
                                        'can_update' => auth()->user()->can('UPDATE_USERS') && $data->type != 'ROOT',
                                        'can_postRestore' => auth()->user()->can('RESTORE_USERS') && $data->trashed(),
                                        'can_postDelete' => auth()->user()->can('DELETE_USERS') && ! $data->trashed() && $data->type != 'ROOT' ,
                                        'can_postPermaDelete' => auth()->user()->can('PERMA_DELETE_USERS')  && $data->type != 'ROOT' ,
                                        'can_disabled' => auth()->user()->can('STATUS_UPDATE_USERS') && $data->isEnabled() && $data->type != 'ROOT',
                                        'can_enabled' => auth()->user()->can('STATUS_UPDATE_USERS') && $data->isDisabled() && $data->type != 'ROOT',
                                        'can_loginAs' => auth()->user()->can('LOGIN_AS_USERS') && $data->type != 'ROOT',
                                        
                                        'login_as_url' => route('member::users.loginAs', ['model' => $data->id]),
                                        'delete_url' => route('member::users.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::users.postRestore', ['model' => $data->id]) ,
                                        'update_url' => route('member::users.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::users.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::users.postStatus', ['model' => $data->id]),
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
