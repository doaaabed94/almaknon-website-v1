@if (isset($options))
    @php
        $_X = array_merge(
            [
                'id' => null,
                'name' => null,
                'type' => 'checkbox',
                'label' => null,
                'input_label' => null,
                'placeholder' => null,
                'help' => null,
                'class' => null,
                'attr' => null,
                'options' => [],
                'container_class' =>'col-md-12',
                'text' => function ($K, $X) {
                    return null;
                },
                'values' => function ($K, $X) {
                    return null;
                },
                'option_attr' => function ($K, $X) {
                    return null;
                },
                'select' => function ($K, $X, $selected) {
                    return false;
                },
                'disable' => function ($K, $X, $selected) {
                    return false;
                },
                'disabled' => false,
                'value' => null,
                'view' => 'DEFAULT', //INLINE | DEFAULT
                'label_size' => 'col-lg-3',
                'input_size' => 'col-lg-8',
                'disabled' => false,
                'readonly' => false,
                'errors' => $errors,
                'showErrors' => true,
            ],
            $options,
        );
    @endphp

@if ($_X['view'] == 'INLINE')
        <div class="form-group row  {!! $_X['container_class'] !!}">
            <label class="{!! $_X['label_size'] !!} col-form-label">{!! $_X['label'] !!}</label>
            <div class="{!! $_X['input_size'] !!}">
                <div class="kt-checkbox-list">
                    @foreach ($_X['options'] as $i => $option)
                        <div class="kt-checkbox">
                            <input name="{!! $option['name'] !!}" type="{!! $_X['type'] !!}"
                            class="custom-control-input {!! $_X['class'] !!}" value="{!! $_X['values']($i, $option) !!}"
                            id="customRadio{!! $option['name'] !!}{!! $i !!}"
                                {!! $_X['attr'] !!} @if ($attr = $_X['option_attr']($i, $option)) {!! $attr !!} @endif
                                @if ($_X['select']($i, $option, $_X['value'])) checked="" @endif
                                @if ($_X['disable']($i, $option, $_X['value'])) disabled="" @endif {!! $_X['readonly'] ? 'readonly=""' : '' !!}
                                {!! $_X['disabled'] ? 'disabled=""' : '' !!}>
                                <label class="custom-control-label" for="customRadio{!! $option['name'] !!}{!! $i !!}">{!! $_X['text']($i, $option) !!}</label>
                        </div>
                    @endforeach
                </div>
                @if ($_X['errors']->has($_X['name']) && $_X['showErrors'])
                    <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
                @endif
                @if ($_X['help'])
                    <span class="form-text text-muted"> {!! $_X['help'] !!} </span>
                @endif
            </div>
        </div>
    @elseif($_X['view'] == 'DEFAULT')
        <div class="form-group   {!! $_X['container_class'] !!}">
            <label>{!! $_X['label'] !!}</label>
            <div class="kt-checkbox-list">
                @foreach ($_X['options'] as $i => $option)
                    <div class="custom-control custom-radio ">
                        <input name="{!! $option['name'] !!}" type="{!! $_X['type'] !!}"
                            class="custom-control-input {!! $_X['class'] !!}" value="{!! $_X['values']($i, $option) !!}"
                            id="customRadio{!! $option['name'] !!}{!! $i !!}"
                            {!! $_X['attr'] !!} @if ($attr = $_X['option_attr']($i, $option)) {!! $attr !!} @endif
                            @if ($_X['select']($i, $option, $_X['value'])) checked="" @endif
                            @if ($_X['disable']($i, $option, $_X['value'])) disabled="" @endif {!! $_X['readonly'] ? 'readonly=""' : '' !!}
                            {!! $_X['disabled'] ? 'disabled=""' : '' !!}>
                        <label class="custom-control-label" for="customRadio{!! $option['name'] !!}{!! $i !!}">{!! $_X['text']($i, $option) !!}</label>
                    </div>
                @endforeach
            </div>
            @if ($_X['errors']->has($_X['name']) && $_X['showErrors'])
                <div class="invalid-feedback">{!! $_X['errors']->first($_X['name']) !!}</div>
            @endif
            @if ($_X['help'])
                <span class="form-text text-muted"> {!! $_X['help'] !!} </span>
            @endif
        </div>
    @endif
@endif
