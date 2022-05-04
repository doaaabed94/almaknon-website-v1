@extends('member::layouts.master')

@section('title')
{!! __('member::strings.roles') !!}
@endsection

@section('content')

    @component('member::common-components.breadcrumb')
        @slot('title')
            <a href="{!! route('member::roles.index') !!}" class="btn btn-warning">
             {!! __('member::strings.roles') !!}
         </a>
        @endslot
        @slot('title_li')
        <a href="{!! route('member::roles.create') !!}" class="btn btn-warning">
                    {!! __('member::strings.add_new') !!}
                </a>
            @if (auth()->user()->isAn('ROOT'))
                <a href="{!! route('member::roles.create') !!}" class="btn btn-warning">
                    {!! __('member::strings.add_new') !!}
                </a>
            @endif
        @endslot
    @endcomponent

    <div class="data">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{!! __('member::strings.roles') !!}</h4>

                    <table class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ __('member::strings.datatable.id') }}</th>
                                <th>{{ __('member::strings.datatable.name') }}</th>
                                <th>{{ __('member::strings.datatable.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Roles as $data)
                                <tr @if($data->trashed()) style="background: #ffdbda;" @endif>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>
                                         @include('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_update' =>auth()->user()->can('UPDATE_ROLES'),
                                        'can_postRestore' =>auth()->user()->isAn('ROOT'),
                                        'can_postDelete' => auth()->user()->isAn('ROOT'),
                                        'can_postPermaDelete' => auth()->user()->isAn('ROOT') ,

                                        'delete_url' => route('member::roles.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::roles.postRestore', ['model' => $data->id]),
                                        'update_url' => route('member::roles.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::roles.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::roles.postStatus', ['model' => $data->id]),
                                        ])

                                    <!--  @include('member::common-components.action_datatable', [
                                        'id' => $data->id,
                                        'can_update' => auth()->user()->can('UPDATE_ROLES')  && $data->type == 'ROOT' ,
                                        'can_postRestore' => auth()->user()->can('RESTORE_ROLES') && $data->trashed()  && $data->type == 'ROOT',
                                        'can_postDelete' => auth()->user()->can('DELETE_ROLES') && ! $data->trashed() && $data->type == 'ROOT' ,
                                        'can_postPermaDelete' => auth()->user()->can('PERMA_DELETE_ROLES')  && $data->type == 'ROOT' ,

                                        'delete_url' => route('member::roles.postDelete', ['model' => $data->id]) ,
                                        'restore_url' => route('member::roles.postRestore', ['model' => $data->id]),
                                        'update_url' => route('member::roles.update', ['model' => $data->id]),
                                        'permdelete_url' => route('member::roles.postPermaDelete', ['model' => $data->id]),
                                        'status_url' => route('member::roles.postStatus', ['model' => $data->id]),
                                        ]) -->

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
    <!-- end data -->


@endsection


@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('public/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('public/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('public/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('public/js/pages/datatables.init.js') }}"></script>

@endsection
