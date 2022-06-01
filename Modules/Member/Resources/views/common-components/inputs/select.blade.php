@if(isset($options))
    @php
        $_X = array_merge([
            'id'          => null,
            'name'        => null,
            'label'       => null,
            'help'        => null,
            'class'       => null,
            'container_class' => null,
            'attr'        => null,
            'value'       => null,
            'view'        => 'DEFAULT', //INLINE | DEFAULT
            'label_size'  => 'col-lg-3',
            'input_size'  => 'col-lg-8',
            'size'        => null,
            'nullable'    => false,
            'nullable_v'  => null,
            'options'     => [],
            
            'text'        => function($K, $X){ return null; },
            'values'      => function($K, $X){ return null; },
            'subText'     => function($K, $X){ return null; },
            'option_attr' => function($K, $X){ return null; },
            'select'      => function($K, $X, $selected){ return false; },
            'disable'     => function($K, $X, $selected){ return false; },
            'disabled'    => false,
            'searchable'  => false,
            'errors'      => $errors,
            'showErrors'  => true,
        ], $options);
    @endphp
    @if( $_X['view'] == 'INLINE' )
        <div class="form-group row {!! $_X['container_class'] !!}">
            <label class="{!! $_X['label_size'] !!} col-form-label">{!! $_X['label'] !!}</label>
            <div class="{!! $_X['input_size'] !!}">
                <select name="{!! $_X['name'] !!}" class="form-control kt-selectpicker {!! $_X['errors']->has($_X['name']) ? 'is-invalid' : '' !!} {!! $_X['class'] !!}" {!! (!is_null($_X['size'])) ? 'data-size="'. $_X['size'] .'"' : '' !!} {!! $_X['attr'] !!} {!! $_X['disabled'] ? 'disabled=""' : '' !!} {!! $_X['searchable'] ? 'data-live-search="true"' : '' !!}>
                    @if( !is_null($_X['nullable']) )
                        <option value="{!! $_X['nullable_v'] !!}">{!! $_X['nullable'] !!}</option>
                    @endif
                    @foreach($_X['options'] as $i => $option)
                        <option 
                            @if( $attr = $_X['option_attr']($i, $option) ) {!! $attr !!} @endif
                            value="{!! $_X['values']($i, $option) !!}" 
                            data-subtext="{!! $_X['subText']($i, $option) !!}"
                            @if( $_X['select']($i, $option, $_X['value']) ) selected="" @endif
                            @if( $_X['disable']($i, $option, $_X['value']) ) disabled="" @endif>
                            {!! $_X['text']($i, $option) !!}
                        </option>
                    @endforeach
                </select>
                @if($_X['errors']->has($_X['name']) && $_X['showErrors'])
                    <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
                @endif
                @if($_X['help'])
                    <span class="form-text text-muted">{!! $_X['help'] !!}</span>
                @endif
            </div>
        </div>
    @elseif($_X['view'] == 'DEFAULT')
        <div class="form-group {!! $_X['container_class'] !!}">
            <label>{!! $_X['label'] !!}</label>
            <select name="{!! $_X['name'] !!}" class="form-control kt-selectpicker {!! $_X['errors']->has($_X['name']) ? 'is-invalid' : '' !!} {!! $_X['class'] !!}" {!! (!is_null($_X['size'])) ? 'data-size="'. $_X['size'] .'"' : '' !!} {!! $_X['attr'] !!} {!! $_X['disabled'] ? 'disabled=""' : '' !!} {!! $_X['searchable'] ? 'data-live-search="true"' : '' !!}>
                @if( !is_null($_X['nullable']) )
                    <option value="{!! $_X['nullable_v'] !!}">{!! $_X['nullable'] !!}</option>
                @endif
                @foreach($_X['options'] as $i => $option)
                    <option 
                        value="{!! $_X['values']($i, $option) !!}" 
                        data-subtext="{!! $_X['subText']($i, $option) !!}"
                        @if( $_X['select']($i, $option, $_X['value']) ) selected="" @endif>
                        {!! $_X['text']($i, $option) !!}
                    </option>
                @endforeach
            </select>
            @if($_X['errors']->has($_X['name']) && $_X['showErrors'])
                <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
            @endif
            @if($_X['help'])
                <span class="form-text text-muted">{!! $_X['help'] !!}</span>
            @endif
        </div>
    @endif
@endif