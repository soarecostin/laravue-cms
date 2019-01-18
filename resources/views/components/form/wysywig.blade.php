<wysywig-editor
    name="{{ $name }}"
    label="{{ isset($label) ? $label : ucwords(str_replace("_", " ", $name)) }}"
    content="{{ isset($value) ? $value : (old($name) ?: (isset($object) ? $object->{$name} : '')) }}"
></wysywig-editor>