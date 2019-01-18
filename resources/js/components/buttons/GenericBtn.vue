<template>
    <b-button 
        class="btn position-relative" 
        :class="{ 'btn-sm': !large }"
        :variant="variant"
        :title="title"
        :href="url"
        :target="target"
        :disabled="Boolean(disabled)">
        
        <i class="fa-fw" :class="[icon]"></i>
        <span class="badge badge-pill badge-danger badge-pill--count" v-if="pill">{{pill}}</span>
        <span v-if="label">{{label}}</span>

    </b-button>
</template>

<script>
export default {
    props: {
        url: String,
        icon: String,
        variant: String,
        title: String,
        pill: Number,
        disabled: {
            type: [Boolean, String, Number],
            default: false,
        },
        label: String,
        target: {
            type: String,
            default: '_self'
        },
        large: {
            type: [Boolean, String, Number],
            default: false,
        }
    },
}
</script>