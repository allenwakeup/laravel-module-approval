<template>
    <div>
        <a-input v-model="file">
            <a-icon slot="addonAfter" type="edit" @click="toggle"/>
        </a-input>
        <a-modal
                :title="title"
                :body-style="{ overflow: 'scroll', height: '100%' }"
                :dialog-style="{ top: 0, left: 0 }"
                :visible="show"
                @cancel="close"
                cancelText="关闭"
                width="99%"
                :footer="null"
                height="100%">
            <a-layout-content>
                <a-bpmn-designer :actions="actions" @change="onChangeFilePath"></a-bpmn-designer>
            </a-layout-content>
        </a-modal>
    </div>
</template>
<script>
    import ABpmnDesigner from './designer'

    export default {
        name: "ABpmnInput",
        components: {
            ABpmnDesigner
        },
        props: {
            file: {
                required: true,
                type: String,
                default: ""
            },
            actions: {
                required: true,
                type: Object,
                default: ()=> {
                    return {
                        upload: '',
                        import: ''
                    };
                }
            },
            title: {
                type: String,
                default: "设计器"
            }
        },
        computed: {},
        data() {
            return {
                show: false
            };
        },
        methods: {
            toggle(){
                this.show = !this.show;
            },
            onChangeFilePath(result){
                this.$emit("change", result);
            },
            close(){
                this.show = false;
            }
        },
        created() {},
        mounted() {}
    };
</script>
<style lang="scss" scoped>

</style>
