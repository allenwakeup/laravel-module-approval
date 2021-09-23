<?php

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Category;

class CategoryRepository extends BaseRepository
{
    public static function list ($perPage, $condition = [], $keyword = null)
    {
        return Category::query()
            ->with (['parent'])
            ->where(function ($query) use ($condition) {
                self::buildQuery($query, $condition);
                if (! empty ($keyword))
                {
                    self::buildSelect ($query, $condition, $keyword);
                }
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public static function add ($data)
    {
        return Category::query ()->create ($data);
    }

    public static function update ($id, $data)
    {
        return Category::find ($id)->update ($data);
    }

    public static function find ($id)
    {
        return Category::query ()->find ($id);
    }

    public static function delete ($id)
    {
        return Category::destroy ($id);
    }

    public static function selectTree ($pid = 0)
    {
        return Category::select('id', 'pid', 'name', 'order')
            ->with ('children')
            ->where('pid', $pid)
            ->get ()
            ->map(function (Category $model){
                $data = $model->toArray ();
                $data ['isLeaf'] = ($model->children->count () === 0);
                unset($data['children']);
                return $data;
            })->sortBy('order');

    }
}