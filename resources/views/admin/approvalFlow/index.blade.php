@extends('admin.base')

@section('content')
    @include('admin.breadcrumb')

    <div class="layui-card">
        <div class="layui-form layui-card-header light-search">
            <form>
                <input type="hidden" name="action" value="search">
            @include('admin.searchField', ['data' => Goodcatch\Modules\Approval\Model\Admin\ApprovalFlow::$searchField])
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
            <table class="layui-table" lay-data="{url:'{{ route ('admin::' . module_route_prefix ('.') . 'approval.approvalFlow.list') }}?auditable=application&{{ request ()->getQueryString () }}', page:true, limit:50, id:'table', toolbar:''}" lay-filter="table">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, sort: true, event: 'detail', style:'cursor: pointer;'}">ID</th>
                    @include ('admin.listHead', ['data' => Goodcatch\Modules\Approval\Model\Admin\Adapter::$listField])
                    <th lay-data="{field:'created_at'}">添加时间</th>
                    <th lay-data="{field:'updated_at'}">更新时间</th>
                    <th lay-data="{width:200, templet:'#action'}">操作</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>


@endsection

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

    function updateMenu (url, actionName, status) {
        layer.prompt({
            title: '确定' + actionName + '？',
            formType: 2,
            maxlength: 200,
            value: actionName
        }, function(text, index){
            var put_data = {'_method': 'PUT', status};
            if (text)
            {
                put_data ['note'] = text;
            }
            $.ajax({
                url: url,
                type: 'put',
                data: put_data,
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

    function showDetail (url, title)
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
    <%# if (d.audits.length == 0 || (d.audits.length > 0 && d.audits [0].result == 0)) { %>
    <a href="javascript:;" class="layui-btn layui-btn layui-btn-xs" title="通过" onclick="updateMenu('<% d.approvalUrl %>', '同意', {{ Goodcatch\Modules\Approval\Model\Admin\Audit::RESULT_PASS }})"><i class="layui-icon layui-icon-face-smile"></i>通过</a>
    <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs" title="驳回" onclick="updateMenu('<% d.denyUrl %>', '驳回', {{ Goodcatch\Modules\Approval\Model\Admin\Audit::RESULT_DENY }})"><i class="layui-icon layui-icon-face-cry"></i>驳回</a>
    <%# } %>
</script>
<script type="text/html" id="name_tpl">
    <%# if(d.convert_status == 1 || typeof d.convert_status == 'undefined') { %>
    <a href="javascript:;" class="layui-table-link" onclick="showDetail('<% d.detailUrl %>')" title="详情"><i class="layui-icon layui-icon-file"></i><% d.name %></a>
    <%#  } %>
</script>
<script type="text/html" id="project_tpl">
    「<% d.project.department.name %>」 <% d.project.name %>
</script>
<script type="text/html" id="applier_tpl">
    <% d.applier.name %>
</script>
<script type="text/html" id="status_tpl">
    <%# if (d.user_relevant_audits.length > 0) { %>
        <%# if (d.user_relevant_audits[0].result == 1) { %>
    我已审批通过
        <%#  } else if (d.user_relevant_audits[0].result == 2) { %>
    我已驳回
        <%#  } else { %>
    待我审批
        <%# } %>
    <%#  } else { %>
    待审批
    <%# } %>
</script>
@endsection
