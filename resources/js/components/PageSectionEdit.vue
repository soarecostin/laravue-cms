<template>
    <div>
        
        <div v-if="section.id == 1">
                
            <wysywig-editor 
                label="Content"
                :content="content"
                name="content"
                type="classic">
            </wysywig-editor>

        </div>

        <div v-if="section.id > 1">
            
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Fields" active>
                        
                        <vue-form-generator 
                            :schema="JSON.parse(section.fields)" 
                            :model="templateData" 
                            :options="formOptions">
                        </vue-form-generator>

                    </b-tab>
                    <b-tab title="Preview" >
                        
                        <div>
                            <dynamic-template 
                                :component="section.template_name"
                                :data="templateData">
                            </dynamic-template>
                        </div>

                    </b-tab>
                </b-tabs>
            </b-card>

        </div>
    </div>
</template>

<script>
export default {
    props: ['dbSection', 'dbContent', 'dbTemplateData'],
    data() {
        return {
            section: this.dbSection,
            content: this.dbContent,
            templateData: this.dbTemplateData,
            formOptions: {
                validateAfterLoad: true,
                validateAfterChanged: true
            }
        };
    },
    created: function() {
        this.prefillWithPlaceholders();
    },
    methods: {
        prefillWithPlaceholders() {
            if (this.section.fields) {
                let schema = JSON.parse(this.section.fields);
                let fields = schema.fields;

                // Deal with groups as well
                if (fields) {
                    for (let i = 0; i < fields.length; i++) {
                        if (fields[i].placeholder && !this.templateData[fields[i].model]) {
                            Vue.set(this.templateData, fields[i].model, fields[i].placeholder);
                        }
                    }
                }
            }
        },
    }
};
</script>