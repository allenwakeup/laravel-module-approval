<?php
/**
 * Date: 2019/2/25 Time: 16:15
 *
 * @author  Allen <ali@goodcatch.cn>
 * @version v1.0.0
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Staff;
use Goodcatch\Modules\Core\Model\Admin\Department;

class StaffRepository extends BaseRepository
{

    public static function list ($perPage, $condition = [])
    {
        $data = Staff::query ()
            ->with (['department', 'parent.department'])
            ->where (function ($query) use ($condition)
            {
                self::buildQuery ($query, $condition);
            })
            ->orderBy ('id', 'desc')
            ->paginate ($perPage);
        $data->transform (function ($item)
        {
            xssFilter ($item);
            $item->editUrl = route ('admin::' . module_route_prefix ('.') . 'approval.staff.edit', ['id' => $item->id]);
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.staff.delete', ['id' => $item->id]);
            return $item;
        });

        return [
            'code'  => 0,
            'msg'   => '',
            'count' => $data->total (),
            'data'  => $data->items (),
        ];
    }

    public static function selectUser ($perPage, $keyword, $type = 'user')
    {
        $data = \collect ([]);
        if ($type === 'user') {
            $data = Staff::query ()
                ->with ('department')
                ->where ('name', 'like', "%$keyword%")
                ->orderBy ('name', 'asc')
                ->get ();

            if (strlen ($keyword) > 1) {
                $deps = Staff::query ()
                    ->with ('staff')
                    ->where ('name', 'like', "%$keyword%")
                    ->orderBy ('name', 'asc')
                    ->get ();
                if ($deps->count () > 0) {
                    $deps->each (function ($item, $key) use (&$data)
                    {

                        if ($item->staff->count () > 0) {
                            $staff = new Staff;
                            $staff->name = $item->name;
                            $staff->type = 'optgroup';
                            $data->push ($staff);
                            $data = $data->merge ($item->staff);
                        }
                    });
                }
            }
        } else if ($type === 'tag') {
            $columnMapping = ['title' => 'title', 'rank' => 'rank'];

            if ($keyword && array_has ($columnMapping, $keyword)) {
                $columnName = ['title' => 'title', 'rank' => 'rank'] [ $keyword ];
                $data = Staff::query ()
                    ->select ("$columnName as value", "$columnName as name")
                    ->whereNotNull ($columnName)
                    ->groupBy ($columnName)
                    ->orderBy ($columnName, 'asc')
                    ->get ();
            }
        }

        return [
            'code'  => 0,
            'msg'   => '',
            'count' => $data->count (),
            'data'  => $data,
        ];
    }

    public static function add ($data)
    {
        return Staff::query ()->create ($data);
    }

    public static function update ($id, $data)
    {
        return Staff::query ()->where ('id', $id)->update ($data);
    }

    public static function find ($id)
    {
        return Staff::query ()->find ($id);
    }

    public static function delete($id)
    {
        return Staff::destroy($id);
    }

    public static function findByAdminUser ($admin_user)
    {
        return Staff::query ()->where ('admin_user_id', $admin_user)->first ();
    }
}
