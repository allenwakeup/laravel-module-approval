<template>
    <bpmn></bpmn>
</template>

<script>
import Bpmn from '@/components/admin/bpmn'

export default {
    components: { Bpmn },
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
