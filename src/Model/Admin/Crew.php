<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

class Crew extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    /**
     * 审批节点中的审批条件组合
     */
    const CONDITION_PARENT = 'PARENT';           // 上级
    const CONDITION_PEOPLE_ONE = 'PEOPLE_ONE';   // 一人审核
    const CONDITION_PEOPLE_ALL = 'PEOPLE_ALL';   // 所有人都审核
    const CONDITION_TAG = 'TAG';                 // 符合标签的人审核
    const CONDITION_COMBINE_ALL = 'COMBINE_ALL'; // 要么符合标签的人审核，要么至少有一个人审核

    protected $guarded = [];

    public static $searchField = [
        'name' => '名称',
    ];

    public static $listField = [
        'name' => '名称',
    ];

    public function team ()
    {
        return $this->belongsTo ('Goodcatch\Modules\Approval\Model\Admin\Team', 'team_id');
    }

    public function isBelongToCrew ($staff, $application = null)
    {
        return $this->isStaffInCondition ($staff, $application);
    }

    /**
     * 用户是否符合审批身份
     * @param $admin_user
     * @return bool
     */
    public function isStaffInCondition ($staff, $application = null)
    {
        $result = false;
        if (isset ($staff)) {


            switch ($this->condition) {
                case self::CONDITION_PARENT:
                    $result = $staff->isApplicationOperatorParentUser ($application);
                    break;
                case self::CONDITION_PEOPLE_ONE:
                case self::CONDITION_PEOPLE_ALL:
                    $result = $this->isPrimaryStaff ($staff)
                        || $this->isSecondaryStaff ($staff)
                        || $this->isOtherStaff ($staff);
                    break;

                case self::CONDITION_TAG:
                    $result = $this->isUserTitle ($staff)
                        || $this->isUserRank ($staff);
                    break;

                case self::CONDITION_COMBINE_ALL:
                    $result = $this->isPrimaryStaff ($staff)
                        || $this->isSecondaryStaff ($staff)
                        || $this->isOtherStaff ($staff)
                        || $this->isUserTitle ($staff)
                        || $this->isUserRank ($staff);
                    break;
            }
        }
        return $result;
    }

    public function min ()
    {
        $result = 0;
        switch ($this->condition) {
            case self::CONDITION_PARENT:
            case self::CONDITION_PEOPLE_ONE:
                $result = 1;
                break;
            case self::CONDITION_PEOPLE_ALL:
                if ($this->admin_user_primary > 0) {
                    $result ++;
                }
                if ($this->admin_user_secondary > 0) {
                    $result ++;
                }
                if ($this->admin_user_other > 0) {
                    $result ++;
                }
                break;
            case self::CONDITION_TAG:
                if (isset ($this->title) && ! empty (trim ($this->title))) {
                    $result ++;
                }
                if (isset ($this->rank) && ! empty (trim ($this->rank))) {
                    $result ++;
                }
                break;
            case self::CONDITION_COMBINE_ALL:
                if ($this->admin_user_primary > 0) {
                    $result ++;
                }
                if ($this->admin_user_secondary > 0) {
                    $result ++;
                }
                if ($this->admin_user_other > 0) {
                    $result ++;
                }
                if (isset ($this->title)) {
                    $result ++;
                }
                if (isset ($this->rank)) {
                    $result ++;
                }
                break;
        }
        return $result;
    }

    public function primaryuser ()
    {
        return $this->hasOne ('Goodcatch\Modules\Approval\Model\Admin\Staff', 'id', 'staff_primary');
    }

    public function seconduser ()
    {
        return $this->hasOne ('Goodcatch\Modules\Approval\Model\Admin\Staff', 'id', 'staff_secondary');
    }

    public function otheruser ()
    {
        return $this->hasOne ('Goodcatch\Modules\Approval\Model\Admin\Staff', 'id', 'staff_other');
    }

    public function titleusers ()
    {
        return $this->hasMany ('Goodcatch\Modules\Approval\Model\Admin\Staff', 'title', 'title');
    }

    public function rankusers ()
    {
        return $this->hasMany ('Goodcatch\Modules\Approval\Model\Admin\Staff', 'rank', 'rank');
    }

    /**
     * 是否主要审核人
     *
     * @param $staff
     * @return bool
     */
    public function isPrimaryStaff ($staff)
    {
        if (isset ($staff) && isset ($this->primaryuser)) {
            return $this->primaryuser->id === $staff->id;
        }
        return false;
    }

    /**
     * 是否次要审核人
     * @param $staff
     * @return bool
     */
    public function isSecondaryStaff ($staff)
    {
        if (isset ($staff) && isset ($this->seconduser)) {
            return $this->seconduser->id === $staff->id;
        }
        return false;
    }

    /**
     * 是否其他审核人
     * @param $staff
     * @return bool
     */
    public function isOtherStaff ($staff)
    {
        if (isset ($staff) && isset ($this->otheruser)) {
            return $this->otheruser->id === $staff->id;
        }
        return false;
    }

    /**
     * 是否匹配职称
     * @param $staff
     * @return bool
     */
    public function isUserTitle ($staff)
    {
        return isset ($staff) && $this->title === $staff->title;
    }

    /**
     * 是否匹配级别
     * @param $staff
     * @return bool
     */
    public function isUserRank ($staff)
    {
        return isset ($staff) && $this->rank === $staff->rank;
    }

}
