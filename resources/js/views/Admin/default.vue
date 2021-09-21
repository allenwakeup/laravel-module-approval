<template>
    <a-workflow></a-workflow>
</template>

<script>
import AWorkflow from "@/components/admin/aworkflow";

export default {
    components: { AWorkflow },
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
