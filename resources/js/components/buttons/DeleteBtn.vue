<template>
    <div>
        <button class="btn btn-sm btn-danger" @click.stop="pleaseConfirm" :disabled="Boolean(disabled)">
            <i class="far fa-trash-alt fa-fw"></i>
        </button>
        
        <b-modal ref="confirmDelete" title="Please confirm" @ok="handleOk" :busy="busy" class="text-left">
            <pulse-loader :loading="busy" position="relative" class="text-center"></pulse-loader>
            <p v-if="!busy">Are you sure you want to delete this item?</p>
        </b-modal>
    </div>
</template>

<script>
import PulseLoader from '../PulseLoader.vue'

export default {
    components: {
        PulseLoader
    },
    props: {
        csrfToken: String,
        url: String,
        disabled: {
            type: [Boolean, String, Number],
            default: false,
        },
    },
    data () {
        return {
            busy: false,
        }
    },
    methods: {
        pleaseConfirm (e) {
            this.$refs.confirmDelete.show();
        },
        handleOk (evt) {
            this.busy = true;
            evt.preventDefault();
            
            axios.delete(this.url, {
                params: {

                }
            }).then((response) => {
               
               this.busy = false;
               this.$refs.confirmDelete.hide();
               window.location.reload();

            }).catch(error => {

                this.busy = false;
                
            });
        },
    }
}
</script>