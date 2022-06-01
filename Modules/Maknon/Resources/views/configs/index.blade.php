@extends('member::layouts.master')

@section('title')
{!! __('maknon::main.configs_list') !!}
@endsection

@section('content')

    @component('member::common-components.breadcrumb')
        @slot('title')
        <a href="{{ route('configs.index') }}" > {!! __('maknon::main.configs_list') !!} </a>
        @endslot
        @slot('title_li')
            @if (auth()->user()->isAn('ROOT') or auth()->user()->can('CREATE_CONFIG'))
                <a href="{!! route('configs.create') !!}" class="btn btn-warning">
                    {!! __('member::strings.add_new') !!}
                </a>
            @endif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{!! __('maknon::main.configs_list') !!}</h4>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ __('member::strings.datatable.code') }}</th>
                                <th>{{ __('member::strings.datatable.name') }}</th>
                                <th>{{ __('member::strings.datatable.value') }}</th>
                                <th>{{ __('member::strings.datatable.actions') }}&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            @foreach ($all_data as $data)
                                <tr  @if($data->trashed()) style="background: #ffdbda;" @endif @if($data->isDisabled()) style="background: #ffebe8;" @endif>
                                    <td  style="color: red">{{$data->code}}</td>
                                    <td style="color: #000">{{ $data->name }}</td>
                                    <td  style="color: #000">{{ $data->value }}</td>
                                    <td>  <button type="button" class="btn btn-primary btn-sm open-editConfig" 
                                        data-name="{{$data->name }}" 
                                        data-code="{{$data->code }}" 
                                        data-id="{{$data->id }}" 
                                        data-value="{{$data->value }}" 
                                        data-toggle="modal" data-target="#myModal">{{ __('member::strings.update')  }}</button></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

                            <!-- sample modal content -->
                        <div id="myModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myModalLabel">Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                      <form class="crud-ajax-form needs-validation action-ajax-form" action="#" method="POST">
                                        {!! csrf_field() !!}
                                        <div id="show_inline_general_error"></div>
                                    <div class="modal-body">
                                        <input type="hidden" name="model" id="ConfigId" value="">
                                      <div class="d-block">  
                                        <span class="font-size-16 " > TITLE :</span><span class="font-size-16" id="ConfigTitle" style="color: red;"></span> <br>
                                         <span class="font-size-16"> CODE: </span><span class="font-size-16" id="ConfigCode" style="color: red;"> </span> </div>
                                        <input type="text" class="form-control" name="value" id="ConfigValue" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                        <button id="saveBtn" type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
  
@endsection


@section('script')
    <script src="{{ URL::asset('/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>


  <script type="text/javascript">
      
 $(document).on("click", ".open-editConfig", function () {
     var ConfigId = $(this).data('id');
     var ConfigValue = $(this).data('value');
     var ConfigTitle = $(this).data('name');
     var ConfigCode = $(this).data('code');

     $(".modal-body #ConfigValue").val( ConfigValue );
     $(".modal-body #ConfigId").val( ConfigId );
     $(".modal-body #ConfigTitle").html( ConfigTitle );
     $(".modal-body #ConfigCode").html( ConfigCode );


});
  </script>
@endsection

