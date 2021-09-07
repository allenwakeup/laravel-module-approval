@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')
        <div class="layui-card-body">
            <form class="layui-form" action="@if(isset($id)){{ route ('admin::' . module_route_prefix ('.') . 'approval.employee.update', ['id' => $id]) }}@else{{ route ('admin::' . module_route_prefix ('.') . 'approval.employee.save') }}@endif" method="post">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">编号</label>
                        <div class="layui-input-inline">
                            <input type="text" name="code" required lay-verify="required" placeholder="请输入编号" autocomplete="off" class="layui-input" value="{{ $model->code ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input" value="{{ $model->name ?? ''  }}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">出生日期</label>
                        <div class="layui-input-inline">
                            <input type="text" name="birthday" placeholder="请输入出生日期" autocomplete="off" class="layui-input" value="{{ $model->birthday ?? ''  }}" id="birthday" lay-filter="birthday">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                            <input type="radio" name="gender" value="{{\Goodcatch\Modules\Approval\Model\Admin\Employee::GENDER_MALE}}" title="男" @if(($model->gender ?? -1) === \Goodcatch\Modules\Approval\Model\Admin\Employee::GENDER_MALE)checked=""@endif>
                            <input type="radio" name="gender" value="{{\Goodcatch\Modules\Approval\Model\Admin\Employee::GENDER_FEMALE}}" title="女" @if(($model->gender ?? -1)  === \Goodcatch\Modules\Approval\Model\Admin\Employee::GENDER_FEMALE)checked=""@endif>
                            <input type="radio" name="gender" value="{{\Goodcatch\Modules\Approval\Model\Admin\Employee::GENDER_UNKNOWN}}" title="其他" @if(($model->gender ?? -1)  === \Goodcatch\Modules\Approval\Model\Admin\Employee::GENDER_UNKNOWN)checked=""@endif>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">直接上级</label>
                        <div class="layui-input-inline">
                            <div class="xm-select-pid"></div>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">所属部门</label>
                        <div class="layui-input-inline">
                            <div class="xm-select-department xm-required"></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">电话</label>
                        <div class="layui-input-inline">
                            <input type="text" name="mobile" lay-verify="phone" placeholder="请输入电话号码" autocomplete="off" class="layui-input" value="{{ $model->mobile ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">电子邮件</label>
                        <div class="layui-input-inline">
                            <input type="text" name="email" lay-verify="email" placeholder="请输入电子邮件" autocomplete="off" class="layui-input" value="{{ $model->email ?? ''  }}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">社交账号</label>
                        <div class="layui-input-inline">
                            <input type="text" name="social1" placeholder="请输入社交账号：如QQ号" autocomplete="off" class="layui-input" value="{{ $model->social1 ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">社交账号</label>
                        <div class="layui-input-inline">
                            <input type="text" name="social2" placeholder="请输入社交账号：如微信号" autocomplete="off" class="layui-input" value="{{ $model->social2 ?? ''  }}">
                        </div>
                    </div>

                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">职称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="title" placeholder="请输入职称" autocomplete="off" class="layui-input" value="{{ $model->title ?? ''  }}">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">级别</label>
                        <div class="layui-input-inline">
                            <input type="text" name="rank" placeholder="请输入级别" autocomplete="off" class="layui-input" value="{{ $model->rank ?? ''  }}">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">雇用日期</label>
                        <div class="layui-input-inline">
                            <input type="text" name="hired" placeholder="请输入雇用日期" autocomplete="off" class="layui-input" value="{{ $model->hired ?? ''  }}" id="hired" lay-filter="hired">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">工作日期</label>
                        <div class="layui-input-inline">
                            <input type="text" name="workday" placeholder="请输入工作日期" autocomplete="off" class="layui-input" value="{{ $model->workday ?? ''  }}" id="workday" lay-filter="workday">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否启用</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="status" lay-skin="switch" lay-text="启用|禁用" value="1" @if(isset($model) && $model->status == Goodcatch\Modules\Approval\Model\Admin\Employee::STATUS_ENABLE) checked @endif>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formEmployee" id="submitBtn">提交</button>
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

        layui.use('laydate', function() {
            var laydate = layui.laydate;
            laydate.render({
                elem: '#birthday'
                @if(isset ($model->birthday))
                ,value: '{{$model->birthday}}'
                ,isInitValue: true
                @endif
            });
            laydate.render({
                elem: '#hired'
                @if(isset ($model->hired))
                ,value: '{{$model->hired}}'
                ,isInitValue: true
                @endif
            });
            laydate.render({
                elem: '#workday'
                @if(isset ($model->workday))
                ,value: '{{$model->workday}}'
                ,isInitValue: true
                @endif
            });
        });

        //监听提交
        form.on('submit(formEmployee)', function(data){
            window.form_submit = $('#submitBtn');
            form_submit.prop('disabled', true);

            if (! data.field.status)
            {
                data.field.status = {{Goodcatch\Modules\Approval\Model\Admin\Employee::STATUS_DISABLE}};
            }

            if (! data.field.pid)
            {
                data.field.pid = '0';
            }

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

            let depSel = xmSelect.render ({
                name: 'department_id',
                el: '.layui-form .layui-input-inline .xm-select-department',
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

        })();

        (function () {

            xmSelect.render ({
                el: '.layui-form .layui-input-inline .xm-select-pid',
                prop: {
                    name: 'name',
                    value: 'id',
                },
                radio: true,
                name: 'pid',
                theme: {
                    color: window.GC_XM_SELECT_COLOR || '#1cbbb4',
                },
                filterable: true,
                searchTips: '按名称搜索上级',
                empty: '没有更多可选的上级',
                tips: '{{ isset ($model->parent) ? $model->parent->name : '请选择上级'}}',
                autoRow: true,
                clickClose: true,
                delay: 500,
                remoteSearch: true,
                remoteMethod: function (val, cb, show) {

                    $.ajax({
                        url: '{{ route('admin::' . module_route_prefix ('.') . 'approval.employee.list') }}',
                        type: 'GET',
                        data: {
                            limit: 99999,
                            keyword: val,
                            type: 'user'
                        },
                        success: function (result) {
                            @if(isset ($id) && isset ($model->pid))
                            result.data.forEach (item => { if ((item.id + '') === '{{ $model->pid }}') item.selected = true; });
                            @endif
                            cb (result.data);
                        }
                    });
                }
            });

        }) ();
    </script>
@endsection