<template>
    <div class="layui-card">
        <div class="layui-card-header">{{ title }}</div>
        <div class="layui-card-body">
            <div :id="treecontainerid"></div>
        </div>
    </div>

</template>

<script>

    import { mapActions } from 'vuex'

    export default {

        name: "Tree",

        props: {
            all:{
                type:Array
            },
            url:{
                type:String
            },
            title:{
                type:String
            }
        },
        data() {
            return {
                treecontainerid: uuid (),
                data:[],

            }
        },
        created () {
            if (this.all)
            {
                this.data = this.all;
                this.render();
            } else {
                this.fetchSelectData ('');
            }

        },
        methods: {
            // ...mapActions([]),
            fetchSelectData (pid) {
                axios({
                    method: 'get',
                    url: this.url,
                    data:{
                        pid:pid
                    }
                }).then(resp=>{

                    this.data = this.convert(resp.data)

                    this.render();

                }).catch(function (error) {


                });
            },
            render () {
                let that = this
                layuiHandler(function () {
                    layui.tree.render({
                        elem: '#' + that.treecontainerid
                        , data: that.data
                        , click: function (obj) {
                            console.log (obj.elem)
                            that.$emit('handleclick', obj.data)
                        }
                    });
                })
            },
            convert (node){
                let result = [];
                for (let item in node) {
                    let node_item = node [item]
                    if (node_item.name)
                    {
                        let data = {
                            title:node_item.name,
                            name:node_item.name,
                            id:node_item.id
                        };
                        if (node_item.children)
                        {
                            data.children = this.convert(node_item.children);
                        }
                        result.push (data);
                    }
                }
                return result;
            }
        }
    }
</script>

<style scoped lang="scss">


</style>