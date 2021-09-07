<template>
    <div>
        <div class="layui-tab layui-tab-card" lay-filter="teamtab">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="0">审批组</li>
                <li v-for="(selected,index) in tabs" :lay-id="selected.id + '-' + index">新 {{selected.name}} 审批组</li>

            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <multiselectandsort
                            ref="multiselectandsort"
                            :istree="true"
                            :treereq="treereq"
                            :firstselectreq="firstselectreq"
                            :firstselectlabel="firstselectlabel"
                            :firstselectreqparam="firstselectreqparam"
                            :secondselectreq="secondselectreq"
                            :secondselectlabel="secondselectlabel"
                            :secondselectreqparam="secondselectreqparam"
                            :datareq="datareq"
                            :deletereq="deletereq"
                            :updatereq="updatereq"
                            @add="eventAddTab"></multiselectandsort>
                </div>
                <div class="layui-tab-item" v-for="selected in tabs">
                    <div class="layui-card myform">
                        <div class="layui-card-body">
                            <form class="layui-form" :action="postreq" method="post">
                                <input type="hidden" name="project_id" :value="selected.id">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">所属项目</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="project" :value="selected.name" readonly class="layui-input layui-bg-gray">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">名称</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="name" required  lay-verify="required" autocomplete="off" value="默认审批组" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">适用范围</label>
                                    <div class="layui-input-block">
                                        <input type="radio" lay-filter="condition" :checked="index == 0" v-for="(condition, index) in conditions" name="condition" :value="condition.value" :title="condition.name">
                                    </div>
                                </div>

                                <div class="layui-form-item" v-show="showDept" >
                                    <label class="layui-form-label">部门</label>
                                    <div class="layui-input-block">
                                        <div class="xm-select-departments"></div>
                                    </div>
                                </div>
                                <div class="layui-form-item" v-show="showPeople" >
                                    <label class="layui-form-label">人员</label>
                                    <div class="layui-input-block">
                                        <div class="xm-select-employees"></div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="formTeam" id="submitBtn">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import store from '../store/MultiSelectStore'
    import selection from './SelectComponent'
    import { mapActions } from 'vuex'


    export default {
        name: "Team",
        components: {
            selection
        },
        store,
        props: {
            treereq:{
              type:String
            },
            // 第一级选择数据来源，请求地址
            firstselectreq: {
                type: String
            },
            // 第一级选择点击后传递参数名
            firstselectreqparam:{
                type: String,
                default:'department_id'
            },
            // 第一级选择标题名称
            firstselectlabel: {
                type: String
            },
            // 第二级数据来源，请求地址
            secondselectreq: {
                type: String
            },
            // 第二级选择点击后传递参数名
            secondselectreqparam:{
                type: String,
                default:'project_id'
            },
            // 第二级选择标题名称
            secondselectlabel: {
                type: String
            },
            // 待排序数据来源，请求地址
            datareq: {
                type: String
            },
            updatereq: {
                type: String
            },
            // 新增数据，请求地址
            postreq: {
                type: String
            },
            // 删除数据，请求地址
            deletereq: {
                type: String
            },
            // 选择管理员用户数据源，请求地址
            selectadminuserreq: {
                type: String
            },
            // 选择部门数据源，请求地址
            selectdepartmentreq: {
                type: String
            }
        },
        data() {
            return {
                listLoading: false,
                show_main_tab: true,
                conditions: [
                    {
                        name: '默认部门', value:'default'
                    },
                    {
                        name: '多个部门', value:'departments'
                    },
                    {
                        name: '指定人员', value:'employees'
                    }
                ],
                showDept: false,
                showPeople: false,

            }
        },
        computed: {
            tabs () {
                return this.$store.getters.tabs;
            },

        },
        created () {
            let that = this;
            layuiHandler (() => {
                var form = layui.form;
                form.on('radio(condition)', that.checkCondition);
            })
        },
        methods: {
            ...mapActions(['closeTab']),
            eventAddTab (selected) {


                let that = this;
                that.checkCondition(this.conditions [0]);


                layuiHandler (() => {

                    $('.layui-tab .layui-tab-title li:last-child').click ();

                    var form = layui.form;
                    form.render('radio');


                    //监听提交
                    form.on('submit(formTeam)', function(data){
                        window.form_submit = $('#submitBtn');
                        form_submit.prop('disabled', true);
                        if (data.field [data.field.condition])
                        {
                            that.conditions.forEach(item=>{
                                if (item.value !== data.field.condition)
                                {
                                    delete data.field [item.value]
                                }
                            });
                        }
                        delete data.field.condition
                        $.ajax({
                            url: data.form.action,
                            data: data.field,
                            method:'post',
                            success: function (result) {
                                if (result.code !== 0) {
                                    form_submit.prop('disabled', false);
                                    layer.msg(result.msg, {shift: 6});
                                    return false;
                                }
                                layer.msg(result.msg, {icon: 1}, function () {
                                    if (result.reload) {
                                        that.$refs ['multiselectandsort'].fetchDatalist();
                                        $('.layui-tab .layui-tab-title li:first-child').click ();
                                        that.closeTab();
                                        // location.reload();
                                    }
                                });
                            }

                        });

                        return false;
                    });

                    (function () {

                        let depSel = xmSelect.render ({
                            name: 'departments',
                            el: '.layui-form .layui-input-block .xm-select-departments',
                            prop: {
                                name: 'name',
                                value: 'id',
                            },
                            theme: {
                                color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                            },
                            tips: '数据加载中，请稍后',
                            tree: {
                                show: true,
                                expandedKeys: [ -1 ],
                                lazy: true,
                                load: function (item, cb){
                                    $.ajax ({
                                        url: that.selectdepartmentreq,
                                        data: {
                                            limit: 99999
                                            , type: 'select'
                                            , pid: item.id
                                        },
                                        type: 'GET',
                                        success: function (department_next_result) {
                                            cb (department_next_result.data);
                                        }
                                    });
                                }
                            }
                        });

                        $.ajax({
                            url: that.selectdepartmentreq,
                            type: 'GET',
                            data: {
                                limit: 99999,
                                type: 'select'
                            },
                            success: function (department_result) {
                                let data = department_result.data;
                                let tips = data.length === 0 ? '没有更多可选的部门' : '请选择员工所属部门';
                                depSel.update ({tips, data});
                            }
                        });

                    }) ();

                    (function () {

                        xmSelect.render ({
                            el: '.layui-form .layui-input-block .xm-select-employees',
                            prop: {
                                name: 'name',
                                value: 'id',
                            },
                            radio: true,
                            name: 'employees',
                            theme: {
                                color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                            },
                            filterable: true,
                            searchTips: '按名称搜索人员',
                            empty: '没有更多可选的人员',
                            tips: '请选择人员',
                            autoRow: true,
                            clickClose: true,
                            delay: 500,
                            remoteSearch: true,
                            remoteMethod: function (val, cb, show) {

                                $.ajax({
                                    url: that.selectadminuserreq,
                                    type: 'GET',
                                    data: {
                                        limit: 99999,
                                        keyword: val
                                    },
                                    success: function (result) {
                                        cb (result.data);
                                    }
                                });
                            }
                        });

                    }) ();

                });
            },

            checkCondition (condition) {
                switch (condition.value)
                {
                    case 'default':
                        this.showDept = false;
                        this.showPeople = false;
                        break;
                    case 'departments':
                        this.showDept = true;
                        this.showPeople = false;
                        break;
                    case 'employees':
                        this.showDept = false;
                        this.showPeople = true;
                        break;
                    default:
                        this.showDept = false;
                        this.showPeople = false;
                        break;
                }
            }
        }
    }

</script>

<style scoped lang="scss">


</style>