@extends('admin.base')

@section('content')
    <div class="layui-card">

        @include('admin.breadcrumb')


        <div class="layui-card-body">
            <form class="layui-form" lay-filter="myform"
                  action="@if(isset($id)){{ route ('admin::' . module_route_prefix ('.') . 'approval.application.update', ['id' => $id]) }}@else{{ route ('admin::' . module_route_prefix ('.') . 'approval.application.save') }}@endif"
                  method="post">
                <input type="hidden" name="path" required readonly lay-verify="required"
                       value="{{ $model->path ?? ''  }}">
                @if(isset($id)) {{ method_field('PUT') }} @endif
                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div class="layui-input-block">
                        <input type="radio"
                               name="type"
                               value=""
                               title="本人申请"
                               lay-filter="radio-type"
                               @if((isset($id) && empty($model->proxy_user_id)) || !isset($id)) checked="" @endif>
                        <input type="radio"
                               name="type"
                               value="proxy_user_id"
                               title="代理申请"
                               lay-filter="radio-type"
                               @if(isset($id) && !empty($model->proxy_user_id)) checked="" @endif>
                    </div>
                </div>
                <div class="layui-form-item related-to-user"
                     @if((isset($id) && empty($model->proxy_user_id)) || !isset($id)) style="display:none;" @endif>
                    <label class="layui-form-label">授权人</label>
                    <div class="layui-input-block">
                        <select name="proxy_user_id"
                                xm-select-radio
                                xm-select="proxy_user_id"
                                xm-select-max="1"
                                xm-select-search="{{ route ('admin::' . module_route_prefix ('.') . 'approval.employee.list') }}?type=user"
                                lay-filter="search_proxy_user_id"></select>
                    </div>
                </div>

                @if(isset($project_id))
                    <input type="hidden" name="project_id" required readonly lay-verify="required"
                           value="{{ $project_id}}">
                @else
                    <div class="layui-form-item">
                        <label class="layui-form-label">项目</label>
                        <div class="layui-input-block" style="width: 400px">
                            <select name="project_id" id="project_id" lay-verify="required"
                                    lay-filter="search_project_id">
                                <option value="0">选择部门项目模版</option>
                                @foreach(Goodcatch\Modules\Approval\Repositories\Admin\ProjectRepository::userAllProject() as $v)
                                    <option value="{{ $v->id }}"
                                            @isset($model) @if($v->id == $model->id) selected @endif @endisset>
                                        「{{ $v->department->name}}」 {{$v->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            @endif
            <!-- div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formAdminUser" id="submitBtn">提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div -->
            </form>
        </div>

        <div class="layui-card-body myupload-container" @if(!isset($project_id)) style="display:none;" @endif>
            <div class="layui-form-item">
                <label class="layui-form-label">&nbsp;</label>
                <div class="layui-upload-drag myupload">
                    <i class="layui-icon layui-icon-upload"></i>
                    <p>点击上传，或将文件拖拽到此处</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var form = layui.form;

        @if(isset($project_id))
        var upload_form_data = {project_id: "{{$project_id}}"};
        @else
        var upload_form_data = {};
        @endif


        layui.use('upload', function () {
            var upload = layui.upload;
            //执行实例
            var uploadInst = upload.render({
                elem: '.layui-upload-drag.myupload' //绑定元素
                , url: '{{ route ('admin::' . module_route_prefix ('.') . 'approval.application.upload') }}' //上传接口
                , accept: 'file'
                , multiple: true
                , data: upload_form_data
                , before: function (obj) { //obj参数包含的信息，跟 choose回调完全一致，可参见上文。

                    if (upload_form_data.project_id > 0 && !$('button.layui-btn.myupload').hasClass('layui-btn-disabled')) {
                        var type = $("input[name=type]:checked").val();
                        if (type) {
                            var selected = layui.formSelects.value(type);
                            if (selected && selected.length > 0)
                            {
                                upload_form_data [type] = selected [0].id;
                            }
                        }
                        this.data = upload_form_data;

                        layer.load(); //上传loading
                        $('i.layui-icon.layui-icon-upload').addClass('layui-disabled');
                    }
                }
                , allDone: function (obj) { //当文件全部被提交后，才触发
                    console.log(obj.total); //得到总文件数
                    console.log(obj.successful); //请求成功的文件数
                    console.log(obj.aborted); //请求失败的文件数
                    layer.closeAll('loading'); //关闭loading
                    window.location.href = '{{ route ('admin::' . module_route_prefix ('.') . 'approval.application.index') }}';
                }
                , done: function (res, index, upload) {
                    $('.layui-card-body.myupload-container').append([
                        '<div class="layui-form-item">',
                        '<div class="layui-input-block">',
                        '<div class="layui-form-mid layui-word-aux myupload-word-aux">已上传文件：' + res.data + '</div>',
                        '</div>',
                        '</div>'
                    ].join(''));

                }
                , error: function (e) {
                    layer.closeAll('loading'); //关闭loading
                    $('i.layui-icon.layui-icon-upload').removeClass('layui-btn-disabled');
                }
            });
        });





        form.on('select(search_project_id)', function (data) {

            if (data.value > 0) {
                $('.layui-card-body.myupload-container').fadeIn(200);
                upload_form_data.project_id = data.value;
            } else {
                $('.layui-card-body.myupload-container').fadeOut(200);
                upload_form_data.project_id = 0;
            }


        });


        form.on('radio(radio-type)', function (data) {

            $related_to_user = $('.layui-form-item.related-to-user');
            switch (data.value) {
                case 'proxy_user_id':
                    $related_to_user.fadeIn(100);
                    break;
                default:
                    $related_to_user.fadeOut(100);
                    break;
            }
        });
    </script>
@endsection
