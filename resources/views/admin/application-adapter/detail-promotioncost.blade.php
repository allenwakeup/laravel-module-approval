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
                    return $audit->result === App\Model\Admin\Audit::RESULT_IN_PROGRESS;
                }
                return false;
            })->count() > 0))
    <div class="layui-card">
        <div class="layui-card-header">审批</div>
        <div class="layui-card-body">
            <button class="layui-btn layui-btn layui-btn-xs" title="通过" onclick="updateMenu('{{ route('admin::approvalFlow.update', ['id' => $model->id, 'auditable' => 'application']) }}', '通过', {{ App\Model\Admin\Audit::RESULT_PASS }})"><i class="layui-icon layui-icon-face-smile"></i>通过</button>
            <button class="layui-btn layui-btn-danger layui-btn-xs" title="驳回" onclick="updateMenu('{{route('admin::approvalFlow.update', ['id' => $model->id, 'auditable' => 'application'])}}', '驳回', {{ App\Model\Admin\Audit::RESULT_DENY }})"><i class="layui-icon layui-icon-face-cry"></i>驳回</button>
        </div>
    </div>
        @endif
    @endif
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            @if(isset($model->content))
                @php
                    $index = 0;
                @endphp
                @foreach($model->content ['data'] as $sheet => $page)
                    @php
                        $index++;
                    @endphp
                    @if(count($page) > 0
                        && (! array_has ($model->content, 'conf.' . $sheet . '.visible')
                        || array_get ($model->content, 'conf.' . $sheet . '.visible')))
                        <li lay-id="{{$index}}" @if($index === 1) class="layui-this" @endif>{{ $sheet }}</li>
                    @endif
                @endforeach
            @endif
            <li lay-id="{{ $index + 1 }}">审批流程</li>
        </ul>
        <div class="layui-tab-content">

            @if(isset($model->content ['data']))
                @php
                    $index = 0;
                @endphp
                @foreach($model->content ['data'] as $sheet => $page)
                    @if(count($page) > 0
                        && (! array_has ($model->content, 'conf.' . $sheet . '.visible')
                        || array_get ($model->content, 'conf.' . $sheet . '.visible')))
                        @php
                            $index++;
                        @endphp
                        <style>
                            .my-layui-bg-orange {
                                background-color: #FFB800!important;
                            }
                            .my-layui-bg-green {
                                background-color: #5FB878!important;
                            }
                        </style>
                        <div class="layui-tab-item @if($index===1) layui-show @endif">
                            <table class="layui-table" lay-size="sm">
                                @if(array_has ($model->content, 'conf.' . $sheet . '.header'))
                                    <thead>
                                    @foreach(array_get($model->content, 'conf.' . $sheet . '.header') as $idx => $headers)
                                        <tr>
                                            @foreach($headers as $th)
                                                <th @if(isset($th['rowspan'])) rowspan="{{ $th['rowspan'] }}" @endif
                                                @if(isset($th['colspan'])) colspan="{{ $th['colspan'] }}" @endif
                                                    @if(isset($th['color'])) class="my-layui-bg-{{ $th['color'] }}" @endif
                                                >
                                                    <div class="layui-table-cell" align="center"
                                                         style="@if(isset($th['type'])) {{ [
                                                         'date'=>'min-width:64px;',
                                                          'datetime'=>'min-width:130px;'
                                                          ] [$th['type']] }} @endif padding:0;height:auto; line-height:12px; white-space: normal;">
                                                        <span>{{ $th['display'] }}</span>
                                                    </div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </thead>
                                @endif
                                <tbody>
                                @if(array_has ($model->content, 'conf.' . $sheet . '.column.mapping'))
                                    @foreach($page as $ridx => $row)
                                        <tr>
                                            @foreach(array_get($model->content, 'conf.' . $sheet . '.column.mapping') as $colKey => $conf)
                                                <td align="center">{{ $row[$colKey] }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($page as $ridx => $row)
                                        <tr>
                                            @foreach($row as $key=>$val)
                                                <td>{{$val}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif


                                </tbody>
                            </table>
                        </div>
                    @endif


                @endforeach
            @endif

            <div class="layui-tab-item">
                <div style="padding: 20px; background-color: #F2F2F2;">
                    <div class="layui-row layui-col-space15">
                        @if(isset($model->project))
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">审批流</div>
                                <div class="layui-card-body">
                                    <div class="layui-tab layui-tab-card">
                                        <ul class="layui-tab-title">

                                            @foreach($model->project->sortedteams() as $tidx => $team)
                                                <li lay-id="team{{ $tidx + 1 }}" @if($tidx==0) class="layui-this" @endif>{{ $team->name }}</li>
                                            @endforeach

                                        </ul>
                                        <div class="layui-tab-content">

                                            @foreach($model->project->sortedteams() as $tidx => $team)
                                                <div class="layui-tab-item @if($tidx==0) layui-show @endif">
                                                    <style>
                                                        .layui-timeline-axis-check {
                                                            background-color: #5FB878;
                                                            color: #fff;
                                                        }
                                                        .layui-timeline-axis-deny {
                                                            background-color: #FF5722;
                                                            color: #fff;
                                                        }
                                                    </style>
                                                    <ul class="layui-timeline">
                                                        <li class="layui-timeline-item">
                                                            @if($model->status === Goodcatch\Modules\Approval\Model\Admin\Application::STATUS_SUBMITTED)
                                                                <i class="layui-icon layui-timeline-axis layui-timeline-axis-check">&#xe605;</i>
                                                            @else
                                                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                                            @endif
                                                            <div class="layui-timeline-content layui-text">
                                                                <h3 class="layui-timeline-title">申请人
                                                                    @if($model->status === Goodcatch\Modules\Approval\Model\Admin\Application::STATUS_SUBMITTED)
                                                                        &nbsp;&nbsp;<span class="layui-badge layui-bg-green">已提交</span>
                                                                    @endif
                                                                </h3>
                                                                <p>{{ $model->applier->name }}</p>
                                                            </div>
                                                        </li>
                                                        @foreach($team->sortedcrews() as $crew)
                                                            <li class="layui-timeline-item">

                                                                @if(isset($audits[$crew->id]))
                                                                    @switch($audits[$crew->id]->result)
                                                                        @case(1)
                                                                        <i class="layui-icon layui-timeline-axis layui-timeline-axis-check">&#xe605;</i>
                                                                        @break
                                                                        @case(2)
                                                                        <i class="layui-icon layui-timeline-axis layui-timeline-axis-deny">&#x1006;</i>
                                                                        @break
                                                                        @default
                                                                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                                                        @break
                                                                    @endswitch
                                                                @endif
                                                                <div class="layui-timeline-content layui-text">
                                                                    <h3 class="layui-timeline-title">{{ $crew->name }}

                                                                        @if(isset($audits[$crew->id]))
                                                                            @switch($audits[$crew->id]->result)
                                                                                @case(0)
                                                                                <!-- &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-badge-rim">未审核</span> -->
                                                                                @break
                                                                                @case(1)
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-badge layui-bg-green">已审批通过</span>
                                                                                @break
                                                                                @case(2)
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-badge">已驳回</span>
                                                                                @break
                                                                            @endswitch
                                                                        @endif

                                                                    </h3>

                                                                    @if($crew->primaryuser)
                                                                        <p>
                                                                            {{ $crew->primaryuser->name }}
                                                                        </p>
                                                                    @endif
                                                                    @if($crew->seconduser)
                                                                        <p>
                                                                            {{ $crew->seconduser->name }}
                                                                        </p>
                                                                    @endif
                                                                    @if($crew->otheruser)
                                                                        <p>
                                                                            {{ $crew->otheruser->name }}
                                                                        </p>
                                                                    @endif
                                                                    <hr class="layui-bg-gray">
                                                                    @if($crew->title)
                                                                        <p>
                                                                            {{ $crew->title }}
                                                                        </p>
                                                                    @endif
                                                                    @if($crew->rank)
                                                                        <p>
                                                                            {{ $crew->rank }}
                                                                        </p>
                                                                    @endif
                                                                    @if(isset($audits[$crew->id]) && isset ($audits[$crew->id]['note']))
                                                                        <p>审批意见：{{ $audits[$crew->id]['note'] }}</p>
                                                                    @endif

                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        @if($model->status === Goodcatch\Modules\Approval\Model\Admin\ApprovalFlow::STATUS_APPROVED)
                                                        <li class="layui-timeline-item">
                                                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                                            <div class="layui-timeline-content layui-text">
                                                                <h3 class="layui-timeline-title">已完成审批</h3>
                                                            </div>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($model->content['note']))
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">审批记录</div>
                                <div class="layui-card-body">
                                    <ul class="layui-timeline">
                                        @foreach($model->content['note'] as $note)
                                        <li class="layui-timeline-item">
                                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                            <div class="layui-timeline-content layui-text">
                                                <p>{{$note}}</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($model->hasAbnormalAudit())
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">异常</div>
                                <div class="layui-card-body">
                                    <ul class="layui-timeline">

                                        @foreach($model->audits as $abn_audit)
                                            <li class="layui-timeline-item">
                                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                                <div class="layui-timeline-content layui-text">
                                                    <h3 class="layui-timeline-title">{{ $abn_audit->crew['name'] }} {{ $abn_audit->crew['updated_at'] }}

                                                        @switch($abn_audit->result)
                                                            @case(0)
                                                            <!-- &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-badge-rim">未审核</span> -->
                                                            @break
                                                            @case(1)
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-badge layui-bg-green">已审批通过</span>
                                                            @break
                                                            @case(2)
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-badge">已驳回</span>
                                                            @break
                                                        @endswitch

                                                    </h3>
                                                    <p>{{ $abn_audit->employee ['name'] }} {{ $abn_audit->employee['updated_at'] }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">编号</div>
                                <div class="layui-card-body">{{ $model->name }}</div>
                            </div>
                        </div>
                            @if(isset($model->display))
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">文件名</div>
                                <div class="layui-card-body">{{ $model->display }}</div>
                            </div>
                        </div>
                            @endif
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">所属项目</div>
                                <div class="layui-card-body">{{ $model->project->name }}</div>
                            </div>
                        </div>
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">所属部门</div>
                                <div class="layui-card-body">{{ $model->project->department->name }}</div>
                            </div>
                        </div>
                        @if(isset($model->applier))
                            <div class="layui-col-md12">
                                <div class="layui-card">
                                    <div class="layui-card-header">负责人</div>
                                    <div class="layui-card-body">
                                        {{$model->applier->name}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($model->proxy))
                            <div class="layui-col-md12">
                                <div class="layui-card">
                                    <div class="layui-card-header">代理人</div>
                                    <div class="layui-card-body">
                                        {{$model->proxy->name}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($model->content['converted_at']))
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">数据转换时间</div>
                                <div class="layui-card-body">
                                    {{$model->content['converted_at']}}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($model->content['last_converted_at']))
                        <div class="layui-col-md12">
                            <div class="layui-card">
                                <div class="layui-card-header">上一次数据转换时间</div>
                                <div class="layui-card-body">
                                    {{$model->content['last_converted_at']}}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>


                </div>
            </div>




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