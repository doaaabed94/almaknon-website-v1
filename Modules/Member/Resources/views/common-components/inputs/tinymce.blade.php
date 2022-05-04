@if(isset($options))
    @php
        $_X = array_merge([
            'rows'        => 3,
            'id'          => null,
            'selector'    => 'tinymce',
            'name'        => null,
            'label'       => null,
            'placeholder' => null,
            'help'        => null,
            'class'       => null,
            'attr'        => null,
            'value'       => null,
            'view'        => 'DEFAULT', //INLINE | DEFAULT
            'label_size'  => 'col-lg-3',
            'input_size'  => 'col-lg-8',
            'disabled'    => false,
            'readonly'    => false,
            'errors'      => $errors,
            'showErrors'  => true,
        ], $options);
    @endphp
    @if($_X['view'] == 'INLINE')
        <div class="form-group row">
            <label class="{!! $_X['label_size'] !!} col-form-label">{!! $_X['label'] !!}</label>
            <div class="{!! $_X['input_size'] !!}">
                <textarea class="form-control {!! $_X['errors']->has($_X['name']) ? 'is-invalid' : '' !!} {!! $_X['class'] !!} {!! $_X['selector'] !!} wysiwyg_editor" name="{!! $_X['name'] !!}" placeholder="{{ $_X['placeholder'] }}" rows="{!! $_X['rows'] !!}" {!! $_X['attr'] !!} {!! $_X['readonly'] ? 'readonly=""' : '' !!} {!! $_X['disabled'] ? 'disabled=""' : '' !!}>{!! $_X['value'] !!}</textarea>
                @if($_X['errors']->has($_X['name']) && $_X['showErrors'])
                    <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
                @endif
                @if($_X['help'])
                    <span class="form-text text-muted">{!! $_X['help'] !!}</span>
                @endif
            </div>
        </div>
    @elseif($_X['view'] == 'DEFAULT')
        <div class="form-group">
            <label>{!! $_X['label'] !!}</label>
            <textarea class="form-control {!! $_X['errors']->has($_X['name']) ? 'is-invalid' : '' !!} {!! $_X['class'] !!} {!! $_X['selector'] !!} wysiwyg_editor" name="{!! $_X['name'] !!}" placeholder="{{ $_X['placeholder'] }}" rows="{!! $_X['rows'] !!}" {!! $_X['attr'] !!} {!! $_X['readonly'] ? 'readonly=""' : '' !!} {!! $_X['disabled'] ? 'disabled=""' : '' !!}>{!! $_X['value'] !!}</textarea>
            @if($_X['errors']->has($_X['name']) && $_X['showErrors'])
                <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
            @endif
            @if($_X['help'])
                <span class="form-text text-muted">{!! $_X['help'] !!}</span>
            @endif
        </div>
    @endif
    @push('script')
        <script type="text/javascript">
            tinymce.init({
                selector        : 'textarea.{!! $_X['selector'] !!}',
                language        : '{{ $_LOCALE_ }}',
                directionality  : '{{ $_DIR_ }}',
                
                inline_styles           : false,
                forced_root_block       : "",
                cleanup                 : true,
                remove_linebreaks       : true,
                convert_newlines_to_brs : false,
                entity_encoding         : 'raw',
                entities                : '160,nbsp,38,amp,60,lt,62,gt',

                // plugins: `
                //     print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable
                // `,
                mobile: {
                    plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
                },
                menu: {

                },
                menubar: 'file edit view insert format tools table help',
                // toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                // image_caption: true,
                // quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                toolbar_mode: 'sliding',
                // contextmenu: "link image imagetools table configurepermanentpen",
                a11y_advanced_options: true,

                plugins: [
                    "advlist autolink lists link image media charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime save table contextmenu directionality",
                    "emoticons template paste textcolor"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code image | forecolor backcolor emoticons | visualblocks",
                content_css: [
                    '//fonts.googleapis.com/css?family=Tajawal:300,300i,400,400i',
                ],
                setup: function (ed)
                {
                    ed.on('init', function ()
                    {
                        this.execCommand("fontName", false, "Tajawal, arial, sans-serif");
                        this.execCommand("fontSize", false, "12pt");
                    });
                },
            });
        </script>
    @endpush
@endif