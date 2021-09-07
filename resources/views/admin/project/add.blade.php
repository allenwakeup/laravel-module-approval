@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')
        @php
            $user = \Auth::guard('admin')->user();
            $isSuperAdmin = $user->isSuperAdmin();
            $menu_adapter = $menu->find ('admin::' . module_route_prefix ('.') . 'approval.adapter.create');
        @endphp
        <div class="layui-card-body">
            <form class="layui-form" action="@if(isset($id)){{ route ('admin::' . module_route_prefix ('.') . 'approval.project.update', ['id' => $id]) }}@else{{ route ('admin::' . module_route_prefix ('.') . 'approval.project.save') }}@endif" method="post">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" required lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->name ?? ''  }}">
                    </div>
                </div>
                @if($isSuperAdmin)
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属部门</label>
                        <div class="layui-input-block">
                            <div class="xm-select-department"></div>
                        </div>
                    </div>
                @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">上一级</label>
                    <div class="layui-input-block">
                        <div class="xm-select-project"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">适配器</label>
                        <div class="layui-input-inline">
                            <div class="xm-select-adapter"></div>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-inline">
                            <input type="number" name="order" required lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->order ?? '0'  }}">
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formProject" id="submitBtn">提交</button>
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
        form.on('submit(formProject)', function(data){
            window.form_submit = $('#submitBtn');
            form_submit.prop('disabled', true);
            if (data.field.type == '0')
            {
                delete data.field.pid
            }
            delete data.field.type
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
                            location.href = '{!! url()->previous() !!}';
                        }
                    });
                }
            });

            return false;
        });

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
                            value: 'id'
                        },
                        name: 'pid',
                        theme: {
                            color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                        },
                        filterable: true,
                        searchTips: '按名称搜索审批项目',
                        empty: '没有更多可选的审批项目',
                        tips: '{{ isset ($model->parent) ? $model->parent->name : '请选择上一级审批项目'}}',
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

        @if($isSuperAdmin)
        (function () {

            let depSel = xmSelect.render ({
                name: 'department_id',
                el: '.layui-form .layui-input-block .xm-select-department',
                prop: {
                    name: 'name',
                    value: 'id',
                },
                theme: {
                    color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                },
                layVerify: 'required',
                layVerType: 'tips',
                tips: '数据加载中，请稍后',
                radio: true,
                clickClose: true,
                tree: {
                    show: true,
                    expandedKeys: [ -1 ],
                    lazy: true,
                    load: function (item, cb){
                        $.ajax ({
                            url: '{{ route ('admin::' . module_route_prefix ('.') . 'core.department.list') }}',
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
                },
                on: function (data) {
                    if (data.isAdd) {
                        return data.change.slice (0, 1);
                    }
                },
            });

            $.ajax({
                url: '{{ route ('admin::' . module_route_prefix ('.') . 'core.department.list') }}',
                type: 'GET',
                data: {
                    limit: 99999,
                    type: 'select'
                },
                success: function (department_result) {
                    let data = [
                        @if(isset ($id) && $model->department_id > 0)
                            selected = {
                            name: "{{ $model->department->name }}",
                            id: {{ $model->department_id }},
                            disabled: true,
                            selected: true
                        }
                        @endif
                    ].concat (department_result.data);
                    let tips = data.length === 0 ? '没有更多可选的部门' : '请选择员工所属部门';
                    depSel.update ({tips, data});
                }
            });

        }) ();
        @endif


        (function () {
            let has_adapter_xm = false;
            xmSelect.render ({
                el: '.layui-form .layui-input-inline .xm-select-adapter',
                prop: {
                    name: 'name',
                    value: 'id',
                },
                theme: {
                    color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                },
                radio: true,
                clickClose: true,
                name: 'adapter_id',
                autoRow: true,
                delay: 500,
                filterable: true,
                remoteSearch: true,
                searchTips: '按名称搜索适配器',
                empty: '没有更多可选的适配器',
                tips: '{{ isset ($model->adapter) ? $model->adapter->name : '请选择适配器'}}',
                remoteMethod: function (val, cb, show) {
                    $.ajax({
                        url: '{{ route('admin::' . module_route_prefix ('.') . 'approval.adapter.list') }}',
                        type: 'GET',
                        data: {
                            limit:99999
                            , keyword: val
                        },
                        success: function (result) {

                            if (! has_adapter_xm)
                            {
                                has_adapter_xm = (result.data && result.data.length > 0);
                            }

                            if (has_adapter_xm)
                            {
                                @if((isset ($id) && isset ($model->adapter_id)) || isset ($model->adapter_id))
                                result.data.forEach ((d, k)=>{ if ((d.id + '') === '{{ $model->adapter_id }}') d.selected = true; });
                                @endif
                                cb (result.data);
                            } else {
                                $ ('.layui-input-inline .xm-select-adapter')
                                    .hide ()
                                    .parent ()
                                    @if(isset ($menu_adapter) && ($isSuperAdmin || $user->can($menu_adapter->name)))
                                    .append ('<div class="layui-input layui-bg-gray" style="line-height: 35px;"><a class="layui-table-link" href="{{ route ('admin::' . module_route_prefix ('.') . 'approval.adapter.create') }}">新增适配器</a></div>')
                                    @else
                                    .append ('<div class="layui-form-mid layui-word-aux">请联系管理员新增项目适配器，然后再新增项目</div>')
                                    @endif
                                ;
                            }

                        }
                    });
                }
            });
        }) ();




    </script>
@endsection
