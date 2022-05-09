@extends('member::layouts.master')

@section('title')
    {!! __('member::strings.countries') !!} - {!! __('member::strings.add_new') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
            <a href="{!! route('member::countries.index') !!}">
              {!! __('member::strings.countries') !!}
          </a>
        @endslot
        @slot('li_1')
            {!! __('member::strings.add_new') !!}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                    <h4 class="card-title">{!! __('member::strings.add_new') !!}</h4>
                
                <div class="card-body">
                    <form  class="crud-ajax-form needs-validation action-ajax-form" action="{!! route('member::countries.postCreate') !!}" method="POST">
                        {!! csrf_field() !!}
                        <div id="show_inline_general_error"></div>

      @if(auth()->user()->isAn('ROOT'))
                            @include('member::common-components.inputs.select', [
                                'options' => [
                                    'name'        => 'deleteable',
                                    'label'       => __('member::inputs.deleteable.label'),
                                    'help'        => null,
                                    'options'     => __('member::inputs.deleteable.options'),
                                    'text'        => function($K, $V){
                                        return $V;
                                    },
                                    'values'      => function($K, $V){
                                        return $K;
                                    },
                                    'select'      => function($K, $V, $value){
                                        return $K == $value;
                                    },
                                    'value'       => old('deleteable', 'Y')
                                ]
                            ])
                        @endif
                        @include('member::common-components.inputs.select', [
                            'options' => [
                                'name'        => 'locale',
                                'label'       => __('member::inputs.locale.label'),
                                'help'        => __('member::inputs.locale.help'),
                                'options'     => $_ALL_LOCALES_,
                                'text'        => function($K, $V){
                                    return $V['native'];
                                },
                                'values'      => function($K, $V){
                                    return $K;
                                },
                                'select'      => function($K, $V, $value){
                                    return $K == $value;
                                },
                                'value'       => old('locale', app()->getLocale())
                            ]
                        ])
                        @include('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'dial_code',
                                'label'       => __('member::inputs.dial_code.label'),
                                'placeholder' => __('member::inputs.dial_code.placeholder'),
                                'help'        => null,
                                'value'       => old('dial_code')
                            ]
                        ])
                        @include('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'iso_2',
                                'label'       => __('member::inputs.country_iso_2.label'),
                                'placeholder' => __('member::inputs.country_iso_2.placeholder'),
                                'help'        => null,
                                'value'       => old('iso_2')
                            ]
                        ])
                        @include('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'iso_3',
                                'label'       => __('member::inputs.country_iso_3.label'),
                                'placeholder' => __('member::inputs.country_iso_3.placeholder'),
                                'help'        => null,
                                'value'       => old('iso_3')
                            ]
                        ])
                        @include('member::common-components.inputs.text', [
                            'options' => [
                                'name'        => 'name',
                                'label'       => __('member::inputs.name.label'),
                                'placeholder' => __('member::inputs.name.placeholder'),
                                'help'        => null,
                                'value'       => old('name')
                            ]
                        ])
                        <div class="row">
                            <div class="col-sm-6">
                                @include('member::common-components.inputs.text', [
                                    'options' => [
                                        'name'        => 'lat',
                                        'label'       => __('member::inputs.lat.label'),
                                        'placeholder' => __('member::inputs.lat.placeholder'),
                                        'help'        => null,
                                        'value'       => old('lat')
                                    ]
                                ])
                            </div>
                            <div class="col-sm-6">
                                @include('member::common-components.inputs.text', [
                                    'options' => [
                                        'name'        => 'lng',
                                        'label'       => __('member::inputs.lng.label'),
                                        'placeholder' => __('member::inputs.lng.placeholder'),
                                        'help'        => null,
                                        'value'       => old('lng')
                                    ]
                                ])
                            </div>

                                
                              <div class="col-lg-2 col-xl-2 m-auto">
                                <button class="btn btn-primary btn-block waves-effect waves-light" id="saveBtn" type="submit">
                                    {!! __('member::strings.save') !!}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection


@section('script')
 
@endsection
