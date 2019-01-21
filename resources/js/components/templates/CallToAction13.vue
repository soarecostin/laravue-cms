<template>
  <section
    class="fdb-block fdb-viewport bg-dark"
    :style="'background-image: url(/img/hero/'+tpl_image+'.svg);'"
  >
    <div class="container justify-content-center align-items-center d-flex">
      <div class="row justify-content-center text-center">
        <div class="col-12 col-md-8">
          <img alt="image" class="fdb-icon" :src="'/img/icons/'+tpl_icon+'.svg'">
        <h1>{{ tpl_title }}</h1>
          <p class="lead">
              {{ tpl_subtitle }}
            </p>
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
  props: ["tpl_title", "tpl_subtitle", "tpl_btn_label", "tpl_btn_url", "tpl_image", "tpl_icon"]
};
</script>