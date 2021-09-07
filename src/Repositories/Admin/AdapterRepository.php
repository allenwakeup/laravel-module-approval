<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Adapter;

class AdapterRepository extends BaseRepository
{

    public static function list ($perPage, $condition = [], $keyword = null)
    {
        $data = Adapter::query ()
            ->with ('parent')
            ->where (function ($query) use ($condition, $keyword) {
                self::buildQuery ($query, $condition);
                if (! empty ($keyword))
                {
                    self::buildSelect ($query, $condition, $keyword);
                }
            })
            ->orderBy ('id', 'desc')
            ->paginate ($perPage);
        $data->transform (function ($item) {
            $item->editUrl = route ('admin::' . module_route_prefix ('.') . 'approval.adapter.edit', ['id' => $item->id]);
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.adapter.delete', ['id' => $item->id]);
            $item->detailUrl = route ('admin::' . module_route_prefix ('.') . 'approval.adapter.detail', ['id' => $item->id]);
            return $item;
        });

        return [
            'code' => 0,
            'msg' => '',
            'count' => $data->total (),
            'data' => $data->items (),
        ];
    }

    public static function add ($data)
    {
        self::transform (self::TRANSFORM_TYPE_JSON, $data, 'payload');
        return Adapter::query ()->create ($data);
    }

    public static function update ($id, $data)
    {
        self::transform (self::TRANSFORM_TYPE_JSON, $data, 'payload');
        return Adapter::find ($id)->update ($data);
    }

    public static function find ($id)
    {
        return Adapter::query ()->find ($id);
    }

    public static function delete ($id)
    {
        return Adapter::destroy ($id);
    }
}
