<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

/**
 * Class Audit
 *
 * 注意：
 * 所有与Audit一对多的多态关联模型中
 * 必须包含的关系有
 *   belongsTo project
 *   hasMany audits
 * 必须包含有模型属性
 *   status
 *
 * @package App\Model\Admin
 */
class Audit extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    // 未审核
    const RESULT_IN_PROGRESS = 0;
    // 审核通过
    const RESULT_PASS = 1;
    // 驳回
    const RESULT_DENY = 2;

    protected $guarded = [];

    public static $searchField = [
        'name' => '名称',
    ];

    public static $listField = [
        'name' => '名称',
    ];

    protected $casts = [
        'crew' => 'array',
        'user' => 'array'
    ];


    /**
     * 获取拥有此审批结果的模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function auditable ()
    {
        return $this->morphTo ();
    }

    /**
     * Encode the given value as JSON.
     *
     * @param mixed $value
     * @return string
     */
    protected function asJson ($value)
    {
        return json_encode ($value, JSON_UNESCAPED_UNICODE);
    }

    public function operator ()
    {
        return $this->hasOne ('Goodcatch\Modules\Approval\Model\Admin\Staff', 'staff_id');
    }

    /**
     * 当前关联的审批节点
     * crew 字段保存的是快照
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function crewNow ()
    {
        return $this->hasOne ('Goodcatch\Modules\Approval\Model\Admin\Crew', 'id', 'crew_id');
    }

    public function isAbnormal ()
    {
        $snapshot_crew_id = isset ($this->crew) ? $this->crew[ 'id' ] : - 1;
        $snapshot_staff_id = isset ($this->staff) ? $this->staff[ 'id' ] : - 1;
        return $snapshot_crew_id !== $this->crew_id || $snapshot_staff_id !== $this->staff_id;
    }
}
