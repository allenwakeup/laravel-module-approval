<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Template;

class TemplateRepository extends BaseRepository
{

    public static function list ($perPage, $condition = [], $keyword = null)
    {
        return Template::query ()
            ->with (['parent', 'category'])
            ->where (function ($query) use ($condition, $keyword) {
                self::buildQuery ($query, $condition);
                if (! empty ($keyword))
                {
                    self::buildSelect ($query, $condition, $keyword);
                }
            })
            ->orderBy ('id', 'desc')
            ->paginate ($perPage);

    }

    public static function selectTree ($pid = 0)
    {
        return Template::select('id', 'pid', 'name', 'order')
            ->with ('children')
            ->where('pid', $pid)
            ->get ()
            ->map(function (Template $model){
                $data = $model->toArray ();
                $data ['isLeaf'] = ($model->children->count () === 0);
                unset($data['children']);
                return $data;
            })->sortBy('order');

    }

    public static function add ($data)
    {
        return Template::query ()->create ($data);
    }

    public static function update ($id, $data)
    {
        return Template::find ($id)->update ($data);
    }

    public static function find ($id)
    {
        return Template::query ()->find ($id);
    }

    public static function findWidthCategory ($id)
    {
        return Template::query ()->with(['parent','category'])->find ($id);
    }

    public static function delete ($id)
    {
        return Template::destroy ($id);
    }
}
