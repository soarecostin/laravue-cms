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

    <select {!! isset($vmodel) ? 'v-model="'.$vmodel.'"' : '' !!} 
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" 
        name="{{ $name }}" id="{{ $name }}"
        {{ isset($required) && $required ? 'required' : '' }}
        >
        @if (isset($nulloption))
            <option value>{{ $nulloption }}</option>
        @endif

        @if (isset($options))
            @foreach ($options as $opt_value => $opt_label)
                <option value="{{ $opt_value }}" {{ $fieldValue == $opt_value ? 'selected' : '' }}>{{ $opt_label }}</option>
            @endforeach
        @endif
    </select>

    @if ($errors->has($name))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>