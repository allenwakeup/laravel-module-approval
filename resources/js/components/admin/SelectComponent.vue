<template>
    <select :name="field" :value="value" :xm-select="field" :xm-select-max="max" :keyword="keyword"></select>
</template>

<script>

    import { mapActions } from 'vuex'

    export default {

        name: "Selection",

        props: {

            // 自定义返回数据中name的key, 默认 name
            keyname: {
                type:String
            },
            // 自定义返回数据中value的key, 默认 value
            keyval: {
                type:String
            },
            //多选最多选择数量
            max: {
                type: Number
            },
            // 主动触发查询参数
            keyword: {
                type: String
            },
            // 表单字段
            field: {
                type: String
            },
            // 将selected的ID转换称pidname
            search: {
                type: String
            },
            // 将selected的ID转换称pidname
            value: {
                type: String
            }

        },
        data() {
            return {
                listLoading: false,
            }
        },
        created () {
            this.fetchSelectData ();
        },

        methods: {
            // ...mapActions([]),
            fetchSelectData () {
                var that = this;
                layuiHandler(() => {

                });
            }

        }
    }

</script>

<style scoped lang="scss">


</style>