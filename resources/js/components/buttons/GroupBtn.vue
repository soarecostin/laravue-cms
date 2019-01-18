<template>
    <div>
        <b-dropdown 
            size="sm" 
            :dropup="false"
            right
            no-caret
            toggle-class="rounded"
            boundary="window">
            
            <template slot="button-content">
                <i class="fas fa-ellipsis-h fa-fw"></i>
                <span v-if="pill" class="badge badge-pill badge-danger badge-pill--count">{{pill}}</span>
            </template>

            <b-dropdown-item
                v-for="(btn, key) in buttons" 
                :key="key"
                :href="!btn.confirm ? btn.url : 'javascript:void(0)'"
                @click.stop="btn.confirm ? pleaseConfirm(key) : null"
                :disabled="Boolean(btn.disabled)">

                {{btn.label}} 
                <span v-if="btn.pill" class="badge badge-pill badge-danger align-middle">{{btn.pill}}</span>

            </b-dropdown-item>
            
        </b-dropdown>
        
        <div v-for="(btn,key) in buttons" :key="key">
            <b-modal v-if="btn.confirm" :ref="'confirm' + key" title="Please confirm" @ok="handleOk(btn.url)" :busy="false" class="text-left">
                <p>{{btn.confirm}}</p>
            </b-modal>
        </div>
    </div>
</template>

<script>
export default {
    props: ['pill', 'buttons'],
    methods: {
        pleaseConfirm (key) {
            this.$refs['confirm' + key][0].show();
        },
        handleOk (url) {
            window.location.href = url;
        }
    }
}
</script>