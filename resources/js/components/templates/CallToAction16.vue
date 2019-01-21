<template>
    <section class="fdb-block bg-dark fdb-viewport" :style="'background-image: url(/img/hero/'+tpl_image+'.svg);'">
        <div class="container align-items-center justify-content-center d-flex">
            <div class="row justify-content-center text-center">
            <div class="col-12 col-md-10 col-lg-8">
                <h1>{{ tpl_title }}</h1>
                <p class="mt-5">
                    <a :href="tpl_btn_url" class="btn btn-dark">{{ tpl_btn_label }}</a>
                </p>
            </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['tpl_title', 'tpl_btn_label', 'tpl_btn_url', 'tpl_image'],
};
</script>