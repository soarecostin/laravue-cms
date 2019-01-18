<template>
    <toggle-button 
        @change="onChangeEventHandler"
        v-model="val"
        :sync="true" 
        :disabled="Boolean(disabled)" />
</template>

<script>

export default {
    props: {
        urls: [Array, Object],
        value: [Boolean, String, Number],
        disabled: {
            type: [Boolean, String, Number],
            default: false,
        },
    },
    data () {
        return {
            val: Boolean(this.value),
        }
    },
    watch: {
        value: function (newValue) {
            this.val = Boolean(newValue);
        }
    },
    methods: {
        onChangeEventHandler: function (obj) {
            this.$emit('table-start-loading')
            
            let url = this.urls['on'];
            if (!this.val) {
                url = this.urls['off'];
            }

            let promise = axios.get(url);
            return promise.then((response) => {
                this.$emit('table-stop-loading')
            });
        }
    }
}
</script>

<style>
label.vue-js-switch {
    margin-bottom: 0;
}
</style>
