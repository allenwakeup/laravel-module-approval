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
        'name'       => [
            'searchType' => 'like'
        ]
    ];

    public function getCategoriesAttribute($val){
        return empty($this->attributes['categories']) ? [] : explode(',', $val);
    }

    public function getPathTextAttribute($val){
        return empty($this->attributes['path_text']) ? [] : explode(',', $val);
    }

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
