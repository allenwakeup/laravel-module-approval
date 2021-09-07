<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Crew;


class CrewRepository extends BaseRepository
{

    public static function list($perPage, $condition = [], $pid = 0)
    {
        $data = Crew::query()
            ->where(function ($query) use ($condition, $pid) {
                self::buildQuery($query, $condition);
                if ($pid > 0)
                {
                    $query->where ('team_id', '=', $pid);
                }
            })
            ->orderBy('order', 'asc')
            ->paginate($perPage);
        $data->transform(function ($item) {
            $item->editUrl = route ('admin::' . module_route_prefix ('.') . 'approval.crew.edit', ['id' => $item->id]);
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.crew.delete', ['id' => $item->id]);
            $item->details = ($item->primaryuser?$item->primaryuser->name : '') . ' ' . ($item->seconduser ? $item->seconduser->name : '') . ' ' . ($item->otheruser? $item->otheruser->name:'');
            return $item;
        });

        return [
            'code' => 0,
            'msg' => '',
            'count' => $data->total(),
            'data' => $data->items(),
        ];
    }

    public static function add($data)
    {
        return Crew::query()->create($data);
    }

    public static function update($id, $data)
    {
        return Crew::query()->where('id', $id)->update($data);
    }

    public static function find($id)
    {
        return Crew::query()->find($id);
    }

    public static function delete($id)
    {
        return Crew::destroy($id);
    }
}
