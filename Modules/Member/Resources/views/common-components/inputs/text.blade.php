@if(isset($options))
    @php
        $_X = array_merge([
            'id'          => null,
            'name'        => null,
            'type'        => 'text',
            'label'       => null,
            'placeholder' => null,
            'help'        => null,
            'class'       => null,
            'container_attributes' => null,
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
        <div class="form-group row" {!! $_X['container_attributes'] !!}>
            @if ($_X['label'])
                <label class="{!! $_X['label_size'] !!} col-form-label">{!! $_X['label'] !!}</label>
            @endif
            <div class="{!! $_X['input_size'] !!}">
                <input name="{!! $_X['name'] !!}" type="{!! $_X['type'] !!}" class="form-control {!! $_X['errors']->has($_X['name']) ? 'is-invalid' : '' !!} {!! $_X['class'] !!}" placeholder="{{ $_X['placeholder'] }}" value="{{ $_X['value'] }}" {!! $_X['attr'] !!} {!! $_X['readonly'] ? 'readonly=""' : '' !!} {!! $_X['disabled'] ? 'disabled=""' : '' !!}>
                @if($_X['errors']->has($_X['name']) && $_X['showErrors'])
                    <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
                @endif
                @if($_X['help'])
                    <span class="form-text text-muted">{!! $_X['help'] !!}</span>
                @endif
            </div>
        </div>
    @elseif($_X['view'] == 'DEFAULT')
        <div class="form-group" {!! $_X['container_attributes'] !!}>
            @if ($_X['label'])
                <label>{!! $_X['label'] !!}</label>
            @endif
            <input name="{!! $_X['name'] !!}" type="{!! $_X['type'] !!}" class="form-control {!! $_X['errors']->has($_X['name']) ? 'is-invalid' : '' !!} {!! $_X['class'] !!}" placeholder="{{ $_X['placeholder'] }}" value="{{ $_X['value'] }}" {!! $_X['attr'] !!} {!! $_X['readonly'] ? 'readonly=""' : '' !!} {!! $_X['disabled'] ? 'disabled=""' : '' !!}>
            @if($_X['errors']->has($_X['name']) && $_X['showErrors'])
                <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
            @endif
            @if($_X['help'])
                <span class="form-text text-muted">{!! $_X['help'] !!}</span>
            @endif
        </div>
    @endif
@endif