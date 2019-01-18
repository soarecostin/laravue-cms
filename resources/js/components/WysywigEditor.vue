<template>
    <div class="mb-4">
        
        <label :for="name" :class="className">{{ label }}</label> <!--h5 mb-3 mt-2 -->
        
        <vue-ckeditor 
            :id="name"
            :name="name" 
            v-model="editorContent" 
            :config="getCkConfig" 
            @blur="onBlur($event)" 
            @focus="onFocus($event)">
        </vue-ckeditor>
        
        
        <span class="text-danger" v-if="error">
            <small><strong>{{ error }}</strong></small>
        </span>
    </div>
</template>

<script>
import VueCkeditor from 'vue-ckeditor2';

export default {
    components: { VueCkeditor },
    props: ['content', 'name', 'label', 'className', 'error', 'type'],
    data() {
        return {
            editorContent: this.content,
            ckConfig: {
                'classic': {
                    extraAllowedContent: 'div(*)',
                    allowedContent: true,
                    toolbar: [
                        { name: 'document', items: [ 'Source', '-'] },
                        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] },
                        //{ name: 'styles', items: [ 'Format' ] },
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                        { name: 'links', items: [ 'Link', 'Unlink' ] },
                        { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule'] },
                    ],
                    contentsCss: '/css/app.css',
                    bodyClass: 'ckeditor',
                    extraPlugins: 'autogrow',
                    autoGrow_onStartup: true,
                    autoGrow_minHeight: 250,
                    autoGrow_maxHeight: 2000,
                    
                    filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Files',
                    filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
                },
                'basic': {
                    extraAllowedContent: 'div(*)',
                    allowedContent: true,
                    toolbar: [
                        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] },
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] },
                        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-' ] },
                        { name: 'links', items: [ 'Link', 'Unlink' ] },
                        { name: 'insert', items: [ 'Table', 'HorizontalRule'] },
                    ],
                    contentsCss: '/css/app.css',
                    bodyClass: 'ckeditor',
                    extraPlugins: 'autogrow',
                    autoGrow_onStartup: true,
                    autoGrow_minHeight: 250,
                    autoGrow_maxHeight: 2000,
                }
            }
        };
    },
    watch: {
        editorContent: function (newVal, oldVal) {
            if (oldVal.trim().replace(/\s/g, "") != newVal.trim().replace(/\s/g, "")) {
                this.$emit('changed', 'true');
            }
        }
    },
    computed: {
        getCkConfig() {
            if (this.type && this.ckConfig[this.type]) {
                return this.ckConfig[this.type]
            } else {
                return this.ckConfig['classic'];
            }
        },
    },
    created: function () {
    },
    methods: {
        onBlur(editor) {
            //console.log(editor);
        },
        onFocus(editor) {
            //console.log(editor);
        },
    }
};
</script>