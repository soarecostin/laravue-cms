<template>
    <div>
        <div class="position-relative">
            <draggable class="list-group mb-3" element="ul" :options="dragOptions" v-model="items" @end="onReorderEnd" v-if="items.length">
                <transition-group type="transition" :name="'flip-list'">
                    <li class="list-group-item pt-3" v-for="item in items" :key="item.id">
                        
                        <div class="row">
                            <div class="col-auto d-flex align-items-center">
                                <i class="fas fa-grip-vertical list-handle text-black-50" aria-hidden="true"></i>
                            </div>

                            <div v-for="(field, key) in fields" :key="key" :class="field.class">
                                
                                <div v-if="field.key == 'template'" class="template-parent" :style="{height: heights[item.id] + 'px'}">
                                    <div class="template-child" :ref="'childTemplate-'+item.id">
                                        <div v-if="item.template['id'] == 1" v-html="item.template['content']">
                                        </div>

                                        <dynamic-template v-else 
                                            :component="item.template['name']"
                                            :data="JSON.parse(item.template['data'])">
                                        </dynamic-template>
                                    </div>
                                </div>

                                <span v-else-if="field.key != 'settings'" v-html="item[field.key]"></span>

                                <div v-else class="d-flex align-items-center justify-content-center">
                        
                                    <div v-for="(btn, key) in item.settings" :key="key" :class="{'mr-2': key!=(item.settings.length-1)}">
                                        
                                        <delete-btn 
                                            csrf-token="123"
                                            v-bind="btn"
                                            v-if="btn.type == 'delete'">
                                        </delete-btn>
                                        
                                        <toggle-btn 
                                            :urls="btn.urls"
                                            :value.sync="btn.value"
                                            :disabled="btn.disabled"
                                            v-else-if="btn.type == 'switch'"
                                            v-on:table-start-loading="busy = true"
                                            v-on:table-stop-loading="busy = false">
                                        </toggle-btn>
                                        
                                        <group-btn 
                                            v-bind="btn"
                                            v-else-if="btn.type == 'group'">
                                        </group-btn>
            
                                        <generic-btn 
                                            v-bind="btn"
                                            v-else>
                                        </generic-btn>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </li>
                </transition-group>
            </draggable>
            
            <div v-else class="card">
                <div class="card-body">
                    There are no records to show
                </div>
            </div>

            <pulse-loader :loading="busy" v-show="busy"></pulse-loader>
        </div>

        <div class="row align-items-center">
            <div class="col-auto" v-if="items.length">
                <button class="btn btn-info" @click="saveOrder">
                    <i class="fas fa-save"></i>&nbsp; Save order
                </button>
            </div>
            <div class="col text-success" v-if="saveOrderStatus == 1">
                Successfully saved!
            </div>
            <div class="col text-danger" v-if="saveOrderStatus == -1">
                New order not saved!
            </div>
        </div>
    </div>
</template>

<script>

import DeleteBtn from './buttons/DeleteBtn.vue'
import ToggleBtn from './buttons/ToggleBtn.vue'
import GenericBtn from './buttons/GenericBtn.vue'
import GroupBtn from './buttons/GroupBtn.vue'

export default {
    name: "vue-sortable-list",
    props: ['csrfToken', 'drawUrl', 'fields', 'saveOrderUrl'],
    components: {
        DeleteBtn,
        ToggleBtn,
        GenericBtn,
        GroupBtn
    },
    data () {
        return {
            busy: false,
            items: [],
            heights: {},
            saveOrderStatus: 0,
        }
    },
    computed: {
        dragOptions() {
            return {
                animation: 0,
                ghostClass: "ghost",
                handle:'.list-handle'
            };
        },
        listString() {
            return JSON.stringify(this.items, null, 2);
        },
        itemsOrder() {
            var items = [];
            for (var i=0; i<this.items.length; i++) {
                items.push({
                    'id': this.items[i].id,
                    'sort_order': i+1
                });
            }

            return items;
        }
    },
    created: function () {
        this.loadItems();
    },
    methods: {
        loadItems() {
            this.busy = true;
            return axios.get(this.drawUrl)
            .then((response) => {
                this.items = response.data;

                this.loadHeights();

                this.busy = false
            }).catch(error => {
                this.busy = false
            });
        },
        loadHeights() {
            let self = this;

            Vue.nextTick(function() {
                for (let i=0; i<self.items.length; i++) {
                    let height = 0;
                    let itemId = self.items[i].id;
                    
                    if (self.$refs && self.$refs['childTemplate-'+itemId] && self.$refs['childTemplate-'+itemId][0]) {
                        height = self.$refs['childTemplate-'+itemId][0].clientHeight / 4;
                    }
                    Vue.set(self.heights, itemId, height);
                }
            });
        },
        saveOrder() {
            this.busy = true;
            this.saveOrderStatus = 0;
            
            return axios.post(this.saveOrderUrl, {
                'items': JSON.stringify(this.itemsOrder)
            })
            .then((response) => {
                this.busy = false
                this.saveOrderStatus = 1;
            }).catch(error => {
                this.busy = false
                this.saveOrderStatus = -1;
            });
        },
        onReorderEnd() {
            this.loadHeights();
        }
    }
}
</script>

<style>
.flip-list-move {
    transition: transform 0.5s;
}
.no-move {
    transition: transform 0s;
}
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
.list-handle {
    cursor: move;
}
</style>