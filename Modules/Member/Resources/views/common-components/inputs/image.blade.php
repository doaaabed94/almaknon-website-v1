@if(isset($options))
    @php
        $_X = array_merge([
            'id'          => null,
            'name'        => null,
            'label'       => null,
            'help'        => null,
            'class'       => null,
            'attr'        => null,
            'value'       => null,
            'value_src'   => null,
            'view'        => 'DEFAULT', //INLINE | DEFAULT
            'label_size'  => 'col-lg-3',
            'input_size'  => 'col-lg-8',
            'changable'   => true,
            'change_string' => __('member::strings.change'),
            'cancel_string' => __('member::strings.change'),
            'shape'       => 'circle', //circle | squire
            'default_src' => null,
        ], $options);
    @endphp
    @if($_X['view'] == 'INLINE')
        <div class="form-group row">
            <label class="{!! $_X['label_size'] !!} col-form-label">{!! $_X['label'] !!}</label>
            <div class="{!! $_X['input_size'] !!}">
                <div class="kt-avatar kt-avatar--outline kt-avatar--{!! $_X['shape'] !!}">
                    <div class="kt-avatar__holder" style="background-size: cover; background-image: url({!! is_null($_X['value_src']) ? $_X['default_src'] : $_X['value_src'] !!})"></div>
                    @if($_X['changable'])
                        <label class="kt-avatar__upload fix_error_message" data-toggle="kt-tooltip" title="{!! $_X['change_string'] !!}">
                            <i class="fa fa-pen"></i>
                            <input {!! $_X['id'] ? 'id="' . $_X['id'] . '"' : '' !!} type='file' name="{!! $_X['name'] !!}" class="{!! $_X['class'] !!}" {!! $_X['attr'] !!}/>
                        </label>
                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="{!! $_X['cancel_string'] !!}">
                            <i class="fa fa-times"></i>
                        </span>
                    @endif
                </div>
                @if($_X['help'])
                    <span class="form-text text-muted">{!! $_X['help'] !!}</span>
                @endif
            </div>
        </div>
    @elseif($_X['view'] == 'DEFAULT')
    <div class="form-group row">
        <label class="col-lg-12 col-form-label">{!! $_X['label'] !!}</label>
        <div class="col-lg-12">
            <div class="kt-avatar kt-avatar--outline kt-avatar--{!! $_X['shape'] !!}">
                <div class="kt-avatar__holder" style="background-size: cover; background-image: url({!! is_null($_X['value_src']) ? $_X['default_src'] : $_X['value_src'] !!})"></div>
                @if($_X['changable'])
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="{!! $_X['change_string'] !!}">
                        <i class="fa fa-pen"></i>
                        <input {!! $_X['id'] ? 'id="' . $_X['id'] . '"' : '' !!} type='file' name="{!! $_X['name'] !!}" class="{!! $_X['class'] !!}" {!! $_X['attr'] !!}/>
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="{!! $_X['cancel_string'] !!}">
                        <i class="fa fa-times"></i>
                    </span>
                @endif
            </div>
            @if($_X['help'])
                <span class="form-text text-muted">{!! $_X['help'] !!}</span>
            @endif
        </div>
    </div>
    @endif
@endif