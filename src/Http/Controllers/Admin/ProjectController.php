<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Lightcms\Http\Controllers\Controller;
use Goodcatch\Modules\Approval\Http\Requests\Admin\ProjectRequest;
use Goodcatch\Modules\Approval\Repositories\Admin\ProjectRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    protected $formNames = ['pid', 'name', 'department_id', 'adapter_id', 'order'];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb[] = ['title' => '项目列表', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.project.index')];
    }

    /**
     * 项目管理-项目列表
     *
     */
    public function index ()
    {
        $this->breadcrumb[] = ['title' => '项目列表', 'url' => ''];
        return view ('approval::admin.project.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 项目列表数据接口
     *
     * @param Request $request
     * @return array
     */
    public function list (ProjectRequest $request)
    {
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);

        if (! empty($request->type) && ! empty($request->keyword)) {
            $condition [ $request->type ] = $request->keyword;
        }
        $data = ProjectRepository::list ($perPage, $condition);

        return $data;
    }

    /**
     * 项目管理-新增项目
     *
     */
    public function create ()
    {
        $this->breadcrumb[] = ['title' => '新增项目', 'url' => ''];
        return view ('approval::admin.project.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 项目管理-保存项目
     *
     * @param ProjectRequest $request
     * @return array
     */
    public function save (ProjectRequest $request)
    {
        $data = $request->only ($this->formNames);
        if (empty ($data ['pid']))
        {
            unset ($data ['pid']);
        }
        if (isset ($data ['department_id']) && empty ($data ['department_id']))
        {
            unset ($data ['department_id']);
        }
        try {
            ProjectRepository::add ($data);
            return [
                'code'     => 0,
                'msg'      => '新增成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '新增失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前项目已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 项目管理-编辑项目
     *
     * @param int $id
     * @return View
     */
    public function edit ($id)
    {
        $this->breadcrumb[] = ['title' => '编辑项目', 'url' => ''];

        $model = ProjectRepository::find ($id);
        return view ('approval::admin.project.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 项目管理-更新项目
     *
     * @param ProjectRequest $request
     * @param int $id
     * @return array
     */
    public function update (ProjectRequest $request, $id)
    {
        $data = $request->only ($this->formNames);
        if (empty ($data ['pid']))
        {
            unset ($data ['pid']);
        }
        if ($data ['pid'] === $id)
        {
            unset ($data ['pid']);
        }
        if (isset ($data ['department_id']) && empty ($data ['department_id']))
        {
            unset ($data ['department_id']);
        }
        try {
            ProjectRepository::update ($id, $data);
            return [
                'code'     => 0,
                'msg'      => '编辑成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '编辑失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前项目已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 项目管理-删除项目
     *
     * @param int $id
     */
    public function delete ($id)
    {
        try {
            ProjectRepository::delete ($id);
            return [
                'code'     => 0,
                'msg'      => '删除成功',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.project.index')
            ];
        }
        catch (\RuntimeException $e) {
            return [
                'code'     => 1,
                'msg'      => '删除失败：' . $e->getMessage (),
                'redirect' => false
            ];
        }
    }

}
