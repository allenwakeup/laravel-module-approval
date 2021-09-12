<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

class Team extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $guarded = [];


    public static $searchField = [
        'name' => '名称',
    ];

    public static $listField = [
        'name' => '名称',
    ];

    public function project ()
    {
        return $this->belongsTo('Goodcatch\Modules\Approval\Model\Admin\Project', 'project_id');
    }

    public function crews ()
    {
        return $this->hasMany ('Goodcatch\Modules\Approval\Model\Admin\Crew', 'team_id');
    }

    public function sortedCrews ()
    {
        return $this->crews->sortBy (function ($crew, $key) {
            return $crew->order;
        });
    }

}
