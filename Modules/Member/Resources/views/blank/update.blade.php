@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.blank') !!} - {!! __('member::strings.update') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
           <a href="{!! route('member::blank.index') !!}">
            {!! __('member::strings.blank') !!}
            </a>
        @endslot
        @slot('li_1')
            {!! __('member::strings.update') !!}
        @endslot
    @endcomponent

   <div class="row">
        <div class="col-12">
            <div class="card">
                    <h4 class="card-title">{!! __('member::strings.update') !!}</h4>
                
                <div class="card-body">
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="{!! route('member::blank.postUpdate', ['model' => $model->id]) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="model" value="{{ $model->id }}">
                        <div id="show_inline_general_error"></div>
                    
                    
                             <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="updateBtn" type="submit">
                                    {!! __('member::strings.save') !!}
                                </button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('script')
   
@endsection

