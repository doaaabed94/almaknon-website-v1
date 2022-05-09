@extends('member::layouts.master')

@section('title')
    {!! __('maknon::main.colors_list') !!} - {!! __('member::strings.add_new') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
        <a href="{{ route('colors.index') }}" > {!! __('maknon::main.colors_list') !!} </a>
        @endslot
        @slot('li_1')
            {!! __('member::strings.add_new') !!}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{!! __('member::strings.add_new') !!}</h4>
                    <form class="crud-ajax-form needs-validation action-ajax-form" action="#" method="POST">
                        {!! csrf_field() !!}
                        <div id="show_inline_general_error"></div>

                        <div class="col-lg-8 mb-5">
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach ($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $_LOCALE_BASE_CODE == $locale ? 'active' : '' }} lang_tab_{{ $_LOCALE_BASE_CODE }}"
                                            data-toggle="tab" href="#kt_tabs_{{ $_LOCALE_BASE_CODE }}">
                                            <img src="{{ \Module::asset('member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg') }}"
                                                alt="" style="width: 20px;">
                                            {{ $_LOCALE_DETAILS['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
                                    <div class="tab-pane {{ $_LOCALE_BASE_CODE == $locale ? 'active' : '' }}"
                                        id="kt_tabs_{{ $_LOCALE_BASE_CODE }}" role="tabpanel">
                                        <div class="mt-3">
                                            @include(
                                                'member::common-components.inputs.text',
                                                [
                                                    'options' => [
                                                        'name' => 'name[' . $_LOCALE_BASE_CODE . ']',
                                                        'view' => 'INLINE',
                                                        'label' =>
                                                            __('maknon::inputs.title.label') .
                                                            ' <span class="text-danger"> [' .
                                                            $_LOCALE_BASE_CODE .
                                                            '] <span>',
                                                        'placeholder' => __(
                                                            'maknon::inputs.title.placeholder'
                                                        ),
                                                        'help' => __('maknon::inputs.title.help'),
                                                        'value' => old(
                                                            'title[' . $_LOCALE_BASE_CODE . ']'
                                                        ),
                                                        'attr' =>
                                                            'data-on-validation-error-click=".lang_tab_' .
                                                            $_LOCALE_BASE_CODE .
                                                            '"',
                                                        'label_size' => 'col-lg-2',
                                                        'input_size' => 'col-lg-10',
                                                    ],
                                                ]
                                            )
                                        </div>

                                        @include(
                                            'member::common-components.inputs.tinymce',
                                            [
                                                'options' => [
                                                    'name' =>
                                                        'description[' . $_LOCALE_BASE_CODE . ']',
                                                    'view' => 'INLINE',
                                                    'label' =>
                                                        __('maknon::inputs.description.label') .
                                                        ' <span class="text-danger"> [' .
                                                        $_LOCALE_BASE_CODE .
                                                        '] <span>',
                                                    'placeholder' => __(
                                                        'maknon::inputs.description.placeholder'
                                                    ),
                                                    'help' => __('maknon::inputs.description.help'),
                                                    'value' => old(
                                                        'description[' . $_LOCALE_BASE_CODE . ']'
                                                    ),
                                                    'rows' => 20,
                                                    'label_size' => 'col-lg-2',
                                                    'input_size' => 'col-lg-10',
                                                ],
                                            ]
                                        )
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if ($CurrentUser->can('STATUS_UPDATE_color') or $CurrentUser->isAn('ROOT'))
                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'INLINE',
                                        'name' => 'status',
                                        'label' => __('member::inputs.status.label'),
                                        'nullable' => null,
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-8',
                                        'label_size' => 'col-lg-2',
                                        'input_size' => 'col-lg-10',
                                        'options' => [
                                            [
                                                'value' => 'ACTIVE',
                                                'text' => __('member::strings.active'),
                                            ],
                                            [
                                                'value' => 'DISABLED',
                                                'text' => __('member::strings.disabled'),
                                            ],
                                        ],
                                        'text' => function ($K, $V) {
                                            return $V['text'];
                                        },
                                        'values' => function ($K, $V) {
                                            return $V['value'];
                                        },
                                        'select' => function ($K, $V, $value) {
                                            return $V['value'] == $value;
                                        },
                                        'value' => old('status', 'ACTIVE'),
                                    ],
                                ]
                            )
                        @endif

                        <div class="col-lg-2 col-xl-2 m-auto d-flex mt-5">
                            
                            <a href="{{ route('colors.index') }}" class="btn btn-success btn-back mr-2 ml-2 mt-5 w-50">
                                {!! __('member::strings.back') !!}
                            </a>

                            <button class="btn btn-primary btn-block btn-m mr-2 ml-2 mt-5 w-50" id="saveBtn" type="submit">
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
