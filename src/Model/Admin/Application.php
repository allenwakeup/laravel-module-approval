<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

class Application extends ApprovalFlow
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];

    protected $casts = [
        'content' => 'array'
    ];

    public static $searchField = [
        'name'       => '编码',
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
        'employee' => [
            'title' => '申请人',
            'width' => 150,
            'sort' => true,
            'templet' => '#applier_tpl'
        ],
        'proxy' => [
            'title' => '代理人',
            'width' => 150,
            'sort' => true,
            'templet' => '#proxy_tpl'
        ],
        'status' => [
            'title' => '审核状态',
            'width' => 80,
            'sort' => true,
            'templet' => '#status_tpl'
        ]
    ];

    public function scopeApproval($query)
    {
        return $query
            ->where('status', '>=', self::STATUS_SUBMITTED);
    }

    public function scopeApproved($query)
    {
        return $query
            ->where('status', self::STATUS_APPROVED);
    }


    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 设置申请单的名字。
     *
     * @param  string  $value
     * @return string
     */
    public function setNewNameAttribute($value)
    {
        $this->attributes['name'] = 'AP' . date ('Ymd') . \Auth::user()->id . date ('His') . $value;
    }

    public function hasDirectTeam()
    {
        return false;
    }


}
