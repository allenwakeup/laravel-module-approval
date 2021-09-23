<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

class Template extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];


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
        return $this->belongsTo ('Goodcatch\Modules\Approval\Model\Admin\Template', 'pid');
    }


    public function children()
    {
        return $this->hasMany('Goodcatch\Modules\Approval\Model\Admin\Template', 'pid');
    }

    public function category(){
        return $this->belongsTo ('Goodcatch\Modules\Approval\Model\Admin\Category');
    }

}
