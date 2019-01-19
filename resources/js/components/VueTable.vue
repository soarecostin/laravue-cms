<template>
    <div>
        <div id="header-filters" class="mb-4" v-if="filters">
            <b-form-radio-group v-for="(filter,key) in filters" :key="key"
                buttons
                v-model="filter.selected"
                :name="filter.name"
                :options="filter.options"
                class="mr-2"
                @change="filterChanged" />
        </div>

        <div class="position-relative">
            <b-table head-variant="light" show-empty 
                id="vue-table"
                :busy.sync="busy" 
                :items="loadItems"
                :fields="fields"
                :perPage="perPage"
                :current-page="currentPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc">
                
                <!-- All fields should be treated like HTML -->
                <template v-for="field in fields" :slot="field.key" slot-scope="data">
                    <span v-html='data.value' :key="field.key" :class="field.class"></span>
                </template>
                
                <!-- Status fields [checked/unchecked] -->
                <template v-for="statusField in statusFields" :slot="statusField.key" slot-scope="data">
                    <div class="btn btn-sm disabled" :class="{'btn-outline-success':data.value, 'btn-outline-danger':!data.value}" :key="statusField.key">
                        <i class="fas fa-fw" :class="{'fa-check':data.value, 'fa-times':!data.value}"></i>
                    </div>
                </template>

                <!-- Settings fields -->
                <template slot="HEAD_settings" slot-scope="data">
                    <div class="text-center">{{data.label}}</div>
                </template>
                
                <template slot="settings" slot-scope="row">
                    <div class="d-flex align-items-center justify-content-center">
                        
                        <div v-for="(btn, key) in row.item.settings" :key="key" :class="{'mr-2': key!=(row.item.settings.length-1)}">
                            
                            <delete-btn 
                                :csrf-token="csrfToken"
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

                            <generic-btn 
                                v-bind="btn"
                                v-else>
                            </generic-btn>
                            
                        </div>
                    </div>
                </template>

            </b-table>
            
            <pulse-loader :loading="busy" v-show="busy"></pulse-loader>
        </div>
        
        <b-row v-if="showPagination">
            <b-col md="6" class="my-1">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>
        
    </div>
</template>

<script>

import DeleteBtn from './buttons/DeleteBtn.vue'
import ToggleBtn from './buttons/ToggleBtn.vue'
import GenericBtn from './buttons/GenericBtn.vue'

export default {
    name: "vue-table",
    props: ['csrfToken', 'drawUrl', 'fields', 'items', 'initialPage', 'initialSortBy', 'initialSortDesc', 'initialFilters' ],
    components: {
        DeleteBtn,
        ToggleBtn,
        GenericBtn
    },
    data () {
        return {
            busy: false,
            totalRows: 0,
            perPage: 25,
            currentPage: 1,
            sortBy: 'id',
            sortDesc: false,
            filters: this.initialFilters,
        }
    },
    computed: {
        statusFields: function () {
            if (this.fields) {
                return this.fields.filter(function (field) {
                    if (field.render && field.render == 'status') {
                        return true;
                    }
                    return false;
                });
            }
            return [];
        },
        showPagination: function () {
            if (this.totalRows > this.perPage) {
                return true;
            }
            return false;
        }
    },
    mounted: function () {

        var headerBtnWrapper = document.getElementById('header-btn-wrapper');
        
        var headerFilters = document.getElementById('header-filters');
        if (headerFilters && headerBtnWrapper) {
            while (headerBtnWrapper.childNodes.length > 0) {
                headerFilters.appendChild(headerBtnWrapper.childNodes[0]);
            }
            headerBtnWrapper.remove();
        }
        
    },
    created: function () {
        
        this.currentPage = this.initialPage;
        this.sortBy = this.initialSortBy;
        this.sortDesc = Boolean(this.initialSortDesc);

        this.private = {
            serialize: function(obj, prefix) {
                var str = [],
                    p;
                for (p in obj) {
                    if (obj.hasOwnProperty(p)) {
                    var k = prefix ? prefix + "[" + p + "]" : p,
                        v = obj[p];
                    str.push((v !== null && typeof v === "object") ?
                        serialize(v, k) :
                        encodeURIComponent(k) + "=" + encodeURIComponent(v));
                    }
                }
                return str.join("&");
            }
        }
    },
    methods: {
        loadItems (ctx) {

            if (!this.drawUrl || this.items) {

                this.totalRows = this.items.length;

                return this.items;
            }

            this.busy = true;
            
            //compatibility with the old Datatables
            ctx.start = (ctx.currentPage - 1) * ctx.perPage;
            ctx.length = ctx.perPage;
            
            for (let key in this.filters) {
                if (this.filters.hasOwnProperty(key)) {
                    let filter = this.filters[key];
                    if (filter.name && filter.selected) {
                        ctx[filter.name] = filter.selected;
                    }
                }
            }
            
            let promise = axios.get(this.drawUrl + (this.drawUrl.indexOf('?') != -1 ? '&' : '?') + this.private.serialize(ctx))

            // Must return a promise that resolves to an array of items
            return promise.then((response) => {
                // Pluck the array of items off our axios response
                let items = response.data.data
                
                this.totalRows = response.data.recordsTotal;
                
                this.busy = false
                
                // Must return an array of items or an empty array if an error occurred
                return(items || [])
            }).catch(error => {
                this.busy = false
                return []
            });
        },

        setLoading (isLoading) {
            this.busy = isLoading;
        },

        filterChanged (value) {
            this.$nextTick(() => {
                this.$root.$emit('bv::refresh::table', 'vue-table');
            });
        }
    }
}
</script>

<style>
.table.b-table {
    margin: 0;
}
</style>