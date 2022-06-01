    @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'slug',
                                    'label' => __('maknon::inputs.slug.label'),
                                    'placeholder' => __('maknon::inputs.slug.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('slug',$data->slug),
                                ],
                            ])
                            
                            
                              @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'order',
                                    'label' => __('maknon::inputs.order.label'),
                                    'placeholder' => __('maknon::inputs.order.placeholder'),
                                    'value' => old('order',$data->order),
                                        'container_class' => 'col-lg-6',
                                ],
                            ])

                            @include(
                                'member::common-components.inputs.select',
                                [
                                    'options' => [
                                        'size' => 5,
                                        'view' => 'DEFAULT',
                                        'name' => 'show_in_site',
                                        'label' => __('maknon::inputs.show_in_site.label'),
                                        'nullable' => null,
                                        'nullable_v' => null,
                                        'container_class' => 'col-lg-6',
                                        'options' => [
                                            [
                                                'value' => 'yes',
                                                'text' => __('maknon::main.yes'),
                                            ],
                                            [
                                                'value' => 'no',
                                                'text' => __('maknon::main.no'),
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
                                        'value' => old('show_in_site',$data->show_in_site),
                                    ],
                                ]
                            )
<div class="col-lg-12 mb-5">
    <ul class="nav nav-tabs" role="tablist">
        @foreach ($_ALL_LOCALES_ as $_LOCALE_BASE_CODE => $_LOCALE_DETAILS)
        <li class="nav-item">
            <a class="nav-link {{ $_LOCALE_BASE_CODE == $locale ? 'active' : '' }} lang_tab_{{ $_LOCALE_BASE_CODE }}" data-toggle="tab" href="#kt_tabs_{{ $_LOCALE_BASE_CODE }}">
                <img alt="" src="{{ \Module::asset('member:images/flags/' . $_LOCALE_BASE_CODE . '.jpg') }}" style="width: 20px;">
                    {{ $_LOCALE_DETAILS['native'] }}
                </img>
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
                                                        __('maknon::inputs.description.label') .
                                                        ' <span class="text-danger"> [' .
                                                        $_LOCALE_BASE_CODE .
                                                        '] <span>',
                                                    'placeholder' => __(
                                                        'maknon::inputs.description.placeholder'
                                                    ),
                                                    'help' => __('maknon::inputs.description.help'),
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
</div>
    @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'meta_title',
                                    'label' => __('maknon::inputs.meta_title.label'),
                                    'placeholder' => __('maknon::inputs.meta_title.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('meta_title',$data->meta_title),
                                ],
                            ])
 @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'meta_keyword',
                                    'label' => __('maknon::inputs.meta_keyword.label'),
                                    'placeholder' => __('maknon::inputs.meta_keyword.placeholder'),
                                        'container_class' => 'col-lg-6',
                                    'value' => old('meta_keyword',$data->meta_keyword),
                                ],
                            ])
                       
                            @include('member::common-components.inputs.text', [
                                'options' => [
                                    'view' => 'DEFAULT',
                                    'name' => 'meta_description',
                                    'label' => __('maknon::inputs.meta_description.label'),
                                    'placeholder' => __('maknon::inputs.meta_description.placeholder'),
                                        'container_class' => 'col-lg-12',
                                    'value' => old('meta_description',$data->meta_description),
                                ],
                            ])
