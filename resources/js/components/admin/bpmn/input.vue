<template>
    <div>
        <a-input v-model="file" disabled>
            <a-icon slot="addonAfter" type="edit" @click="toggle"/>
        </a-input>
        <a-modal
                :title="title"
                :body-style="{padding: 0, height: '800px' }"
                :dialog-style="{ top: 0, left: 0 }"
                :visible="show"
                @cancel="close"
                cancelText="关闭"
                width="80%"
                :footer="null"
                height="800px">
            <a-layout-content>
                <a-bpmn-designer height="800px" :actions="actions" @change="onChangeFilePath"></a-bpmn-designer>
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
