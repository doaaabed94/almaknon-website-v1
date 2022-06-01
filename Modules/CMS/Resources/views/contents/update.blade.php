@extends('member::layouts.master')

@section('title')
    {!! __('cms::strings.contents_list') !!} - {!! __('member::strings.add_new') !!}
@endsection

@section('content')
    @component('member::common-components.breadcrumb')
        @slot('title')
        <a href="{{ route('cms::contents.index') }}" > {!! __('cms::strings.contents_list') !!} </a>
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
                        <input type="hidden" name="model" value="{{ $data->id }}">

                        @if(isset($data->category) && $data->category->code !== 'PAGES')
                           @include(
                            'member::common-components.inputs.select',
                            [
                                'options' => [
                                    'size' => 5,
                                    'view' => 'INLINE',
                                    'name' => 'category_id',
                                    'searchable' => true,
                                    'label' => __('cms::inputs.categories.label'),
                                    'nullable' =>__('cms::inputs.categories.placeholder'),
                                    'nullable_v' => null,
                                     'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                    'options' => $categories,
                                    'option_attr' => function($K, $V){
                                        return 'data-dial="'. $V->id .'"';
                                    },
                                    'text' => function($K, $V){
                                        return $V->__('name', app()->getLocale());
                                    },
                                    'values' => function($K, $V){
                                        return $V->id;
                                    },
                                    'select' => function($K, $V, $value){
                                        return $V->id == $value;
                                    },
                                    'value' => old('categories' , $data->category_id  )
                                ],
                            ]
                            )
                        @include(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'slug',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.slug.label') ,
                                    'placeholder' =>__('cms::inputs.slug.placeholder'),
                                    'help' => ' ',
                                    'value' => old('slug', $data->slug  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            )
                       
                        @include(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'views',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.views.label') ,
                                    'placeholder' =>__('cms::inputs.views.placeholder'),
                                    'help' => ' ',
                                    'value' => old('views', $data->views  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            )
                        @include(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'order',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.order.label') ,
                                    'placeholder' =>__('cms::inputs.order.placeholder'),
                                    'help' => ' ',
                                    'value' => old('order', $data->order  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            )
                        @include(
                            'member::common-components.inputs.text',
                            [
                                'options' => [
                                    'name' => 'link',
                                    'view' => 'INLINE',
                                    'label' => __('cms::inputs.link.label') ,
                                    'placeholder' =>__('cms::inputs.link.placeholder'),
                                    'help' => ' ',
                                    'value' => old('link', $data->link  ),
                                    'label_size' => 'col-lg-2',
                                    'input_size' => 'col-lg-10',
                                ],
                            ]
                            )
                        @endif
                              @include('member::common-components.inputs.dropzone', [
                                'options' => [
                                    'id' => 'main_contant_img',
                                    'name' => 'main_contant_img',
                                    'label' => __('cms::strings.main_contant_img'),
                                     'attachments'       => $data->attachments->where('input_name', 'main_contant_img')->map(function($item) {
                                                            $item->thumbnail = $item->getThumbnail('120x120');
                                                            return $item;
                                                        }),
                                    'required' => false,
                                    'inline' => false,
                                    'validation_rules' => 'mimes:jpeg,jpg,png',
                                    'container_class' => 'col-md-6',
                                    'sub_folder' => 'main_contant_img',
                                    'max_files' =>  1,
                                ],
                            ])

                       
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
                                                            __('member::inputs.title.label') .
                                                            ' <span class="text-danger"> [' .
                                                            $_LOCALE_BASE_CODE .
                                                            '] <span>',
                                                        'placeholder' => __(
                                                            'member::inputs.title.placeholder'
                                                        ),
                                                        'help' => __('member::inputs.title.help'),
                                                        'value' => old('name[' . $_LOCALE_BASE_CODE . ']',$data->__strict('name', $_LOCALE_BASE_CODE)),
                                                        'attr' => 'data-on-validation-error-click=".lang_tab_'.$_LOCALE_BASE_CODE .'"',
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
                                                        __('member::inputs.description.label') .
                                                        ' <span class="text-danger"> [' .
                                                        $_LOCALE_BASE_CODE .
                                                        '] <span>',
                                                    'placeholder' => __(
                                                        'member::inputs.description.placeholder'
                                                    ),
                                                    'help' => __('member::inputs.description.help'),
                                                    'value' => $data->__strict('description', $_LOCALE_BASE_CODE),
                                                    'rows' => 20,
                                                    'label_size' => 'col-lg-2',
                                                    'input_size' => 'col-lg-10',
                                                ],
                                            ]
                                        )
                                    </div>
                                @endforeach
                            </div>

                                 @include('member::common-components.inputs.dropzone', [
                                'options' => [
                                    'id' => 'contant_img',
                                    'name' => 'contant_img',
                                    'label' => __('cms::strings.contant_img'),
                                     'attachments'       => $data->attachments->where('input_name', 'contant_img')->map(function($item) {
                                                            $item->thumbnail = $item->getThumbnail('120x120');
                                                            return $item;
                                                        }),
                                    'required' => false,
                                    'inline' => false,
                                    'validation_rules' => 'mimes:jpeg,jpg,png',
                                    'container_class' => 'col-md-12',
                                    'sub_folder' => 'contant_img',
                                ],
                            ])
                @include(
                    'member::common-components.inputs.select',
                    [
                        'options' => [
                            'size' => 5,
                            'view' => 'INLINE',
                            'name' => 'show_in_site',
                            'label' => __('cms::inputs.show_in_site.label') ,
                            'placeholder' =>__('cms::inputs.show_in_site.placeholder'),
                            'help' => ' ',
                            'nullable' => null,
                            'nullable_v' => null,
                            'label_size' => 'col-lg-2',
                            'input_size' => 'col-lg-10',
                            'options' => [
                                [
                                    'value' => 'yes',
                                    'text' => __('cms::strings.yes'),
                                ],
                                [
                                    'value' => 'no',
                                    'text' => __('cms::strings.no'),
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
                            'value' => old('show_in_site', $data->show_in_site  ),
                        ],
                    ]
                    )

                @include('member::common-components.inputs.text', [
                    'options' => [
                        'view' => 'INLINE',
                        'name' => 'meta_title',
                        'label' => __('cms::inputs.meta_title.label'),
                        'placeholder' => __('cms::inputs.meta_title.placeholder'),
                        'label_size' => 'col-lg-2',
                        'input_size' => 'col-lg-10',
                        'value' => old('meta_title', $data->meta_title  ),
                    ],
                    ])

                @include('member::common-components.inputs.text', [
                    'options' => [
                        'view' => 'INLINE',
                        'name' => 'meta_description',
                        'label' => __('cms::inputs.meta_description.label'),
                        'placeholder' => __('cms::inputs.meta_description.placeholder'),
                        'label_size' => 'col-lg-2',
                        'input_size' => 'col-lg-10',
                        'value' => old('meta_description', $data->meta_description  ),
                    ],
                    ])

                @include('member::common-components.inputs.text', [
                    'options' => [
                        'view' => 'INLINE',
                        'name' => 'meta_keyword',
                        'label' => __('cms::inputs.meta_keyword.label'),
                        'placeholder' => __('cms::inputs.meta_keyword.placeholder'),
                        'label_size' => 'col-lg-2',
                        'input_size' => 'col-lg-10',
                        'value' => old('meta_keyword', $data->meta_keyword  ),
                    ],
                    ])

                    @if ($CurrentUser->can('STATUS_UPDATE_CONENT') or $CurrentUser->isAn('ROOT'))
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
                                'value' => old('status', $data->status  ),
                            ],
                        ]
                        )
                        @endif

                        </div>

                        <div class="col-lg-2 col-xl-2 m-auto d-flex mt-5">
                            
                            <a href="{{ route('cms::contents.index') }}" class="btn btn-success btn-back mr-2 ml-2 mt-5 w-50">
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
