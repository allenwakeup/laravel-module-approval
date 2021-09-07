<?php
/**
 * Date: 2019/2/25 Time: 16:15
 *
 * @author  Allen <ali@goodcatch.cn>
 * @version v1.0.0
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Employee;
use Goodcatch\Modules\Core\Model\Admin\Department;

class EmployeeRepository extends BaseRepository
{

    public static function list ($perPage, $condition = [])
    {
        $data = Employee::query ()
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
            $item->editUrl = route ('admin::' . module_route_prefix ('.') . 'approval.employee.edit', ['id' => $item->id]);
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.employee.delete', ['id' => $item->id]);
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
            $data = Employee::query ()
                ->with ('department')
                ->where ('name', 'like', "%$keyword%")
                ->orderBy ('name', 'asc')
                ->get ();

            if (strlen ($keyword) > 1) {
                $deps = Department::query ()
                    ->with ('employees')
                    ->where ('name', 'like', "%$keyword%")
                    ->orderBy ('name', 'asc')
                    ->get ();
                if ($deps->count () > 0) {
                    $deps->each (function ($item, $key) use (&$data)
                    {

                        if ($item->Employees->count () > 0) {
                            $Employee = new Employee;
                            $Employee->name = $item->name;
                            $Employee->type = 'optgroup';
                            $data->push ($Employee);
                            $data = $data->merge ($item->Employees);
                        }
                    });
                }
            }
        } else if ($type === 'tag') {
            $columnMapping = ['title' => 'title', 'rank' => 'rank'];

            if ($keyword && array_has ($columnMapping, $keyword)) {
                $columnName = ['title' => 'title', 'rank' => 'rank'] [ $keyword ];
                $data = Employee::query ()
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
        return Employee::query ()->create ($data);
    }

    public static function update ($id, $data)
    {
        return Employee::query ()->where ('id', $id)->update ($data);
    }

    public static function find ($id)
    {
        return Employee::query ()->find ($id);
    }

    public static function delete($id)
    {
        return Employee::destroy($id);
    }

    public static function findByAdminUser ($admin_user)
    {
        return Employee::query ()->where ('admin_user_id', $admin_user)->first ();
    }
}
