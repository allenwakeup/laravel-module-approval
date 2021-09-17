<template>
    <div>
        <div class="layui-tab layui-tab-card" lay-filter="crewtab">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="0">审批流程</li>
                <li v-for="(selected,index) in tabs" :lay-id="selected.id + '-' + index">新 {{selected.name}} 审批节点</li>

            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <multiselectandsort
                            ref="multiselectandsort"
                            :firstselectreq="firstselectreq"
                            :firstselectlabel="firstselectlabel"
                            :secondselectreq="secondselectreq"
                            :secondselectlabel="secondselectlabel"
                            :datareq="datareq"
                            :deletereq="deletereq"
                            :updatereq="updatereq"
                            @add="eventAddTab"></multiselectandsort>
                </div>
                <div class="layui-tab-item" v-for="selected in tabs">
                    <div class="layui-card myform">
                        <div class="layui-card-body">
                            <form class="layui-form" :action="postreq" method="post">
                                <input type="hidden" name="team_id" :value="selected.id">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">审批组</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="team" :value="selected.name" readonly class="layui-input">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">名称</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="name" required  lay-verify="required" autocomplete="off" value="二级部门审批" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">规则</label>
                                    <div class="layui-input-block">
                                        <input type="radio" lay-filter="condition" :checked="index == 0" v-for="(condition, index) in conditions" name="condition" :value="condition.value" :title="condition.name">
                                    </div>
                                </div>
                                <div class="layui-form-item" v-show="showPeople" >
                                    <label class="layui-form-label">审批人</label>
                                    <div class="layui-input-block">
                                        <div class="xm-select-people"></div>
                                    </div>
                                </div>
                                <div class="layui-form-item" v-show="showTitle" >
                                    <label class="layui-form-label">职称</label>
                                    <div class="layui-input-block">
                                        <div class="xm-select-title"></div>
                                    </div>
                                </div>
                                <div class="layui-form-item" v-show="showRank" >
                                    <label class="layui-form-label">级别</label>
                                    <div class="layui-input-block">
                                        <div class="xm-select-rank"></div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="formCrew" id="submitBtn">提交</button>
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
    import multiselectandsort from './MultiSelectAndSortComponent'
    import selection from './SelectComponent'
    import { mapActions } from 'vuex'


    export default {
        name: "Crew",
        components: {
            multiselectandsort,
            selection
        },
        store,
        props: {

            // 第一级选择数据来源，请求地址
            firstselectreq: {
                type: String
            },
            // 第一级选择标题名称
            firstselectlabel: {
                type: String
            },
            // 第二级数据来源，请求地址
            secondselectreq: {
                type: String
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
            }
        },
        data() {
            return {
                listLoading: false,
                show_main_tab: true,
                conditions: [
                    {
                        name: '上级', value:'PARENT'
                    },
                    {
                        name: '指定一个审核人', value:'PEOPLE_ONE'
                    },
                    {
                        name: '指定多个审核人', value:'PEOPLE_ALL'
                    },
                    {
                        name: '按标签', value:'TAG'
                    },
                    {
                        name: '混合', value:'COMBINE_OR'
                    }
                ],
                showPeople: false,
                showTitle: false,
                showRank: false
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
                form.on('radio(condition)', that.checkCondition)
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
                    form.on('submit(formCrew)', function(data){
                        window.form_submit = $('#submitBtn');
                        form_submit.prop('disabled', true);
                        switch (data.field.condition)
                        {
                            case 'PARENT':
                                delete data.field.people
                                delete data.field.title
                                delete data.field.rank
                                break;
                            case 'PEOPLE_ONE':
                            case 'PEOPLE_ALL':
                                delete data.field.title
                                delete data.field.rank
                                break;
                            case 'TAG':
                                delete data.field.people
                                break;
                        }
                        $.ajax({
                            headers: {'X-CSRF-Token': csrf_token ()},
                            url: data.form.action,
                            data: data.field,
                            type: 'post',
                            dataType: 'json',
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

                        xmSelect.render ({
                            el: '.layui-form .layui-input-block .xm-select-people',
                            prop: {
                                name: 'name',
                                value: 'id',
                            },
                            radio: true,
                            name: 'people',
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
                                        keyword: val,
                                        type: 'user'
                                    },
                                    success: function (result) {
                                        cb (result.data);
                                    }
                                });
                            }
                        });

                    }) ();


                    (function () {
                        $.ajax({
                            url: that.selectadminuserreq,
                            type: 'GET',
                            data: {
                                limit: 99999,
                                keyword: 'title',
                                type: 'tag'
                            },
                            success: function (result) {
                                xmSelect.render ({
                                    el: '.layui-form .layui-input-block .xm-select-title',
                                    radio: true,
                                    name: 'title',
                                    data: result.data,
                                    theme: {
                                        color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                                    },
                                    filterable: true,
                                    empty: '没有更多可选的职称',
                                    tips: '请选择职称',
                                    autoRow: true,
                                    clickClose: true
                                });
                            }
                        });
                    }) ();

                    (function () {

                        $.ajax({
                            url: that.selectadminuserreq,
                            type: 'GET',
                            data: {
                                limit: 99999,
                                keyword: 'rank',
                                type: 'tag'
                            },
                            success: function (result) {
                                xmSelect.render ({
                                    el: '.layui-form .layui-input-block .xm-select-rank',
                                    radio: true,
                                    name: 'rank',
                                    data: result.data,
                                    theme: {
                                        color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                                    },
                                    filterable: true,
                                    empty: '没有更多可选的级别',
                                    tips: '请选择级别',
                                    autoRow: true,
                                    clickClose: true

                                });
                            }
                        });

                    }) ();

                });
            },

            checkCondition (condition) {
                let peopleSel = xmSelect.get ('.layui-form .layui-input-block .xm-select-people');
                if (peopleSel.length > 0) {
                    peopleSel = peopleSel [0];
                    switch (condition.value)
                    {
                        case 'PEOPLE_ONE':
                            peopleSel.update ({
                                radio: true,
                                clickClose: true,
                                on: function(data){
                                    if(data.isAdd){
                                        return data.change.slice(0, 1)
                                    }
                                },
                            });
                            break;
                        case 'PEOPLE_ALL':
                            peopleSel.update ({
                                radio: false,
                                clickClose: false,
                                on () {}
                            });
                            break;
                    }
                }

                switch (condition.value)
                {
                    case 'PARENT':
                        this.showPeople = false;
                        this.showTitle = false;
                        this.showRank = false;
                        break;
                    case 'PEOPLE_ONE':
                    case 'PEOPLE_ALL':
                        this.showPeople = true;
                        this.showTitle = false;
                        this.showRank = false;
                        break;
                    case 'TAG':
                        this.showPeople = false;
                        this.showTitle = true;
                        this.showRank = true;
                        break;
                    case 'COMBINE_OR':
                        this.showPeople = true;
                        this.showTitle = true;
                        this.showRank = true;
                        break;

                    default:
                        this.showPeople = true;
                        this.showTitle = true;
                        this.showRank = true;
                        break;

                }



            }

        }
    }

</script>

<style scoped lang="scss">


</style>