<template>
    <div>
        <div class="admin_table_page_title">模版列表</div>



        <div class="unline underm"></div>

        <div class="admin_table_handle_btn">
            <a-button @click="$router.push('/Admin/goodcatch/m/approval/templates/form')" type="primary" icon="plus">添加</a-button>
            <a-button class="admin_delete_btn" type="danger" icon="delete" @click="del">批量删除</a-button>
        </div>
        <div class="admin_table_list">
            <a-table :columns="columns" :data-source="list" :pagination="false" :scroll="{ x: 2048 }" :row-selection="{ selectedRowKeys: selectedRowKeys, onChange: onSelectChange }" row-key="id">
                <span slot="pid" slot-scope="record">
                    {{ record.parent ? record.parent.name : '--' }}
                </span>
                <span slot="type" slot-scope="record">
                    {{ record.type === 0 ? '默认' : '其他' }}
                </span>
                <span slot="category" slot-scope="record">
                    {{ (record.categories && record.categories.length > 0) ? record.categories.join (' / ') : '--' }}
                </span>
                <a-switch
                    slot="status"
                    :loading="loading_status['_' + record.id]"
                    @change="onStatusChange(record)"
                    slot-scope="record"
                    :checked-children="dictionary.status.enabled"
                    :un-checked-children="dictionary.status.disabled"
                    :default-checked="record.status === 1" />
                <span slot="action" slot-scope="rows">
                    <a-button icon="edit" @click="$router.push('/Admin/goodcatch/m/approval/templates/form/'+rows.id)">编辑</a-button>
                </span>
            </a-table>
            <div class="admin_pagination" v-if="total>0">
                <a-pagination v-model="params.page" :page-size.sync="params.per_page" :total="total" @change="onChange" show-less-items />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: {},
    data() {
      return {
          params:{
              page:1,
              per_page:30,
          },
          total:0, //总页数
          selectedRowKeys:[], // 被选择的行
          columns:[
              {title:'#',dataIndex:'id',fixed:'left', width: 80},
              {title:'上级', scopedSlots:{ customRender: 'pid' }, width: 120},
              {title:'分类', scopedSlots:{ customRender: 'category' }, width: 220},
              {title:'编码',dataIndex:'code', width: 120},
              {title:'名称',dataIndex: 'name' },
              {title:'分组', dataIndex: 'group', width: 120},
              {title:'类型', scopedSlots:{ customRender: 'type' }, width: 120},
              {title:'排序',dataIndex:'order', width: 90},
              {title:'状态', scopedSlots:{ customRender: 'status' }, width: 120},
              {title:'创建时间',dataIndex:'created_at', width: 120},
              {title:'更新时间',dataIndex:'updated_at', width: 120},
              {title:'操作',fixed:'right',scopedSlots: { customRender: 'action' }},
          ],
          list:[],
          dictionary: {
            status: {
              enabled: '启用',
              disabled: '禁用'
            },
            gender: [
                '默认',
                '男',
                '女',
                '其他'
            ]
          },
          breadcrumb: [],
          loading_status: {}

      };
    },
    watch: {},
    computed: {},
    methods: {
        // 选择框被点击
        onSelectChange(selectedRowKeys) {
            this.selectedRowKeys = selectedRowKeys;
        },
        // 选择分页
        onChange(e){
            this.params.page = e;
        },
        // 删除
        del(){
            if(this.selectedRowKeys.length===0){
                return this.$message.error('未选择数据.');
            }
            this.$confirm({
                title: '你确定要删除选择的数据？',
                content: '确定删除后无法恢复.',
                okText: '是',
                okType: 'danger',
                cancelText: '取消',
                onOk:()=> {
                    let ids = this.selectedRowKeys.join(',');
                    this.$delete(this.$api.moduleApprovalTemplates+'/'+ids).then(res=>{
                        if(res.code === 200){
                            this.onload();
                            this.$message.success('删除成功');
                        }else{
                            this.$message.error(res.msg)
                        }
                    });

                },
            });
        },

        onStatusChange(record) {
          const reverse_status = [1, 0][record.status];
          this.loading_status ['_' + record.id] = true;
          this.$put(this.$api.moduleApprovalTemplates + '/' + record.id, Object.assign({}, record, {
            status: reverse_status,
          })).then(res => {
            this.loading_status ['_' + record.id] = false;
            if (res.code === 200) {
              record.status = reverse_status;
              this.$message.success(res.msg);
            } else {
              return this.$message.error(res.msg);
            }
          }).catch(() => this.loading_status ['_' + record.id] = false);
        },
        onload(){
            this.$get(this.$api.moduleApprovalTemplates,this.params).then(res=>{

                this.total = res.data.total;
                this.list = res.data.data;
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
