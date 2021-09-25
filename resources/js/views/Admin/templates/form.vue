<template>
    <div>
        <div class="admin_table_page_title">
            <a-button @click="$router.back()" class="float_right" icon="arrow-left">返回</a-button>
            模版编辑
        </div>
        <div class="unline underm"></div>
        <div class="admin_form">
            <a-form-model :model="form" :rules="rules" :label-col="{ span: 6 }"
                          :wrapper-col="{ span: 16 }">
                <a-row :gutter="1">
                    <a-col :span="12">
                        <a-form-model-item label="模版分类">
                            <a-cascader :load-data="load_categories"
                                        :options="categories"
                                        :fieldNames="{ label : 'name', value: 'id', children: 'children' }"
                                        :placeholder="(form.category_id > 0 && form.categories) ? form.categories.join(' / ') : '请选择模版分类'"
                                        change-on-select
                                        @change="categorie_change"/>
                        </a-form-model-item>
                    </a-col>
                </a-row>
                <a-row :gutter="1">
                    <a-col :span="12">
                        <a-form-model-item label="上一级">
                            <a-cascader :load-data="load_templates"
                                        :options="templates"
                                        :fieldNames="{ label : 'name', value: 'id', children: 'children' }"
                                        :placeholder="(form.pid > 0 && form.path_text) ? form.path_text.join(' / ') : '请选择上一级'"
                                        change-on-select
                                        @change="template_change"/>
                        </a-form-model-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-model-item label="状态">
                            <a-switch checked-children="启用" un-checked-children="禁用"
                                      :checked="form.status === 1" @change="onChangeStatus"/>
                        </a-form-model-item>
                    </a-col>
                </a-row>
                <a-row :gutter="1">
                    <a-col :span="12">
                        <a-form-model-item label="编码" prop="code">
                            <a-input v-model="form.code"></a-input>
                        </a-form-model-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-model-item label="名称" prop="name">
                            <a-input v-model="form.name"></a-input>
                        </a-form-model-item>
                    </a-col>
                </a-row>
                <a-row :gutter="1">
                    <a-col :span="12">
                        <a-form-model-item label="别名" prop="alias">
                            <a-input v-model="form.alias"></a-input>
                        </a-form-model-item>
                    </a-col>
                    <a-col :span="12" v-if="id > 0">
                        <a-form-model-item label="BPMN" prop="bpmn">
                            <a-bpmn-input
                                :file="form.bpmn_file || ''"
                                :actions="{ upload: $api.moduleApprovalTemplates + '/upload/' + id, import: $api.moduleApprovalTemplates + '/download/' + id }"
                                :title="(form.path_text ? form.path_text.join(' / ') : '') + form.name + '流程设计器'"
                                @change="onChangeBpmnPath"></a-bpmn-input>
                        </a-form-model-item>
                    </a-col>
                </a-row>


                <a-row :gutter="1">
                    <a-col :span="12">
                        <a-form-model-item label="类型">
                            <a-radio-group v-model="form.type" name="radioGroup" :default-value="0">
                                <a-radio :value="0">默认</a-radio>
                                <a-radio :value="1">其他</a-radio>
                            </a-radio-group>
                        </a-form-model-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-model-item label="分组" prop="group">
                            <a-input v-model="form.group"></a-input>
                        </a-form-model-item>
                    </a-col>
                </a-row>
                <a-row :gutter="1">
                    <a-col :span="12">
                        <a-form-model-item label="描述" prop="description">
                            <a-textarea v-model="form.description"
                                        :auto-size="{ minRows: 3, maxRows: 5 }"/>
                        </a-form-model-item>
                    </a-col>

                </a-row>
                <a-row :gutter="1">

                    <a-col :span="12">
                        <a-form-model-item label="排序" prop="order">
                            <a-input-number v-model="form.order" :min="0" @change="onChangeOrder"/>
                        </a-form-model-item>
                    </a-col>

                </a-row>
                <a-form-model-item :wrapper-col="{ span: 12, offset: 5 }">
                    <a-button type="primary" @click="handleSubmit">提交</a-button>
                </a-form-model-item>
            </a-form-model>
        </div>
    </div>
