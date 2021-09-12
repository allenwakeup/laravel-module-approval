@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')
        @php
            $is_super_admin = \Auth::guard('admin')->user()->isSuperAdmin ();
            $menu_adapter = $menu->find ('admin::' . module_route_prefix ('.') . 'approval.adapter.create');
            $menu_staff = $menu->find ('admin::' . module_route_prefix ('.') . 'approval.staff.create');
        @endphp
        <div class="layui-card-body">
            <form class="layui-form" lay-filter="myform"
                  action="@if(isset($id)){{ route ('admin::' . module_route_prefix ('.') . 'approval.application.update', ['id' => $id]) }}@else{{ route ('admin::' . module_route_prefix ('.') . 'approval.application.save') }}@endif"
                  method="post">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div class="layui-input-block">
                        <input type="radio"
                               name="type"
                               value=""
                               title="本人申请"
                               lay-filter="radio-type"
                               @if((isset($id) && empty($model->staff_id)) || !isset($id)) checked="" @endif>
                        <input type="radio"
                               name="type"
                               value="proxy_staff_id"
                               title="代理申请"
                               lay-filter="radio-type"
                               @if(isset($id) && !empty($model->proxy_staff_id)) checked="" @endif>
                    </div>
                </div>
                <div class="layui-form-item related-to-user"
                     @if((isset($id) && empty($model->proxy_staff_id)) || !isset($id)) style="display:none;" @endif>
                    <label class="layui-form-label">代理人</label>
                    <div class="layui-input-block">
                        <div class="xm-select-staff"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">项目</label>
                @if(isset($project_id))
                    <div class="layui-input-block">
                        <input type="hidden" name="project_id" value="{{ $model->project_id ?? ''  }}">
                        <input type="text" required readonly value="{{ $model->project ? $model->project->name : '' }}">
                    </div>
                @else
                    <div class="layui-input-block">
                        <div class="xm-select-project"></div>
                    </div>
                @endif
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formApplication" id="submitBtn">提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var form = layui.form;

        //监听提交
        form.on('submit(formApplication)', function (data) {
            window.form_submit = $('#submitBtn');
            form_submit.prop('disabled', true);
            $.ajax({
                url: data.form.action,
                data: data.field,
                success: function (result) {
                    if (result.code !== 0) {
                        form_submit.prop('disabled', false);
                        layer.msg(result.msg, {shift: 6});
                        return false;
                    }
                    layer.msg(result.msg, {icon: 1}, function () {
                        if (result.reload) {
                            location.reload();
                        }
                        if (result.redirect) {
                            location.href = '{!! url ()->previous () !!}';
                        }
                    });
                }
            });

            return false;
        });

        (function () {
            let has_staff_xm = false;
            xmSelect.render ({
                el: '.layui-form .layui-input-block .xm-select-staff',
                prop: {
                    name: 'name',
                    value: 'id',
                },
                radio: true,
                name: 'staff_id',
                autoRow: true,
                clickClose: true,
                delay: 500,
                filterable: true,
                searchTips: '按名称搜索员工',
                empty: '没有更多可选的员工',
                tips: '{{ isset ($model->staff) ? $model->staff->name : '请选择代理人'}}',
                remoteSearch: true,
                remoteMethod: function (val, cb, show) {

                    $.ajax({
                        url: '{{ route('admin::' . module_route_prefix ('.') . 'approval.staff.list') }}?limit=99999&keyword=' + val,
                        type: 'GET',
                        success: function (result) {

                            if (! has_staff_xm)
                            {
                                has_staff_xm = (result.data && result.data.length > 0);
                            }

                            if (has_staff_xm)
                            {
                                @if(isset ($id) && isset ($model->staff_id))
                                result.data.forEach ((d, k)=>{ if ((d.id + '') === '{{ $model->staff_id }}') d.selected = true; });
                                @endif
                                cb (result.data);
                            } else {
                                $ ('.layui-input-inline .xm-select-staff')
                                    .hide ()
                                    .parent ()
                                    @if(isset ($menu_staff) && ($is_super_admin || $user->can($menu_staff->name)))
                                    .append ('<div class="layui-input layui-bg-gray" style="line-height: 35px;"><a class="layui-table-link" href="{{ route ('admin::' . module_route_prefix ('.') . 'approval.staff.create') }}">新增一个员工</a></div>')
                                    @else
                                    .append ('<div class="layui-form-mid layui-word-aux">请联系管理员新增一个员工，然后再新建申请</div>')
                                @endif
                                ;
                            }


                        }
                    });
                },
                on: function(data){
                    if (data.arr.length > 0)
                    {
                        layui.form.val('form', {"code": data.arr [0].code});
                    }
                }
            });

        }) ();

        (function () {
            $.ajax({
                url: '{{ route ('admin::' . module_route_prefix ('.') . 'approval.project.list') }}?limit=99999',
                type: 'GET',
                success: function (project_result) {
                    let project_remote_data = project_result.data;
                    let project_xm = xmSelect.render({
                        el: '.layui-form .layui-input-block .xm-select-project',
                        prop: {
                            name: 'name',
                            value: 'id',
                        },
                        name: 'project_id',
                        theme: {
                            color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                        },
                        filterable: true,
                        searchTips: '按名称搜索审批项目',
                        empty: '没有更多可选的审批项目',
                        tips: '{{ isset ($model->project) ? $model->project->name : '请选择审批项目'}}',
                        template({ item, sels, name, value }){
                            return item.name
                                + '<span style="position: absolute; right: 10px; color: #8799a3">'
                                + (item.value ? item.value : '') + '</span>';
                        },
                        radio: true,
                        autoRow: true,
                        data: project_remote_data,
                        cascader: {
                            show: true,
                            indent: 240,
                            strict: true,
                        },
                        on: function (project_data){

                            if (project_data.arr.length > 0
                                && project_data.arr [0]
                                && project_data.arr [0].children
                                && project_data.arr [0].children.length === 0)
                            {
                                $.ajax({
                                    url: '{{ route ('admin::' . module_route_prefix ('.') . 'approval.project.list') }}',
                                    data: {
                                        limit: 99999
                                        , pid: project_selected.value
                                    },
                                    type: 'GET',
                                    success: function (project_next_result) {
                                        project_selected.children = project_next_result.data;
                                        project_xm.update ({ data: project_remote_data }, false);
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }) ();
    </script>
@endsection
