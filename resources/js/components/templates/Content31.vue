<template>
  <section class="fdb-block">
    <div class="container">
      <div class="row text-left align-items-center">
        <div class="col-12 col-md-6 col-lg-4">
            <h2>
                {{ tpl_title_1 }}
            </h2>
            <p class="lead">
                {{ tpl_content_1 }}
            </p>
            <p class="lead">
                <a :href="tpl_btn_url_1" class="btn btn-outline-primary">{{ tpl_btn_label_1 }}</a>
            </p>
        </div>

        <div class="col-12 col-md-6 col-lg-4 pt-4 pt-md-0">
            <h2>
                {{ tpl_title_2 }}
            </h2>
            <p class="lead">
                {{ tpl_content_2 }}
            </p>
            <p class="lead">
                <a :href="tpl_btn_url_2" class="btn btn-outline-primary">{{ tpl_btn_label_2 }}</a>
            </p>
        </div>

        <div class="col-12 col-md-8 m-auto m-lg-0 col-lg-4 pt-5 pt-lg-0">
            <img alt="image" class="img-fluid" :src="'/img/draws/'+tpl_image+'.svg'">
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["tpl_title_1", "tpl_title_2", "tpl_content_1", "tpl_content_2", "tpl_btn_label_1", "tpl_btn_label_2", "tpl_btn_url_1", "tpl_btn_url_2", "tpl_image"]
};
</script>