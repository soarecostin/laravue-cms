<template>
    <div class="mb-4">
        
        <input type="hidden" name="section_id" v-model="selectedSectionId">
        
        <!-- Choose section type -->
        <div v-if="!selectedSectionId">

            <b-form-group class="mb-4" label="Section type">
                <b-form-radio-group buttons
                                button-variant="outline-dark"
                                v-model="selectedSectionType"
                                :options="sectionTypes"
                                name="section_type" />
            </b-form-group>

            <div class="d-flex flex-row">
                <a v-for="sType in sectionsOfType" :key="sType.id" href="javascript:void(0)" class="w-25 mr-2" v-on:click="selectSectionType(sType)">
                    <img :src="sType.thumbnail" :title="sType.title" class="img-fluid img-thumbnail" />
                </a>
            </div>

        </div>
        
        <!-- Edit section contents -->
        
        <div v-else>
            
            <page-section-edit
                :dbSection="selectedSection"
                :dbContent="dbContent"
                :dbTemplateData="dbTemplateData">
            </page-section-edit>

        </div>

    </div>
</template>

<script>
export default {
    props: ['dbSectionTypes', 'dbSections', 'dbSelectedSectionId', 'dbContent', 'dbTemplateData'],
    data() {
        return {
            selectedSectionType: 'headers',
            sectionTypes: this.dbSectionTypes,
            sections: this.dbSections,
            
            selectedSectionId: this.dbSelectedSectionId,
        };
    },
    computed: {
        selectedSection: function () {
            if (this.selectedSectionId) {
                for (let i = 0; i < this.sections.length; i++) {
                    if (this.sections[i]['id'] == this.selectedSectionId) {
                        return this.sections[i];
                    }
                }
            }
            return null;
        },
        sectionsOfType: function () {
            return this.sections.filter(section => {
                return section.section_type_name == this.selectedSectionType
            });
        }
    },
    methods: {
        selectSectionType(sectType) {
            this.selectedSectionId = sectType.id;
        },
    }
};
</script>