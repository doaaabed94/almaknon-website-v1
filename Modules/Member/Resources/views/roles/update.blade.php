@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.roles') !!} - {!! __('member::strings.update_role') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
           <a href="{!! route('member::roles.index') !!}">
            {!! __('member::strings.roles') !!}
            </a>
        @endslot
        @slot('li_1')
            {!! __('member::strings.update_role') !!}
        @endslot
    @endcomponent

   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3 mt-2">{!! __('member::strings.update_role') !!}</h4>
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="{!! route('member::roles.postUpdate', ['model' => $model->id]) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="model" value="{{ $model->id }}">
                        <div id="show_inline_general_error"></div>
                    
                                @include('member::common-components.inputs.text', [
                                    'options' => [
                                        'name'        => 'name',
                                        'label'       => __('member::inputs.code.label'),
                                        'placeholder' => __('member::inputs.code.placeholder'),
                                        'help'        => __('member::inputs.code.help'),
                                        'value'       => old('name', $model->name),
                                        'disabled'    => true,
                                    ]
                                ])
                              

                                       <div class="col-lg-12">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
                            <li class="nav-item">
                                <a class="nav-link {{ $_LOCALE_BASE_CODE == $locale ? 'active' : '' }} lang_tab_{{ $_LOCALE_BASE_CODE }}" data-toggle="tab" href="#kt_tabs_{{ $_LOCALE_BASE_CODE }}">
                                    <img src="{{ \Module::asset('public/member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg') }}" alt="" style="width: 20px;">
                                    {{ $_LOCALE_DETAILS['native'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
                            <div class="tab-pane {{ $_LOCALE_BASE_CODE == $locale ? 'active' : '' }}" id="kt_tabs_{{ $_LOCALE_BASE_CODE }}" role="tabpanel">
                                  <div class="col-md-6  mt-3">
                                    @include('member::common-components.inputs.text', [
                                    'options' => [
                                    'name'        => 'title[' . $_LOCALE_BASE_CODE . ']',
                                    'view' => 'INLINE',
                                    'label' => __('member::inputs.title.label') . ' <span class="text-danger"> [' . $_LOCALE_BASE_CODE . '] <span>',
                                        'placeholder' => __('member::inputs.title.placeholder'),
                                        'help'        => __('member::inputs.title.help'),
                                        'value'       => old('title[' . $_LOCALE_BASE_CODE . ']', $model->__strict('title', $_LOCALE_BASE_CODE)),
                                        'attr' => 'data-on-validation-error-click=".lang_tab_'. $_LOCALE_BASE_CODE .'"'
                                        ]
                                        ])
                                    </div>
                                    <div class="col-md-6">
                                        @include('member::common-components.inputs.textarea', [
                                        'options' => [
                                        'name'        => 'description[' . $_LOCALE_BASE_CODE . ']',
                                        'view' => 'INLINE',
                                        'label'       => __('member::inputs.description.label'). ' <span class="text-danger"> [' . $_LOCALE_BASE_CODE . '] <span>',
                                        'placeholder' => __('member::inputs.description.placeholder'),
                                        'help'        => __('member::inputs.description.help'),
                                        'value'       => old('description[' . $_LOCALE_BASE_CODE . ']', $model->__strict('description', $_LOCALE_BASE_CODE))
                                        ]
                                        ])
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>



                           @foreach($AbilitiesGroups as $key => $Group)
                             @php
                                                $disabledClass = ($model->updatable == 1) ? '' : ( auth()->user()->isAn('ROOT') ? '' : 'disabled=""' );
                                            @endphp
            <table class="table table-bordered">
                <thead>
                    <tr class="bs-inverse">
                        <th colspan="2">
                            {!! $Group->SmartTranslation()->title !!} <br>
                            <small class="text-muted">{!! $Group->SmartTranslation()->description !!}</small>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Group->Abilities as $key => $Ability)
                    <tr>
                        <td width="15%">
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="customSwitch{{ $Ability->id }}" name="abilities[]" value="{{ $Ability->id }}" 
@if(in_array($Ability->id, $modelAbilities)) checked="" @endif {!! $disabledClass !!}>
                                <label class="custom-control-label" for="customSwitch{{ $Ability->id }}"></label>
                            </div>
                        </td>
                        <td>
                         {!! $Ability->SmartTranslation()->title !!}
                         <br>
                         <small class="text-muted">{!! $Ability->SmartTranslation()->description !!}</small>
                     </td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
         @endforeach

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

