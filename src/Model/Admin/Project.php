<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

class Project extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];

    public static $searchField = [
        'name' => '名称',
    ];

    public static $listField = [
        'pid' => [
            'title' => '上一级',
            'width' => 120,
            'sort' => true,
            'templet' => '#pidText'
        ],
        'name' => [
            'title' => '名称',
            'width' => 120,
            'sort' => true
        ],
        'department' => [
            'title' => '所属部门',
            'width' => 120,
            'templet' => '#departmentText'
        ],
        'adapter' => [
            'title' => '适配器',
            'width' => 120,
            'templet' => '#adapterText'
        ],
        'order' => [
            'title' => '排序',
            'width' => 80
        ]
    ];

    public function department ()
    {
        return $this->belongsTo ('Goodcatch\Modules\Core\Model\Admin\Department', 'department_id');
    }

    public function teams ()
    {
        return $this->hasMany ('Goodcatch\Modules\Approval\Model\Admin\Team', 'project_id');
    }

    public function parent ()
    {
        return $this->belongsTo ('Goodcatch\Modules\Approval\Model\Admin\Project', 'pid');
    }

    public function children ()
    {
        return $this->hasMany ('Goodcatch\Modules\Approval\Model\Admin\Project', 'pid');
    }

    public function adapter ()
    {
        return $this->hasOne ('Goodcatch\Modules\Approval\Model\Admin\Adapter', 'id', 'adapter_id');
    }

    /**
     * 审批小组节点
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function crews ()
    {
        return $this->hasManyThrough ('Goodcatch\Modules\Approval\Model\Admin\Crew', 'Goodcatch\Modules\Approval\Model\Admin\Team', 'project_id', 'team_id', 'id', 'id');
    }

    public function sortedteams ()
    {
        return $this->teams->sortBy (function ($team, $key)
        {
            return $team->sort;
        });
    }

    public function isEmployeeInCrews ($employee, $application = null)
    {
        foreach ($this->crews as $crew) {
            if ($crew->isBelongToCrew ($employee, $application)) {
                return true;
            }
        }
        return false;
    }

}
