<template>
    <div>
        <div class="admin_table_page_title">

            <a-breadcrumb>
                <a-breadcrumb-item>
                    <a-button v-if="breadcrumb.length > 0" type="link" @click="getList()"><a-icon type="home" />分类列表</a-button>
                    <span v-else>分类列表</span>
                </a-breadcrumb-item>

                <a-breadcrumb-item v-for="b in breadcrumb" :key="b.id">
                    <a-button type="link" @click="onClickName(b)">
                        {{ b.name }}
                    </a-button>
                </a-breadcrumb-item>
            </a-breadcrumb>
        </div>
        <div class="unline underm"></div>



        <div class="admin_table_handle_btn">
            <a-button @click="$router.push('/Admin/goodcatch/m/approval/categories/form')" type="primary" icon="plus">添加</a-button>
            <a-button class="admin_delete_btn" type="danger" icon="delete" @click="del">批量删除</a-button>

        </div>
        <div class="admin_table_list">
            <a-table :columns="columns" :data-source="list" :pagination="false" :row-selection="{ selectedRowKeys: selectedRowKeys, onChange: onSelectChange }" row-key="id">
                <span slot="pid" slot-scope="record">
                    {{ record.path_text ? record.path_text.join(' / ') : '--' }}
                </span>
                <a-button type="link" slot="name" slot-scope="record" @click="onClickName(record)">
                    {{ record.name }}
                </a-button>
                <span slot="type" slot-scope="record">
                    {{ record.type === 0 ? '默认' : '其他' }}
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
                    <a-button icon="edit" @click="$router.push('/Admin/goodcatch/m/approval/categories/form/'+rows.id)">编辑</a-button>
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
              {title:'#',dataIndex:'id',fixed:'left'},
              {title:'上级分类', scopedSlots:{ customRender: 'pid' }},
              {title:'编码',dataIndex:'code'},
              {title:'名称',scopedSlots:{ customRender: 'name' }},
              {title:'简称',dataIndex:'short'},
              {title:'别名',dataIndex:'alias'},
              {title:'描述',dataIndex:'description'},
              {title:'排序',dataIndex:'order'},
              {title:'类型', scopedSlots:{ customRender: 'type' }},
              {title:'状态', scopedSlots:{ customRender: 'status' }},
              {title:'创建时间',dataIndex:'created_at'},
              {title:'更新时间',dataIndex:'updated_at'},
              {title:'操作',fixed:'right',scopedSlots: { customRender: 'action' }},
          ],
          list:[],
          dictionary: {
            status: {
              enabled: '启用',
              disabled: '禁用'
            }
          },
          loading_status: {},
          breadcrumb: []

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
                    this.$delete(this.$api.moduleApprovalCategories+'/'+ids).then(res=>{
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
          this.$put(this.$api.moduleApprovalCategories + '/' + record.id, Object.assign({}, record, {
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
        onClickName(record){
            if(record.path) {
                if(record.path.length > 0){
                    this.breadcrumb = record.path.reduce((breadcrumb, item) => {
                        breadcrumb.push({
                            id: record.path[breadcrumb.length],
                            name: record.path_text[breadcrumb.length],
                            order: breadcrumb.length
                        })
                        return breadcrumb;
                    }, []);
                }else{
                    if(this.breadcrumb.filter(item=>item.id === record.id).length === 0){

                        this.breadcrumb.push(record)
                    }
                }
                this.params = {
                    page:1,
                    per_page:30,
                }
            }else{
                this.breadcrumb = this.breadcrumb.filter(item=>item.order <= record.order);
            }
            this.getList(record.id);
        },
        getList(pid){
            if(!pid){
                this.breadcrumb = [];
            }
            const params = pid ? Object.assign({}, this.params, { pid: pid }) : this.params;
            this.$get(this.$api.moduleApprovalCategories, params).then(res=>{
                this.total = res.data.total;
                this.list = res.data.data;
            });
        },
        onload(){
            this.getList();
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
