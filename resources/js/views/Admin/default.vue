<template>
    <div class="admin_default">
        <a-row :gutter="{ xs: 24,  md: 24}">
            <a-col :span="8" :xs="{ span: 24 }" :lg="{ span: 8 }">
                <div class="admin_card">
                    <div class="title"></div>
                    <div class="content">

                    </div>
                </div>
            </a-col>
            <a-col :span="8" :xs="{ span: 24 }" :lg="{ span: 8 }">
                <div class="admin_card">
                    <div class="title"></div>
                    <div class="content">
                        <a-row :gutter="{ xs: 12,  md: 12}">
                            <a-col :span="12" :xs="{ span: 24 }" :lg="{ span: 12 }">
                                <div class="color_block">
                                    <div><a-tag color="blue">tag</a-tag></div>
                                    <div class="color_blcok_font"></div>
                                </div>
                            </a-col>
                            <a-col :span="12" :xs="{ span: 24 }" :lg="{ span: 12 }">
                                <div class="color_block">
                                    <div><a-tag color="green">tag</a-tag></div>
                                    <div class="color_blcok_font"></div>
                                </div>
                            </a-col>
                        </a-row>
                        <a-row :gutter="{ xs: 12,  md: 12}">
                            <a-col :span="12" :xs="{ span: 24 }" :lg="{ span: 12 }">
                                <div class="color_block">
                                    <div><a-tag color="red">tag</a-tag></div>
                                    <div class="color_blcok_font"></div>
                                </div>
                            </a-col>
                            <a-col :span="12" :xs="{ span: 24 }" :lg="{ span: 12 }">
                                <div class="color_block">
                                    <div><a-tag color="orange">tag</a-tag></div>
                                    <div class="color_blcok_font"></div>
                                </div>
                            </a-col>
                        </a-row>
                        <div style="height:20px"></div>
                    </div>
                </div>
            </a-col>
            <a-col :span="8" :xs="{ span: 24 }" :lg="{ span: 8 }">
                <div class="admin_card">
                    <div class="title">信息</div>
                    <div class="content" style="margin-top:0;">

                    </div>
                </div>
            </a-col>
        </a-row>
    </div>
</template>

<script>
export default {
    components: {
    },
    props: {},
    data() {
      return {

      };
    },
    watch: {},
    computed: {},
    methods: {

        get_info(){

        },
    },
    created() {

    },
    mounted() {
        this.get_info();
    },

};
</script>
<style lang="scss" scoped>

</style>
