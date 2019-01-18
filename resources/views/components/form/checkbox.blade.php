<div class="form-group">
    @php
        $fieldValue = '';
        if (isset($value)) {
            $fieldValue = $value;
        } else if (isset($object) && isset($object->{$name})) {
            $fieldValue = $object->{$name};
        }
        $fieldValue = old($name, $fieldValue);
    @endphp

    <div class="custom-control custom-checkbox {{ $className ?? '' }}">
        <input type="hidden" name="{{$name}}" value="0">
        <input type="checkbox" class="custom-control-input" name="{{$name}}" id="{{$name}}" value="1" {{ $fieldValue ? 'checked' : '' }}>
        <label class="custom-control-label {{ $errors->has($name) ? ' is-invalid' : '' }}" for="{{$name}}">{{ $label }}</label>

        @if ($errors->has($name))
            <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>