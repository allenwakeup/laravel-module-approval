<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

class Adapter extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];

    protected $casts = [
        'payload' => 'array'
    ];

    /**
     * 搜索字段
     *
     * @var array
     */
    public static $searchField = [
        'name' => '名称',
        'description' => '描述'
    ];

    /**
     * 列表字段
     *
     * @var array
     */
    public static $listField = [
        'pid' => [
            'title' => '上一级',
            'width' => 120,
            'sort' => true,
            'templet' => '#pidText'
        ],
        'category' => [
            'title' => '分类',
            'width' => 100,
            'sort' => true,
            'templet' => '#categoryText'
        ],
        'code' => [
            'title' => '编码',
            'width' => 100,
            'sort' => true
        ],
        'group' => [
            'title' => '分组',
            'width' => 100,
            'sort' => true
        ],
        'name' => [
            'title' => '名称',
            'width' => 150,
            'sort' => true
        ],
        'alias' => [
            'title' => '别名',
            'width' => 120,
            'sort' => true
        ],
        'description' => [
            'title' => '描述',
            'width' => 220
        ]
    ];

    public function parent ()
    {
        return $this->belongsTo ('Goodcatch\Modules\Approval\Model\Admin\Project', 'pid');
    }

    public function getPayloadAttribute ($value)
    {
        $value = json_decode ($value, true);
        if (is_null ($value) || is_string($value))
        {
            $value = [];
        }
        return $value;
    }
}
