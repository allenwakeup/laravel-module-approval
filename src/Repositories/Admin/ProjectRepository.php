<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Repositories\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Project;

class ProjectRepository extends BaseRepository
{

    public static function list($perPage, $condition = [])
    {
        $data = Project::query()
            ->with(['parent', 'adapter', 'department'])
            ->where(function ($query) use ($condition) {
                self::buildQuery($query, $condition);
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
        $data->transform(function ($item) {
            $item->editUrl = route ('admin::' . module_route_prefix ('.') . 'approval.project.edit', ['id' => $item->id]);
            $item->deleteUrl = route ('admin::' . module_route_prefix ('.') . 'approval.project.delete', ['id' => $item->id]);
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
        return Project::query()->create($data);
    }

    public static function update($id, $data)
    {
        return Project::query()->where('id', $id)->update($data);
    }

    public static function find($id)
    {
        return Project::query()->find($id);
    }

    public static function delete($id)
    {
        return Project::destroy($id);
    }

    public static function userAllProject()
    {
        $user = \Auth::user();
        $projects = collect([]);
        if ($user->department)
        {
            $department = $user->department;
            while ($department)
            {
                $projects = $projects->merge($department->projects);
                $department = $department->parent;
            }
        }
        return $projects;
    }
}
