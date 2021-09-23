<?php


namespace Goodcatch\Modules\Approval\Model\Admin;


class Category extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];

    public function getPathAttribute($val){
        return empty($val) ? [] : explode(',', $val);
    }

    public function getPathTextAttribute($val){
        return empty($this->attributes['path_text']) ? [] : explode(',', $val);
    }

    public function parent()
    {
        return $this->belongsTo('Goodcatch\Modules\Approval\Model\Admin\Category', 'pid');
    }

    public function children()
    {
        return $this->hasMany('Goodcatch\Modules\Approval\Model\Admin\Category', 'pid');
    }

}