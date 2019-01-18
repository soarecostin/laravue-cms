<template>
    <component :is="component" v-bind="data" v-if="component" />
</template>

<script>
export default {
    name: 'dynamic-template',
    props: ['data', 'component'],
};
</script>