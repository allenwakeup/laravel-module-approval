<?php

namespace Goodcatch\Modules\Approval\Model\Admin;

abstract class ApprovalFlow extends Model
{
    const STATUS_SUBMITTED = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DENIED = 2;

    const AUDITABLES_MAPPING = [
        'application' => Application::class
    ];

    public static $searchField = [
        'name' => '名称',
        'status'     => [
            'showType'   => 'select',
            'searchType' => '=',
            'title'      => '状态',
            'enums'      => [
                self::STATUS_SUBMITTED => '已提交',
                self::STATUS_APPROVED => '已审批',
                self::STATUS_DENIED => '已驳回',
            ],
        ]
    ];

    public static $listField = [
        'name' => [
            'title' => '编码',
            'width' => 120,
            'sort' => true,
            'templet' => '#name_tpl'
        ],
        'project' => [
            'title' => '所属部门项目（模版）',
            'width' => 150,
            'sort' => true,
            'templet' => '#project_tpl'
        ],
        'staff' => [
            'title' => '申请人',
            'width' => 150,
            'sort' => true,
            'templet' => '#applier_tpl'
        ],
        'status' => [
            'title' => '审核状态',
            'width' => 80,
            'sort' => true,
            'templet' => '#status_tpl'
        ]
    ];

    /**
     * 审批状态为已提交等待审批
     *
     * @param $query
     * @return mixed
     */
    public abstract function scopeApproval ($query);

    /**
     * 审批状态为已审批，包含审批通过和驳回
     *
     * @param $query
     * @return mixed
     */
    public abstract function scopeApproved($query);


    public function applier ()
    {
        return $this->belongsTo('Goodcatch\Modules\Approval\Model\Admin\Staff', 'staff_id');
    }

    public function proxy ()
    {
        return $this->belongsTo('Goodcatch\Modules\Approval\Model\Admin\Staff', 'proxy_staff_id');
    }

    public function project ()
    {
        return $this->belongsTo('Goodcatch\Modules\Approval\Model\Admin\Project', 'project_id');
    }

    public function attachments ()
    {
        return $this->morphMany('Goodcatch\Modules\Core\Model\Admin\Attachment', 'attachable');
    }

    /**
     * 审批流程结果
     */
    public function audits ()
    {
        return $this->morphMany('Goodcatch\Modules\Approval\Model\Admin\Audit', 'auditable');
    }

    /**
     * 当前用户相关对审批流程结果
     * 注：平时不要调用，需要查询与用户本身相关的审计时，适用回调再进行过滤
     */
    public function userRelevantAudits ()
    {
        return $this->morphMany('Goodcatch\Modules\Approval\Model\Admin\Audit', 'auditable');
    }

    public function hasAbnormalAudit ()
    {
        return $this->audits->filter(function ($audit, $key) {return $audit->isAbnormal(); })->count() > 0;
    }

    public function addNote ($note)
    {
        if ($this->content)
        {
            $content = $this->content;
            if (! array_key_exists('note', $content))
            {
                $content ['note'] = [];
            }
            $content ['note'] [] = $note;
            $this->content = $content;
        }
    }


    /**
     * 申请属于当前登录用户
     * @return bool
     */
    public function isBelongToStaff ($staff)
    {
        return isset ($staff) && $staff->id === $this->applier->id;
    }

    /**
     * 申请代理人属于当前登录用户
     * @return bool
     */
    public function isBelongToProxy ($staff)
    {
        if (isset ($staff) && isset ($this->proxy))
        {
            return $this->proxy->id === $staff->id;
        }
        return false;
    }

    public abstract function hasDirectTeam ();

    /**
     * 查询指定用户在当前审批环节中是否可以审批
     *
     * @param $user
     * @return bool
     */
    public function isUserReady ($user)
    {
        if (isset ($user))
        {
            /*
             * 旧的算法
             *
            // 准备收集不同审批组中的审批环节
            $ready = collect([]);
            foreach ($this->project->sortedteams() as $team)
            {
                $last_crew = null;
                foreach($team->sorted_crews as $crew)
                {
                    // 用户必须符合审批环节的身份条件
                    if ($crew->isBelongToCrew ($user, $this))
                    {
                        $ready->push([
                            'order'=>$crew->order,
                            'curr'=>$crew->id,
                            'last'=>(isset ($last_crew) ? $last_crew->id:null)
                        ]);
                        break;
                    }
                    $last_crew = $crew;
                }
            }

            // 查询排在各审批组中最靠前的环节
            $first_priority = $ready->orderBy(function($item, $key) {
                return $item['order'];
            })->first();
            // 当前最靠前环节是否有前置环节
            $last_or_curr = array_has($first_priority, 'last');
            if ($last_or_curr)
            {
                $first_priority_crew_id = $first_priority ['last'];
            } else {
                $first_priority_crew_id = $first_priority ['curr'];
            }

            // 查询审批结果中对应最靠前的当前环节或当前环节的前置环节是否可以继续当前环节的审批
            $filtered = $this->audits->filter(function ($audit, $akey) use ($last_or_curr, $first_priority_crew_id) {
                if ($audit->crew_id === $first_priority_crew_id)
                {
                    if ($last_or_curr)
                    {
                        // 有前置节点 前置节点必须已做审批通过
                        return $audit->result === self::RESULT_PASS;
                    } else {

                        // 没有前置节点 当前节点必须还没做过审批
                        return $audit->result === self::RESULT_IN_PROGRESS;
                    }
                }

                return false;
            });
            return $filtered->count() > 0;
            */

            /*
             * 新的算法
             *
             */
            // 该申请的所有审批组的审批节点
            if ($this->hasDirectTeam())
            {
                $crews = $this->teamnow->crews;
            } else {
                $crews = $this->project->crews;
            }
            if ($crews && $crews->count () > 0) {
                $curr_crew = null;
                $prev_crew = null;
                $crews = $crews->sortBy(function ($item, $key) {
                    return $item->order;
                });
                // 寻找当前用户在所有审批组最靠前的位置
                foreach ($crews as $crew) {
                    if ($crew->isBelongToCrew($user, $this)) {
                        $curr_crew = $crew;
                        break;
                    }
                    $prev_crew = $crew;
                }
                $curr_found = isset ($curr_crew);
                if ($curr_found)
                {
                    $first_priority_crew_id = $curr_crew->id;
                } else {
                    // 不在审批组里
                    return false;
                }
                // 有前置节点
                $last_or_curr = isset ($prev_crew);
                $this_audits = $this->audits;
                // 如果没有前置节点, 并且没有查询或审批，可以直接审批操作
                if ($curr_found && ! $last_or_curr && $this_audits->count() < 1)
                {
                    return true;
                }
                // 继续深入判断，找到前置节点
                if ($last_or_curr)
                {
                    $first_priority_crew_id = $prev_crew->id;
                }
                // 对找到的节点进行状态检查
                if (isset ($first_priority_crew_id))
                {

                    $filtered = $this_audits->filter(function ($audit, $akey) use ($last_or_curr, $first_priority_crew_id) {
                        if ($audit->crew_id === $first_priority_crew_id)
                        {
                            if ($last_or_curr)
                            {
                                // 有前置节点 前置节点必须已做审批通过
                                return $audit->result === Audit::RESULT_PASS;
                            } else {

                                // 没有前置节点 当前节点必须还没做过审批
                                return $audit->result === Audit::RESULT_IN_PROGRESS;
                            }
                        }

                        return false;
                    });
                    return $filtered->count() > 0;
                }
            }
        }

        return false;
    }
}
