<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\ApprovalFlow;


class ApprovalFlowRepository extends BaseRepository
{

    public static function list($perPage, $condition = [], $auditable = null, $with_content = false)
    {
        $columns = ['id', 'name', 'admin_user_id', 'proxy_staff_id', 'project_id', 'path', 'display', 'convert_status', 'status', 'order', 'created_at', 'updated_at'];
        if ($with_content)
        {
            $columns [] = 'content';
        }
        if (array_has(ApprovalFlow::AUDITABLES_MAPPING, $auditable))
        {
            $user = \Auth::user();

            $approval_flow_class = ApprovalFlow::AUDITABLES_MAPPING[$auditable];
            $approval_flow = new $approval_flow_class;
            $data = $approval_flow::approval()
                ->with(['applier', 'audits', 'project.department'])
                ->where(function ($query) use ($condition) {
                    self::buildQuery($query, $condition);
                })
                ->orderBy('id', 'desc')
                ->paginate($perPage);
            $data->transform(function ($item) use ($auditable) {
                $item->approvalUrl = route ('admin::' . module_route_prefix ('.') . 'approval.approvalFlow.update', ['id' => $item->id, 'auditable' => $auditable]);
                $item->denyUrl = route ('admin::' . module_route_prefix ('.') . 'approval.approvalFlow.update', ['id' => $item->id, 'auditable' => $auditable]);
                $item->detailUrl = route ('admin::' . module_route_prefix ('.') . 'approval.' . $auditable . '.detail', ['id' => $item->id]);
                return $item;
            });
            // 预加载与对应的申请表的审核结果
            $data->load(['userRelevantAudits'=>function ($query) use ($user){
                $query->where('admin_user_id', $user->id);
            }]);
            $filtered_data = $data->items();
            if (! $user->isSuperAdmin())
            {
                $filtered_data = collect($filtered_data)->filter(function ($item, $key) use ($user) {
                    // 审批申请者可以直接看，当前审批节点的用户可以看
                    return $user->isApplicationOperatorParentUser ($item) || $item->isUserReady($user); // $item->project->isUserInCrews($user);
                });
            }
        }

        return [
            'code' => 0,
            'msg' => '',
            'count' => $data->total(),
            'data' => $filtered_data,
        ];
    }

}
