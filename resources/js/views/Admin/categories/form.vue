<template>
    <div>
        <div class="admin_table_page_title">
            <a-button @click="$router.back()" class="float_right" icon="arrow-left">返回</a-button>
            分类编辑
        </div>
        <div class="unline underm"></div>
        <div class="admin_form">
          <a-form-model ref="form" :model="form" :rules="rules" :label-col="{ span: 6 }"  :wrapper-col="{ span: 16 }">
                <a-form-model-item label="上级分类">
                    <a-cascader :load-data="load_categories"
                                :options="categories"
                                :fieldNames="{ label : 'name', value: 'id', children: 'children' }"
                                :placeholder="(form.pid > 0 && form.path_text) ? form.path_text.join(' / ') : '请选择上级分类'"
                                change-on-select
                                @change="category_change" />
                </a-form-model-item>
                <a-form-model-item label="编码">
                    <a-input v-model="form.code"></a-input>
                </a-form-model-item>
                <a-form-model-item label="名称" prop="name">
                    <a-input v-model="form.name"></a-input>
                </a-form-model-item>
                <a-form-model-item label="简称">
                    <a-input v-model="form.short"></a-input>
                </a-form-model-item>
                <a-form-model-item label="别名">
                    <a-input v-model="form.alias"></a-input>
                </a-form-model-item>
                <a-form-model-item label="描述">
                    <a-textarea v-model="form.description" :auto-size="{ minRows: 3, maxRows: 5 }" />
                </a-form-model-item>
              <a-form-model-item label="排序" prop="order">
                <a-input-number v-model="form.order" :min="0" @change="onChangeOrder" />
              </a-form-model-item>
              <a-form-model-item label="状态">
                <a-switch checked-children="启用" un-checked-children="禁用" :checked="form.status === 1" @change="onChangeStatus"/>
              </a-form-model-item>
                <a-form-model-item :wrapper-col="{ span: 12, offset: 5 }">
                    <a-button type="primary" @click="handleSubmit">提交</a-button>
                </a-form-model-item>
            </a-form-model>

        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: {},
    data() {
      return {
          cascader_category: [],
          form:{
              pid: 0,
              code: '',
              name: '',
              short: '',
              alias: '',
              description: '',
              order: 1,
              status: 1
          },
          rules: {

              code: [
                  {min: 1, max: 20, message: '1到20个字符', trigger: 'blur'},
              ],
              name: [
                  {required: true, message: '请输入分类名称', trigger: 'blur'},
                  {min: 2, max: 10, message: '至少两个字', trigger: 'blur'},
              ]


          },
          categories:[],
          id:0,
      };
    },
    watch: {},
    computed: {},
    methods: {
        handleSubmit() {
            this.$refs.form.validate(valid => {
                if (valid) {
                    let api = this.$apiHandle(this.$api.moduleApprovalCategories, this.id);
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
                        this.$post(api.url, this.info).then(res => {
                            if (res.code === 200 || res.code === 201) {
                                this.$message.success(res.msg)
                                return this.$router.back();
                            } else {
                                return this.$message.error(res.msg)
                            }
                        })
                    }
                } else {
                    this.$message.error('请按要求填写表单！');
                    return false;
                }
            });

        },
        get_form(){
            this.$get(this.$api.moduleApprovalCategories+'/'+this.id).then(res=>{
                this.form = res.data;
            })
        },
        onChangeOrder(value){
            this.form.order = value;
        },
        onChangeStatus(checked){
            this.form.status = checked ? 1 : 0;
        },
        category_change(row,form){
            this.form.pid = row[row.length - 1];
            if(row.length === 0){
                this.form.pid = 0;
            }
        },
        load_categories(selectedOptions){
            const targetOption = selectedOptions[selectedOptions.length - 1];

            targetOption.loading = true;

            const params = {
                pid: targetOption.id,
                data_type: 'select'
            }

            this.$get(this.$api.moduleApprovalCategories, params).then(res=>{
                targetOption.loading = false;
                targetOption.children = res.data;
                this.categories = [...this.categories];
            });
        },
        // 获取列表
        onload(){
            // 判断你是否是编辑
            if(!this.$isEmpty(this.$route.params.id)){
                this.id = this.$route.params.id;
                this.get_form();
            }

            this.$get(this.$api.moduleApprovalCategories, { data_type: 'select' }).then(res=>{

                if(res.code === 200){
                    this.categories = res.data;
                }

            });
        },


    },
    created() {
        this.onload();
    },
    mounted() {}
};
</script>
<style lang="scss" scoped>

</style>
