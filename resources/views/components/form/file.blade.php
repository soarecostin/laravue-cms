<v-file inline-template>
    <div class="form-group">
        @if (isset($label))
        <label for="{{ $name }}">
            {{ $label }}
            {!! isset($required) && $required ? '<span class="font-weight-bold">*</span>' : '' !!}
        </label>
        @endif

        @if ($show_file)
        <div>
            {!! $file !!}
        </div>
        @endif
        
        <b-form-file name="{{$name}}" v-model="{{$name}}" placeholder="Choose a file..."></b-form-file>
        
        <div class="form-control d-none {{ $errors->has($name) ? 'is-invalid' : '' }}"></div>
        
        @if ($errors->has($name))
            <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</v-file>

@push('footer-scripts')
<script type="text/javascript">
    Vue.component('v-file', {
        data() {
            return {
                {{$name}}: null,
            }
        }
    });
</script>
@endpush