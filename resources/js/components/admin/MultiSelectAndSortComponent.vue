<template>
    <div class="layui-container">
        <div class="layui-row">
            <div class="layui-col-md3">

                <tree v-if="istree" :all="treedata" :url="treereq" :title="firstselectlabel" @handleclick="firstselectChange"></tree>
                <div v-if="!istree" class="layui-card">
                    <div class="layui-card-header">{{firstselectlabel}}</div>
                    <div class="layui-card-body">
                        <table  class="layui-table">
                            <tbody>
                            <tr v-for="(item,index) in firstselectdata" @click="firstselectChange(item)" :class="[firstselected.id === item.id ? 'active' : '']">
                                <td>{{item.name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div v-show="firstselectLoading" class="layui-text loading">加载中</div>
                <div v-show="firstselectdata.length == 0 && !firstselectLoading" class="layui-text loading">没有找到任何数据</div>
            </div>
            <div class="layui-col-md3">
                <div class="layui-card" v-show="firstselected.id">
                    <div class="layui-card-header"><span v-if="firstselected && firstselected.name" style="font-weight: bold;"><i class="layui-icon layui-icon-ok" style="font-size: 1.5em;color:#5FB878"></i>{{firstselected.name}}</span> {{secondselectlabel}}</div>
                    <div class="layui-card-body">
                        <table  class="layui-table">
                            <tbody>
                            <tr v-for="(item,index) in secondselectdata" @click="secondselectChange(item)" :class="[secondselected.id === item.id ? 'active' : '']">
                                <td>{{item.name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div v-show="secondselectLoading" class="layui-text loading">加载中</div>
                <div v-show="secondselectdata.length == 0 && !secondselectLoading" class="layui-text loading">没有找到任何数据</div>
            </div>
            <div class="layui-col-md6 draggable-container"  v-show="secondselected.id">
                <div class="layui-row">
                    <div class="layui-col-md12">

                        <a href="javascript:" @click="add" ><i class='layui-icon layui-icon-add-1'></i>新增</a>


                        <!-- div class="layui-card">
                            <div class="layui-card-body">
                                <div class="layui-form">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">名称</label>
                                        <div class="layui-input-block">
                                            <input type="text" v-model="fieldname" autocomplete="off" class="layui-input">
                                            <button class="layui-btn" @click="add(selected.id, fieldname)">新增</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div -->
                    </div>
                </div>


                <hr class="layui-bg-blue">
                <div v-show="listLoading" class="layui-text loading">
                    正在加载数据...
                </div>
                <div v-show="!listLoading && datalist.length ==  0" class="layui-text loading">
                    还没有任何数据
                </div>
                <draggable v-model="datalist" v-show="! listLoading" @update="updateHandle" @start="startHandle" @end="endHandle" :options="dragOptions" draggable=".drag-list">

                    <transition-group >
                        <div class="layui-row drag-list" v-for="item in datalist" :key="item.id">
                            <div class="layui-col-md12">
                                <div class="layui-card">
                                    <div class="layui-card-header"><span style="font-weight: bold;">{{item.name}}</span>
                                        <button type="button" @click="remove(item)" class="layui-btn layui-btn-primary layui-btn-sm">
                                            <i class="layui-icon">&#xe640;</i>
                                        </button>
                                        <button type="button" @click="update(item)" class="layui-btn layui-btn-sm">
                                            <i class="layui-icon">&#xe642;</i>
                                        </button>
                                    </div>
                                    <div class="layui-card-body">
                                        {{item.details}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </transition-group>


                </draggable>


            </div>
        </div>
    </div>
</template>

<script>

    import draggable from 'vuedraggable'
    import tree from './TreeComponent'
    import { mapActions } from 'vuex'
    export default {
        components: {
            draggable,
            tree
        },
        name: "MultiSelectAndSort",

        props: {
            istree: {
                type: Boolean,
                default: false
            },
            treedata: {
                type: Array
            },
            treereq: {
                type: String
            },
            // 第一级选择数据来源，请求地址
            firstselectreq: {
                type: String
            },
            // 第一级选择点击后传递参数名
            firstselectreqparam: {
                type: String,
                default:'pid'
            },
            // 第一级选择标题名称
            firstselectlabel: {
                type: String
            },
            // 第二级选择点击后传递参数名
            secondselectreqparam: {
                type: String,
                default:'pid'
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
            }

        },
        data() {
            return {
                listLoading: false,
                firstselectLoading: false,
                secondselectLoading: false,
                firstselected: {},
                secondselected: {},
                firstselectdata: [],
                secondselectdata: [],
                datalist: [],
                copydatalist: [],
                dragOptions:{
                    animation: 120,
                    scroll: true,
                    group: 'sortlist',
                    ghostClass: 'ghost-style',
                    chosenClass: 'chosen-style',
                    disabled: false
                },
            }
        },
        created () {
            this.fetchFirstSelectData ();
        },

        methods: {
            ...mapActions(['updateFirstSelect', 'updateSecondSelect']),
            startHandle (event) {
                this.copydatalist = Object.assign ([], this.datalist);
            },

            endHandle (event) {

            },

            updateHandle (event) {
                let ids = [];
                this.datalist.forEach((item,idx) => {
                    ids.push(item.id);
                });
                axios({
                    method: 'put',
                    url: this.updatereq.replace(':id', this.copydatalist [event.oldIndex].id),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    data: 'to=' + ids.join (',')
                }).then(resp=>{


                }).catch(function (error) {
                    this.datalist = this.copydatalist;

                });
            },

            fetchFirstSelectData () {
                this.firstselectLoading = true;
                axios.get(this.firstselectreq).then(resp=>{
                    this.firstselectdata = resp.data.data;
                    if (this.firstselectdata.length == 0)
                    {
                        layer.msg('没有找到数据');
                    }
                    this.firstselectLoading = false
                }).catch(function (error) {
                    this.firstselectdata = [];
                    this.firstselectLoading = false
                });
            },
            firstselectChange (model) {
                if (!this.firstselected.id || model.id !== this.firstselected.id)
                {
                    this.firstselected = model;
                    this.secondselected = {};
                    this.fetchSecondSelectData();
                }

            },
            fetchSecondSelectData () {
                this.secondselectLoading = true;
                let params = {};
                params[this.firstselectreqparam] = this.firstselected.id;
                axios.get(this.secondselectreq, { params: params }).then(resp=>{
                    this.secondselectdata = resp.data.data;
                    if (this.secondselectdata.length == 0)
                    {
                        layer.msg('没有找到数据');
                    }
                    this.secondselectLoading = false
                }).catch(function (error) {
                    this.secondselectdata = [];
                    this.secondselectLoading = false
                });
            },
            secondselectChange (model) {
                if (!this.secondselected.id || model.id !== this.secondselected.id)
                {
                    this.secondselected = model;
                    this.fetchDatalist();
                }

            },

            fetchDatalist () {
                this.datalist = [];
                this.listLoading = true;
                let params = {};
                params[this.secondselectreqparam] = this.secondselected.id;
                axios.get(this.datareq, { params:params }).then(resp=>{
                    this.datalist = resp.data.data;
                    this.listLoading = false
                }).catch(function (error) {
                    this.datalist = [];
                    this.listLoading = false
                });
            },
            add () {

                // multiselectandsortAdd(this.firstselected, this.secondselected);
                this.updateFirstSelect(this.firstselected)
                this.updateSecondSelect(this.secondselected)

                this.$emit('add', this.secondselected)
            },
            update (item){
                let that = this;
                that.copydatalist = that.datalist;
                layer.prompt({title: '修改' + item.name, formType: 0}, function(text, index){
                    if (text)
                    {

                        axios({
                            method: 'put',
                            url: that.updatereq.replace(':id', item.id),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            data: 'name=' + text
                        }).then(resp=>{


                            layer.msg('修改成功');

                            that.fetchDatalist();
                        }).catch(function (error) {
                            that.datalist = that.copydatalist;

                        });

                        layer.close(index);
                    }

                });
            },
            remove (item){
                let that = this;
                that.copydatalist = that.datalist;
                layer.confirm('确定删除' + item.name + '？', function(index){


                    axios({
                        method: 'delete',
                        url: that.deletereq.replace(':id', item.id),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                    }).then(resp=>{


                        layer.msg('删除成功');

                        that.fetchDatalist();
                    }).catch(function (error) {
                        that.datalist = that.copydatalist;

                    });

                    layer.close(index);
                });

            }

        }
    }

</script>

<style scoped lang="scss">
    table {
        tbody {
            tr.active {
                background: #ccc;
            }
        }
    }
    div.draggable-container {
        padding: 15px;
    }
    .layui-text.loading {
        text-align:center;
    }
    .layui-input {
        width:auto;
        display:inline-block;
    }

    .layui-card-header .layui-btn-sm {
        float: right;
        margin-top: 7px;
    }


    .drag-list {
        border: 2px #e1e4e8 solid;
        margin: 10px 0 10px 0;
        list-style: none;
        background-color: #fff;
        border-radius: 6px;
        cursor: move;
        -webkit-transition: border .3s ease-in;
        transition: border .3s ease-in;
    }
    .drag-list:first-child {

        margin: 0px 0 10px 0;


    }

    .drag-list.disabled {
        background-color: #cfcfcf;
        cursor: not-allowed;
        color:#666;
    }
    .drag-list:hover {
        border: 2px solid #20a0ff;
    }
    .chosen-style {
        font-weight: bold;
        box-shadow: inset 0px 0px 20px #5ec9ee;
        -moz-box-shadow: 0px 0px 20px #5ec9ee;
        -webkit-box-shadow: 0px 0px 20px #5ec9ee;
        box-shadow: 0px 0px 20px #5ec9ee;
    }
    .chosen-style.disabled {
        font-weight: normal;
        box-shadow: none;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .drag-title {
        font-weight: 400;
        line-height: 25px;
        margin: 10px 0;
        font-size: 22px;
        color: #1f2f3d;
    }
    .ghost-style{
        display: block;
        color: transparent;
        border-style: dashed
    }

</style>