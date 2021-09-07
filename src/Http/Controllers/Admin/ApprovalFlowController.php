<?php

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Approval\Http\Requests\Admin\ApprovalFlowRequest;
use Goodcatch\Modules\Approval\Model\Admin\ApprovalFlow;
use Goodcatch\Modules\Approval\Model\Admin\Audit;
use Goodcatch\Modules\Approval\Repositories\Admin\ApprovalFlowRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApprovalFlowController extends BaseController
{
    protected $formNames = ['status', 'note'];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb[] = ['title' => '审批列表', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.approvalFlow.index')];
    }

    /**
     * 审批管理-审批列表
     *
     */
    public function index ()
    {
        $this->breadcrumb[] = ['title' => '审批列表', 'url' => ''];
        return view ('approval::admin.approvalFlow.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批列表数据接口
     *
     * @param Request $request
     * @return array
     */
    public function list (Request $request)
    {
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);

        $data = ApprovalFlowRepository::list ($perPage, $condition, $request->auditable, $request->with_content);

        return $data;
    }

    /**
     * 审批管理-更新审批
     *
     * @param ApprovalFlowRequest $request
     * @param int $id
     * @return array
     */
    public function update (ApprovalFlowRequest $request, $id, $auditable)
    {
        $status = $request->status;

        if (array_has (ApprovalFlow::AUDITABLES_MAPPING, $auditable)) {
            $auditable_class = ApprovalFlow::AUDITABLES_MAPPING [ $auditable ];
            try {
                $auditable_inst = app ()->make ($auditable_class);
                $approval_flow = $auditable_inst::find ($id);
                if ($approval_flow && $approval_flow->status !== $auditable_inst::STATUS_APPROVED) {
                    // 是审批组审批环节中的操作人
                    if ($this->employee->isApplicationOperatorParentUser ($approval_flow) || $approval_flow->project->isEmployeeInCrews ($this->employee)) {
                        // 该申请的所有审批组的审批节点
                        if ($approval_flow->hasDirectTeam ()) // 结案类型
                        {
                            $crews = $approval_flow->teamnow->crews;
                        }
                        else { // 申请类型

                            $crews = $approval_flow->project->crews;
                        }
                        if ($crews && $crews->count () > 0) {
                            $curr_crew = null;
                            $prev_crew = null;
                            $crews = $crews->sortBy (function ($item, $key)
                            {
                                return $item->order;
                            });
                            // 寻找当前用户在所有审批组最靠前的位置
                            foreach ($crews as $crew) {
                                if ($crew->isBelongToCrew ($this->employee, $approval_flow)) {
                                    $curr_crew = $crew;
                                    break;
                                }
                                $prev_crew = $crew;
                            }

                            // 当前用户必须在审批流程中
                            if ($curr_crew) {

                                $audit = Audit::firstOrCreate ([
                                    'auditable_id'   => $approval_flow->id,
                                    'auditable_type' => $auditable_class,
                                    'crew_id'        => $curr_crew->id,
                                    //'crew' => $curr_crew,
                                    'employe_id'     => $this->employee->id,
                                    //'user' => $user,
                                ]);
                                $audit = Audit::find ($audit->id);
                                $do_audit = false;
                                // 有前置节点，查找前置节点是否完成
                                if (isset ($prev_crew)) {
                                    $prev_audits = Audit::where ('auditable_id', $approval_flow->id)
                                        ->where ('auditable_type', $auditable_class)
                                        ->where ('crew_id', $prev_crew->id)->get ();

                                    if (isset ($prev_audits) && $prev_audits->count () > 0 && $prev_audits->filter (function ($item, $key)
                                        {
                                            // 当前环节所有人都审批通过了
                                            return $item->result === Audit::RESULT_PASS;
                                        })->count () === $prev_crew->min ()) {
                                        $do_audit = true;

                                    }
                                }
                                else {
                                    $do_audit = true;
                                }
                                if ($do_audit) {
                                    if ($audit->result === Audit::RESULT_IN_PROGRESS) {
                                        $audit->result = $status;
                                        $audit->crew = $curr_crew;
                                        $audit->employee = $this->employee->toArray ();
                                        $audit->note = $request->note;
                                        return [
                                            'code'   => 0,
                                            'msg'    => '审批完成',
                                            'reload' => $audit->save ()
                                        ];
                                    }
                                    else {
                                        return [
                                            'code'   => 0,
                                            'msg'    => '审批已生效，不得再做更改',
                                            'reload' => false
                                        ];
                                    }
                                }
                            }
                            return [
                                'code'   => 0,
                                'msg'    => '上一环节未完成或已驳回',
                                'reload' => false
                            ];
                        }
                    }
                }
                return [
                    'code'   => 0,
                    'msg'    => '审批失败',
                    'reload' => false
                ];
            }
            catch (QueryException $e) {
                return [
                    'code'     => 1,
                    'msg'      => '编辑失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前申请已存在' : '其它错误'),
                    'redirect' => false
                ];
            }
        }
        else {
            return [
                'code'   => 0,
                'msg'    => '审批失败，没有匹配的审批类型 ' . $auditable,
                'reload' => false
            ];
        }
    }

}
