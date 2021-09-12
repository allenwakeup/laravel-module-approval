<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Application;


class ApplicationRepository extends BaseRepository
{

    public static function list($perPage, $condition = [], $with_content = false)
    {
        $user = \Auth::user();
        $columns = ['id', 'name', 'admin_user_id', 'proxy_staff_id', 'project_id', 'path', 'display', 'convert_status', 'status', 'order', 'created_at', 'updated_at'];
        if ($with_content)
        {
            $columns [] = 'content';
        }
        $data = Application::query()
            ->with(['applier', 'proxy', 'project.department'])
            ->select($columns)
            ->where(function ($query) use ($condition, $user) {
                self::buildQuery($query, $condition);
                if (! $user->isSuperAdmin ())
                {
                    $query->where('admin_user_id', $user->id)
                        ->orWhere('proxy_staff_id', $user->id);
                }
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
        $data->transform(function ($item) {
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.application.delete', ['id' => $item->id]);
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
        return Application::query()->create($data);
    }

    public static function update($id, $data)
    {
        return Application::query()->where('id', $id)->update($data);
    }

    public static function find($id)
    {
        return Application::query()->find($id);
    }

    public static function delete($id)
    {
        return Application::destroy($id);
    }
}
