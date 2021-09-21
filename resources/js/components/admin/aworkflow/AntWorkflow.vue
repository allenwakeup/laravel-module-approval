<template>
    <div class="components-ant-workflow-editor-container">
        <div class="canvas" ref="canvas"></div>
    </div>
</template>
<script>

    // https://github.com/PL-FE/bpmn-doc/blob/main/README.md
    import BpmnJS from 'bpmn-js/lib/Modeler'

    import propertiesPanelModule from 'bpmn-js-properties-panel'
    import propertiesProviderModule from 'bpmn-js-properties-panel/lib/provider/camunda'
    import camundaModdleDescriptor from 'camunda-bpmn-moddle/resources/camunda'

    import {
        xmlStr
    } from './example.bpmn' // 这里是直接引用了xml字符串

    export default {
        name: "AWorkflow",
        components: {},
        props: {},
        computed: {},
        data() {
            return {};
        },
        watch: {},
        methods: {
            init() {
                // 获取到属性ref为“canvas”的dom节点
                const canvas = this.$refs.canvas
                // 建模
                // https://github.com/bpmn-io/bpmn-io-callbacks-to-promises
                this.bpmnModeler = new BpmnJS({
                    container: canvas,
                    //添加控制板
                    propertiesPanel: {
                        parent: '#js-properties-panel'
                    },
                    additionalModules: [
                        // 右边的属性栏
                        propertiesProviderModule,
                        propertiesPanelModule
                    ],
                    moddleExtensions: {
                        camunda: camundaModdleDescriptor
                    }
                })
                this.createNewDiagram()
            },
            async createNewDiagram() {
                // 将字符串转换成图显示出来
                try {
                    const result = await this.bpmnModeler.importXML(xmlStr);
                    const { warnings } = result;
                    console.log(warnings);
                    this.success();
                } catch (err) {
                    console.log(err.message, err.warnings);
                }
            },
            success() {
                console.log('创建成功!')
            }
        },
        created() {},
        mounted() {
            this.init()

        }
    };
</script>
<style lang="css" scoped src="bpmn-js/dist/assets/diagram-js.css"></style>
<style lang="css" scoped src="bpmn-js/dist/assets/bpmn-font/css/bpmn.css"></style>
<style lang="css" scoped src="bpmn-js/dist/assets/bpmn-font/css/bpmn-codes.css"></style>
<style lang="css" scoped src="bpmn-js/dist/assets/bpmn-font/css/bpmn-embedded.css"></style>
<style lang="css" scoped src="bpmn-js-properties-panel/dist/assets/bpmn-js-properties-panel.css"></style>
<style lang="scss" scoped>
    .components-ant-workflow-editor-container{
        position: relative;
        background-color: #ffffff;
        width: 100%;
        height: 100%;
    }
    .canvas{
        width: 100%;
        height: 100%;
    }
    .panel{
        position: absolute;
        right: 0;
        top: 0;
        width: 300px;
    }
</style>