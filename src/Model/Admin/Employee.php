<?php
/**
 * Date: 2019/2/25 Time: 10:34
 *
 * @author  Allen <ali@goodcatch.cn>
 * @version v1.0.0
 */

namespace Goodcatch\Modules\Approval\Model\Admin;


class Employee extends Model
{


    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;


    const GENDER_UNKNOWN = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    protected $guarded = [];

    protected $guard_name = 'admin';

    public static $searchField = [
        'name'       => '用户名',
        'status'     => [
            'showType'   => 'select',
            'searchType' => '=',
            'title'      => '状态',
            'enums'      => [
                0 => '禁用',
                1 => '启用',
            ],
        ]
    ];

    public static $listField = [
        'pid' => [
            'title' => '直接上级',
            'width' => 120,
            'sort' => true,
            'templet' => '#pidText'
        ],
        'name' => [
            'title' => '员工姓名',
            'width' => 120,
            'sort' => true
        ],
        'department' => [
            'title' => '所属部门',
            'width' => 150,
            'sort' => true,
            'templet' => '#departmentText'
        ],
        'birthday' => [
            'title' => '生日',
            'width' => 150,
            'sort' => true
        ],
        'mobile' => [
            'title' => '电话',
            'width' => 120,
            'sort' => true
        ],
        'email' => [
            'title' => '电子邮件',
            'width' => 150,
            'sort' => true
        ],
        'social1' => [
            'title' => '社交账号',
            'width' => 150,
            'sort' => true
        ],
        'social2' => [
            'title' => '社交账号',
            'width' => 150,
            'sort' => true
        ],
        'social3' => [
            'title' => '社交账号',
            'width' => 150,
            'sort' => true
        ],
        'hired' => [
            'title' => '雇用日期',
            'width' => 150,
            'sort' => true
        ],

        'workday' => [
            'title' => '工作日期',
            'width' => 150,
            'sort' => true
        ],

        'title' => [
            'title' => '职称',
            'width' => 120,
            'sort' => true
        ],
        'rank' => [
            'title' => '职级',
            'width' => 120,
            'sort' => true
        ],
        'gender' => [
            'title' => '性别',
            'width' => 120,
            'sort' => true,
            'templet' => '#genderText'
        ],
        'status' => [
            'title' => '状态',
            'width' => 80,
            'sort' => true,
            'templet' => '#statusText'
        ]
    ];

    public function admin ()
    {
        return $this->hasOne ('Goodcatch\Modules\Lightcms\Model\Admin\AdminUser', 'admin_user_id');
    }

    public function department ()
    {
        return $this->belongsTo ('Goodcatch\Modules\Core\Model\Admin\Department', 'department_id');
    }

    public function parent ()
    {
        return $this->belongsTo ('Goodcatch\Modules\Approval\Model\Admin\Employee', 'pid');
    }

    public function children ()
    {
        return $this->hasMany ('Goodcatch\Modules\Approval\Model\Admin\Employee', 'pid');
    }


    public function getDisplayAttribute ()
    {
        $display = $this->name . '-';

        if ($this->department) {
            $display .= $this->department->name . '-';
        }
        $display .= $this->title;
        if (isset ($this->rank)) {

            $display .= '-' . $this->rank;
        }
        return $display;
    }

    public function isSuperAdmin ($login_user)
    {
        return $this->admin->id === $login_user->id && in_array ($login_user->id, config ('light.superAdmin'));
    }

    public function hasRouteName ($name)
    {
        return $this->findMenuByRoute ($name);
    }

    public function findMenuByRoute ($name)
    {
        foreach ($this->admin->roles as $role) {
            $menu = $role->permissions->first (function ($perm, $key) use ($name)
            {
                return $perm->route === $name;
            });
            if ($menu) {
                return $menu;
            }
        }
        return false;
    }

    /**
     * 查询给定的申请表的申请人是不是自己的下级
     * @param $application
     * @return bool
     */
    public function isApplicationOperatorParentUser ($application)
    {
        if (isset ($application)) {
            $applier = $application->applier;
            if (isset ($applier)) {
                $applier_parent = $application->applier->parent;
                if (isset ($applier_parent)) {
                    return $applier_parent->id === $this->id;
                }
            }
        }
        return false;
    }

    public function canApprovalApplication ($application)
    {
        $can_approvel = $this->can ('更新审批');
        $do_approval_application = isset($application);
        if ($do_approval_application) {
            $do_approval_application = $application->project->isEmployeeInCrews ($this, $application);
        }

        return $can_approvel && $do_approval_application;
    }

}
