<div>
    <div class="form-group">
        @include ('components.form._label')
        
        <form-checkboxes
            name="{{ $name }}"
            label="{{ $label }}"
            :values="{{ $values->toJson() }}"
            :selected-val="{{ json_encode($selectedVal) }}"
            :values-by-key="{{ json_encode($valuesByKey) }}"
            :values-modal-summaries="{{ json_encode($valuesModalSummaries) }}"
            group-component="b-form-radio-group"
            el-component="b-form-radio">
        </form-checkboxes>
        
        @if (isset($help))
            <small class="form-text text-muted">{!! $help !!}</small>
        @endif

        @if ($errors->has($name))
            <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>