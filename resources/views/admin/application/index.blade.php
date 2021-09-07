@extends('admin.base')

@section('content')
    @include('admin.breadcrumb')

    <div class="layui-card">
        <div class="layui-form layui-card-header light-search">
            <form>
                <input type="hidden" name="action" value="search">
            @include('admin.searchField', ['data' => Goodcatch\Modules\Approval\Model\Admin\Application::$searchField])
            <div class="layui-inline">
                <label class="layui-form-label">创建日期</label>
                <div class="layui-input-inline">
                    <input type="text" name="created_at" class="layui-input" id="created_at" value="{{ request()->get('created_at') }}">
                </div>
            </div>
            <div class="layui-inline">
                <button class="layui-btn layuiadmin-btn-list" lay-filter="form-search" id="submitBtn">
                    <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                </button>
            </div>
            </form>
        </div>
        <div class="layui-card-body">
            <table class="layui-table" lay-data="{url:'{{ route ('admin::' . module_route_prefix ('.') . 'approval.application.list') }}?{{ request ()->getQueryString () }}', page:true, limit:50, id:'table', toolbar:'<div><a href=\'{{ route ('admin::' . module_route_prefix ('.') . 'approval.adapter.create') }}\'><i class=\'layui-icon layui-icon-add-1\'></i>新增申请</a></div>'}" lay-filter="table">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, sort: true, event: 'detail', style:'cursor: pointer;'}">ID</th>
                    @include ('admin.listHead', ['data' => Goodcatch\Modules\Approval\Model\Admin\Application::$listField])
                    <th lay-data="{field:'created_at'}">添加时间</th>
                    <th lay-data="{field:'updated_at'}">更新时间</th>
                    <th lay-data="{width:200, templet:'#action'}">操作</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>


@endsection
@include('approval::admin.listHeadTpl', ['data' => Goodcatch\Modules\Approval\Model\Admin\Application::$listField])
@section('js')
<script>
    
    var laytpl = layui.laytpl;
    laytpl.config({
        open: '<%',
        close: '%>'
    });

    var laydate = layui.laydate;
    laydate.render({
        elem: '#created_at',
        range: '~'
    });

    function deleteMenu (url) {
        layer.confirm('确定删除？', function(index){
            $.ajax({
                headers: {'X-CSRF-Token': csrf_token ()},
                url: url,
                type: 'delete',
                success: function (result) {
                    if (result.code !== 0) {
                        layer.msg(result.msg, {shift: 6});
                        return false;
                    }
                    layer.msg(result.msg, {icon: 1}, function () {
                        if (result.reload) {
                            location.reload();
                        }
                        if (result.redirect) {
                            location.href = '{!! url()->previous() !!}';
                        }
                    });
                }
            });

            layer.close(index);
        });
    }

    function submitMenu (url) {
        layer.confirm('确定提交？', function(index){
            $.ajax({
                url: url,
                type: 'get',
                success: function (result) {
                    if (result.code !== 0) {
                        layer.msg(result.msg, {shift: 6});
                        return false;
                    }
                    layer.msg(result.msg, {icon: 1}, function () {
                        if (result.reload) {
                            location.reload();
                        }
                        if (result.redirect) {
                            location.href = result.redirect;
                        }
                    });
                }
            });

            layer.close(index);
        });
    }
    
    function showAppDetail (url, title)
    {
        layer.load();
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            success: function (result) {
                layer.closeAll('loading');
                //页面层
                layer.open({
                    type: 1,
                    title: title,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['100%', '100%'], //宽高
                    content: result
                });
                layuiHandler(function (){layui.element.init();});


            },
            error: function () {
                layer.closeAll('loading');
            }
        });

    }

    layui.use ('table', function () {
        var table = layui.table;
        table.on ('tool(table)', function (obj){
            var data = obj.data;
            if(obj.event === 'detail') {
                showAppDetail (data.detailUrl, '申请详情')
            }
        });
        table.on ('rowDouble(table)', function (obj) {
            var data = obj.data;

            window.location.href = data.editUrl;

        });
    });
</script>

<script type="text/html" id="action">
    <%# if(d.status == 0) { %>
        <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs" title="删除" onclick="deleteMenu('<% d.deleteUrl %>')"><i class="layui-icon layui-icon-delete"></i>删除</a>
    <%#  } else if (d.status == 1) { %>

    <%#  } else if (d.status == 2) { %>

    <%#  } else if (d.status == 3) { %>
    <%#  } %>

</script>
<script type="text/html" id="name_tpl">
    <%# if(d.convert_status == 1) { %>
    <a href="javascript:;" class="layui-table-link" onclick="showAppDetail('{{ route ('admin::' . module_route_prefix ('.') . 'approval.application.detail', ['id'=>'#replacement#']) }}'.replace('#replacement#', '<% d.id %>'), '<% d.display %>')" title="详情"><i class="layui-icon layui-icon-file"></i><% d.name %></a>
    <%# } else { %>
    <% d.name %>
    <%# } %>

</script>
<script type="text/html" id="project_tpl">
    「<% d.project.department.name %>」 <% d.project.name %>
</script>
<script type="text/html" id="applier_tpl">
    <% d.applier.name %>
</script>
<script type="text/html" id="proxy_tpl">
    <%# if(d.proxy && d.proxy.name) { %>
    <% d.proxy.name %>
    <%# } else { %>
    --
    <%# } %>
</script>
<script type="text/html" id="status_tpl">
    <%# if(d.status == 0) { %>
    未提交<span class="layui-badge-dot"></span>
    <%#  } else if (d.status == 1) { %>
    待审批
    <%#  } else if (d.status == 2) { %>
    通过<span class="layui-badge-dot layui-bg-green"></span>
    <%#  } else if (d.status == 3) { %>
    驳回<span class="layui-badge-dot"></span>
    <%#  } %>
</script>
@endsection
