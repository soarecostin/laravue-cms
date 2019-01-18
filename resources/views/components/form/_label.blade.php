@if (!isset($nolabel))
    <label for="{{ $name }}" class="{{ $labelClass ?? '' }}">
        {{ $label ?? ucwords(str_replace("_", " ", $name)) }}
        
        {!! isset($required) && $required ? '<span class="font-weight-bold">*</span>' : '' !!}
        
        @if (isset($desc))
            <small class="font-weight-light form-text text-muted">{!! $desc !!}</small>
        @endif
    </label>
@endif