<div class="form-group">
    @include ('components.form._label')

    @php
        $fieldValue = '';
        if (!isset($alwaysEmpty)) {
            if (isset($value)) {
                $fieldValue = $value;
            } else if (isset($object) && isset($object->{$name})) {
                $fieldValue = $object->{$name};
            }
            $fieldValue = old($name, $fieldValue);
        }
    @endphp

    @if (isset($inputGroup))<div class="input-group">@endif
        @if (isset($inputGroupPrepend))
        <div class="input-group-prepend">
            {!! $inputGroupPrepend !!}
        </div>
        @endif

        <input id="{{ $name }}" 
            type="{{ $type ?? 'text' }}"
            class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
            name="{{ $name }}"
            placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
            {!! isset($vmodel) ? 'v-model="'.$vmodel.'"' : '' !!}
            value="{{ $fieldValue }}"
            {{ isset($attributes) ? $attributes : '' }}
            {{ isset($required) && $required ? 'required' : '' }}
            autocomplete="off"
        >

        @if (isset($inputGroupAppend))
        <div class="input-group-append">
            {!! $inputGroupAppend !!}
        </div>
        @endif

        @if ($errors->has($name))
            <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
        
    @if (isset($inputGroup))</div>@endif

    @if (isset($help))
        <small class="form-text text-muted">{!! $help !!}</small>
    @endif
</div>