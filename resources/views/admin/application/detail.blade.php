@if(isset($model))
    @php
        $user = \Auth::guard('admin')->user();
        $isSuperAdmin = $user->isSuperAdmin();


    @endphp
    @if($isSuperAdmin || $user->canApprovalApplication($model))
        @if($model->status === Goodcatch\Modules\Approval\Model\Admin\Application::STATUS_SUBMITTED && ($model->audits->count() === 0 || $model->audits->filter(function($audit, $akey) use ($user) {
                return $audit->admin_user_id === $user->id;
            })->count() === 0 || $model->audits->filter(function($audit, $akey) use ($user) {
                if ($audit->admin_user_id === $user->id) {
                    return $audit->result === Goodcatch\Modules\Approval\Model\Admin\Audit::RESULT_IN_PROGRESS;
                }
                return false;
            })->count() > 0))
    <div class="layui-card">
        <div class="layui-card-header">审批</div>
        <div class="layui-card-body">
            <button class="layui-btn layui-btn layui-btn-xs" title="通过" onclick="updateMenu('{{ route ('admin::' . module_route_prefix ('.') . 'approval.approvalFlow.update', ['id' => $model->id, 'status' => App\Model\Admin\Audit::RESULT_PASS]) }}', '通过', 1)"><i class="layui-icon layui-icon-face-smile"></i>通过</button>
            <button class="layui-btn layui-btn-danger layui-btn-xs" title="驳回" onclick="updateMenu('{{route ('admin::' . module_route_prefix ('.') . 'approval.approvalFlow.update', ['id' => $model->id, 'status' => App\Model\Admin\Audit::RESULT_DENY])}}', '驳回', 2)"><i class="layui-icon layui-icon-face-cry"></i>驳回</button>
        </div>
    </div>
        @endif
    @endif

    <div class="layui-card">
        <div class="layui-card-header">通用模版</div>
        <div class="layui-card-body">
            内容未做展示
        </div>
    </div>


@else
    <fieldset class="layui-elem-field layui-field-title site-title">
        <legend><a name="docend">权限不够</a></legend>
    </fieldset>
    <div class="site-text">
        <p>请确认您是否是提交人</p>
        <p>或者确认您与该申请表有关联</p>
    </div>
    <div class="layui-elem-quote">
        <p>{{ trans('admin.' . config('app.name')) }} - 用心与你沟通</p>
    </div>
@endif