</template>

<script>

import {ABpmnInput} from '@/components/admin/bpmn'

export default {
    components: {
        ABpmnInput
    },
    props: {},
    data() {
        return {
            form: {
                pid: 0,
                code: '',
                name: '',
                alias: '',
                category_id: 0,
                group: '',
                bpmn_file: '',
                type: 0,
                order: 1,
                status: 1
            },
            rules: {

                code: [
                    {min: 1, max: 20, message: '1到20个字符', trigger: 'blur'},
                ],
                name: [
                    {required: true, message: '请输入名称', trigger: 'blur'},
                    {min: 2, max: 10, message: '至少两个字', trigger: 'blur'},
                ]


            },
            categories: [],
            templates:[],
            id: 0,
        };
    },
    watch: {},
    computed: {},
    methods: {
        handleSubmit() {

            // 验证代码处
            if (this.$isEmpty(this.form.code)) {
                return this.$message.error('编码不能为空');
            }
            if (this.$isEmpty(this.form.name)) {
                return this.$message.error('名称不能为空');
            }

            let api = this.$apiHandle(this.$api.moduleApprovalTemplates, this.id);
            if (api.status) {
                this.$put(api.url, this.form).then(res => {
                    if (res.code === 200) {
                        this.$message.success(res.msg)
                        return this.$router.back();
                    } else {
                        return this.$message.error(res.msg)
                    }
                })
            } else {
                this.$post(api.url, this.form).then(res => {
                    if (res.code === 200 || res.code === 201) {
                        this.$message.success(res.msg)
                        return this.$router.back();
                    } else {
                        return this.$message.error(res.msg)
                    }
                })
            }


        },
        get_form() {
            this.$get(this.$api.moduleApprovalTemplates + '/' + this.id).then(res => {
                this.form = res.data;
            })
        },
        onChangeOrder(value) {
            this.form.order = value;
        },
        onChangeStatus(checked) {
            this.form.status = checked ? 1 : 0;
        },
        onChangeBpmnPath(result) {
            console.log(result);
            this.form.bpmn_file = result.path;
        },
        template_change(row,form){
            this.form.pid = row[row.length - 1];
            if(row.length === 0){
                this.form.pid = 0;
            }
        },
        categorie_change(row, form) {
            this.form.category_id = row[row.length - 1];
            if (row.length === 0) {
                this.form.category_id = 0;
            }
        },
        load_templates(selectedOptions){
            const targetOption = selectedOptions[selectedOptions.length - 1];

            targetOption.loading = true;

            const params = {
                pid: targetOption.id,
                data_type: 'select'
            }

            this.$get(this.$api.moduleApprovalTemplates, params).then(res=>{
                targetOption.loading = false;
                targetOption.children = res.data;
                this.templates = [...this.templates];
            });
        },
        load_categories(selectedOptions) {
            const targetOption = selectedOptions[selectedOptions.length - 1];

            targetOption.loading = true;

            const params = {
                pid: targetOption.id,
                data_type: 'select'
            }

            this.$get(this.$api.moduleApprovalCategories, params).then(res => {
                targetOption.loading = false;
                targetOption.children = res.data;
                this.categories = [...this.categories];
            });
        },
        // 获取列表
        onload() {
            // 判断你是否是编辑
            if (!this.$isEmpty(this.$route.params.id)) {
                this.id = this.$route.params.id;
                this.get_form();
            }

            this.$get(this.$api.moduleApprovalCategories, {data_type: 'select'}).then(res => {

                if (res.code === 200) {
                    this.categories = res.data;
                }

            });

            this.$get(this.$api.moduleApprovalTemplates, { data_type: 'select' }).then(res=>{

                if(res.code === 200){
                    this.templates = res.data;
                }

            });
        },


    },
    created() {
        this.onload();
    },
    mounted() {
    }
};
</script>
<style lang="scss" scoped>

</style>
