@extends('admin.base')
@section('css')
    <style>
        textarea[name="payload"] {
            min-height: 300px;
        }

    </style>
@endsection
@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')
        @php
            $is_super_admin = \Auth::guard('admin')->user()->isSuperAdmin ();
            // $menu_category = $menu->find ('admin::' . module_route_prefix ('.') . 'approval.category.create');
        @endphp
        <div class="layui-card-body">
            <form class="layui-form" action="@if (isset ($id)){{ route ('admin::' . module_route_prefix ('.') . 'approval.adapter.update', ['id' => $id]) }}@else{{ route ('admin::' . module_route_prefix ('.') . 'approval.adapter.save') }}@endif" method="post">
            @if(isset($id)) {{ method_field('PUT') }} @endif
            <!-- div class="layui-form-item">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-block">
                        <div class="xm-select-category"></div>
                    </div>
                </div -->
                <div class="layui-from-item">
                    <label class="layui-form-label">编码</label>
                    <div class="layui-input-block">
                        <input type="text" name="code" required lay-verify="required" placeholder="英文字母或包含数字的格式，以英文字母开头，长度为10" autocomplete="off" class="layui-input" value="{{ $model->code ?? ''  }}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">上一级</label>
                        <div class="layui-input-inline">
                            <div class="xm-select-adapter"></div>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" required  lay-verify="required" autocomplete="off" class="layui-input" value="{{ $model->name ?? ''  }}">
                        </div>
                    </div>

                </div>


                <div class="layui-form-item">

                    <div class="layui-inline">
                        <label class="layui-form-label">别名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="alias" autocomplete="off" class="layui-input" value="{{ $model->alias ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">分组</label>
                        <div class="layui-input-inline">
                            <input type="text" name="group" autocomplete="off" class="layui-input" value="{{ $model->group ?? ''  }}">
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" autocomplete="off" class="layui-textarea">{{ $model->description ?? ''  }}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">配置</label>
                    <div class="layui-input-block" style="height: 300px">
                        <textarea name="payload" autocomplete="off" class="layui-textarea" lay-verify="required" required>@if(isset($model)) @if(isset ($model->payload)) @json($model->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) @endif @endif</textarea>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="layui-badge">注</span>
                            <a href="javascript:;" class="layui-table-link">格式参考</a>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formAdapter" id="submitBtn">提交</button>
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
        form.on ('submit(formAdapter)', function (data){
            window.form_submit = $ ('#submitBtn');
            form_submit.prop ('disabled', true);
            $.ajax ({
                url: data.form.action,
                data: data.field,
                success: function (result) {
                    if (result.code !== 0) {
                        form_submit.prop ('disabled', false);
                        layer.msg (result.msg, {shift: 6});
                        return false;
                    }
                    layer.msg (result.msg, {icon: 1}, function () {
                        if (result.reload) {
                            location.reload ();
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
            $.ajax({
                url: '{{ route ('admin::' . module_route_prefix ('.') . 'approval.adapter.list') }}?limit=99999',
                type: 'GET',
                success: function (adapter_result) {
                    let adapter_remote_data = adapter_result.data;
                    let adapter_xm = xmSelect.render({
                        el: '.layui-form .layui-input-inline .xm-select-adapter',
                        prop: {
                            name: 'name',
                            value: 'id'
                        },
                        name: 'pid',
                        theme: {
                            color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                        },
                        filterable: true,
                        searchTips: '按名称搜索适配器',
                        empty: '请选择上一级适配器',
                        tips: '{{ isset ($model->parent) ? $model->parent->name : ''}}',
                        template({ item, sels, name, value }){
                            return item.name
                                + '<span style="position: absolute; right: 10px; color: #8799a3">'
                                + (item.value ? item.value : '') + '</span>';
                        },
                        radio: true,
                        autoRow: true,
                        data: adapter_remote_data,
                        cascader: {
                            show: true,
                            indent: 240,
                            strict: true,
                        },
                        on: function (adapter_data){

                            if (adapter_data.arr.length > 0
                                && adapter_data.arr [0]
                                && adapter_data.arr [0].children
                                && adapter_data.arr [0].children.length === 0)
                            {
                                $.ajax({
                                    url: '{{ route ('admin::' . module_route_prefix ('.') . 'approval.project.list') }}',
                                    data: {
                                        limit: 99999
                                        , pid: adapter_selected.value
                                    },
                                    type: 'GET',
                                    success: function (adapter_next_result) {
                                        adapter_selected.children = adapter_next_result.data;
                                        adapter_xm.update ({ data: adapter_remote_data }, false);
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
