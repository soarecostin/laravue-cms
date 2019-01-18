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
    
    <textarea id="{{ $name }}" 
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
        name="{{ $name }}"
        {!! isset($vmodel) ? 'v-model="'.$vmodel.'"' : '' !!}
        {{ isset($attributes) ? $attributes : '' }}
        autocomplete="off" rows="{{ $rows ?? 5 }}"
        {{ isset($required) && $required ? 'required' : '' }}
        >{{ $fieldValue }}</textarea>
    
    @if (isset($help))
        <small class="form-text text-muted">{{ $help }}</small>
    @endif

    @if ($errors->has($name))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>