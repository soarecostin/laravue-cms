<template>
    <section class="fdb-block">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1>{{ tpl_title }}</h1>
                </div>
            </div>

            <div class="row text-center justify-content-center mt-5">
                <div class="col-12 col-sm-4 col-xl-3 m-md-auto">
                    <img alt="image" class="fdb-icon" :src="'/img/icons/'+tpl_feature_icon_1+'.svg'">
                    <h3>
                        <strong>{{ tpl_feature_title_1 }}</strong>
                    </h3>
                    <p>
                        {{ tpl_feature_desc_1 }}
                    </p>
                </div>

                <div class="col-12 col-sm-4 col-xl-3 m-auto pt-4 pt-sm-0">
                    <img alt="image" class="fdb-icon" :src="'/img/icons/'+tpl_feature_icon_2+'.svg'">
                    <h3>
                        <strong>{{ tpl_feature_title_2 }}</strong>
                    </h3>
                    <p>
                        {{ tpl_feature_desc_2 }}
                    </p>
                </div>

                <div class="col-12 col-sm-4 col-xl-3 m-auto pt-4 pt-sm-0">
                    <img alt="image" class="fdb-icon" :src="'/img/icons/'+tpl_feature_icon_3+'.svg'">
                    <h3>
                        <strong>{{ tpl_feature_title_3 }}</strong>
                    </h3>
                    <p>
                        {{ tpl_feature_desc_3 }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
  props: [
    "tpl_title",
    "tpl_feature_icon_1",
    "tpl_feature_icon_2",
    "tpl_feature_icon_3",
    "tpl_feature_title_1",
    "tpl_feature_title_2",
    "tpl_feature_title_3",
    "tpl_feature_desc_1",
    "tpl_feature_desc_2",
    "tpl_feature_desc_3",
  ]
};
</script>