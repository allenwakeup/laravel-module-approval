<template>
    <a-config-provider :locale="locale">
        <router-view></router-view>
    </a-config-provider>
</template>

<script>
import zhCN from 'ant-design-vue/lib/locale-provider/zh_CN';
export default {
    components: {},
    props: {},
    data() {
      return {
          locale: zhCN,
      };
    },
    watch: {},
    computed: {},
    methods: {},
    created() {},
    mounted() {},
    
};
</script>
<style lang="scss">
#app{
  color:#333;
  font-size: 14px;
  height: 100%;
}
</style>
