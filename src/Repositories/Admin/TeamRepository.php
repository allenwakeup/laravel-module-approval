<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Employee;
use Goodcatch\Modules\Core\Model\Admin\Department;
use Goodcatch\Modules\Approval\Model\Admin\Team;

class TeamRepository extends BaseRepository
{

    public static function list($perPage, $condition = [], $pid = 0)
    {
        $data = Team::query()
            ->where(function ($query) use ($condition, $pid) {
                self::buildQuery($query, $condition);
                if ($pid > 0)
                {
                    $query->where ('project_id', '=', $pid);
                }
            })
            ->orderBy('order', 'asc')
            ->paginate($perPage);


        $all_departments = Department::find($data->reduce(function ($find, $team){
            if (isset ($team->departments) && !empty ($team->departments))
            {
                $find = array_merge($find, explode(',', $team->departments));
            }
            return $find;
        }, []));
        $all_admin_users = Employee::with('department')->find($data->reduce(function ($find, $team){
            if (isset ($team->admin_users) && !empty ($team->admin_users))
            {
                $find = array_merge($find, explode(',', $team->admin_users));
            }
            return $find;
        }, []));

        $data->transform(function ($item) use ($all_departments, $all_admin_users) {
            $item->editUrl = route ('admin::' . module_route_prefix ('.') . 'approval.team.edit', ['id' => $item->id]);
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.team.delete', ['id' => $item->id]);

            $crews_str = implode(' -> ', $item->crews->pluck('name')->all());
            if (! $crews_str)
            {
                $crews_str = '未设置流程';
            }
            $item->details = '';
            if (isset ($item->departments) && !empty($item->departments))
            {
                $depts = explode(',', $item->departments);
                $item->details .= $all_departments->reduce(function ($str, $dept) use ($depts) {
                    if (in_array('' . $dept->id, $depts))
                    {
                        $str .= $dept->name . '，';
                    }
                    return $str;
                }, '部门适用范围：');
            }
            if (isset ($item->admin_users) && !empty($item->admin_users))
            {
                $users = explode(',', $item->admin_users);
                $item->details .= $all_admin_users->reduce(function ($str, $user) use ($users) {
                    if (in_array('' . $user->id, $users))
                    {
                        $str .= $user->name . '-' . $user->department->name . '，';
                    }
                    return $str;
                }, '指定适用人员：');
            }

            $item->details .= $crews_str;
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
        return Team::query()->create($data);
    }

    public static function update($id, $data)
    {
        return Team::query()->where('id', $id)->update($data);
    }

    public static function find($id)
    {
        return Team::query()->find($id);
    }

    public static function delete($id)
    {
        return Team::destroy($id);
    }
}
