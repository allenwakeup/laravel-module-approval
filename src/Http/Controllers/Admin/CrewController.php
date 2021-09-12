<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Approval\Http\Requests\Admin\CrewRequest;
use Goodcatch\Modules\Approval\Model\Admin\Staff;
use Goodcatch\Modules\Approval\Model\Admin\Crew;
use Goodcatch\Modules\Approval\Repositories\Admin\CrewRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CrewController extends BaseController
{
    protected $formNames = ['name', 'team_id', 'title', 'rank', 'people', 'condition', 'order'];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb[] = ['title' => '审批节点列表', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.crew.index')];
    }

    /**
     * 审批节点管理-审批节点列表
     *
     */
    public function index ()
    {
        $this->breadcrumb[] = ['title' => '审批节点列表', 'url' => ''];
        return view ('approval::admin.crew.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批节点列表数据接口
     *
     * @param Request $request
     * @return array
     */
    public function list (CrewRequest $request)
    {
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);

        if ($request->pid) {
            $data = CrewRepository::list ($perPage, $condition, $request->pid);
        }
        else {
            $data = CrewRepository::list ($perPage, $condition);
        }


        return $data;
    }

    /**
     * 审批节点管理-新增审批节点
     *
     */
    public function create ()
    {
        $this->breadcrumb[] = ['title' => '新增审批节点', 'url' => ''];
        return view ('approval::admin.crew.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批节点管理-保存审批节点
     *
     * @param CrewRequest $request
     * @return array
     */
    public function save (CrewRequest $request)
    {
        try {

            $crew = new Crew;
            $crew->name = $request->name;
            $crew->team_id = $request->team_id;
            $crew->condition = $request->condition;
            $crew->title = $request->title ?? '';
            $crew->rank = $request->rank ?? '';

            if ($request->people && ! empty(trim ($request->people))) {
                $staff_ids = explode (',', $request->people);
                $staff = Staff::whereIn ('id', $staff_ids)->get ()->toArray ();

                if (isset ($staff [ 0 ])) {
                    $crew->staff_primary = $staff [ 0 ][ 'id' ];
                }
                if (isset ($staff [ 1 ])) {
                    $crew->staff_secondary = $staff [ 1 ][ 'id' ];
                }
                if (isset ($staff [ 2 ])) {
                    $crew->staff_other = $staff [ 2 ][ 'id' ];
                }

            }

            $crew->save ();
            return [
                'code'   => 0,
                'msg'    => '新增成功',
                'reload' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '新增失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前审批节点已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 审批节点管理-编辑审批节点
     *
     * @param int $id
     * @return View
     */
    public function edit ($id)
    {
        $this->breadcrumb[] = ['title' => '编辑审批节点', 'url' => ''];

        $model = CrewRepository::find ($id);
        return view ('approval::admin.crew.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批节点管理-更新审批节点
     *
     * @param CrewRequest $request
     * @param int $id
     * @return array
     */
    public function update (CrewRequest $request, $id)
    {

        $crew = Crew::find ($id);
        // 修改排序
        if ($request->to) {
            if ($crew) {

                $ids = explode (',', $request->to);
                $crews = Crew::whereIn ('id', $ids)->get ();
                if ($crews->count () > 0) {

                    $crews_tobe_sorted = [];
                    $q = 'update crews set `order` = case id';
                    foreach ($crews as $crew) {
                        $crews_tobe_sorted [ $crew->id ] = $crew;
                    }
                    foreach ($ids as $idx => $crew_id) {
                        $q .= " when $crew_id then $idx ";
                    }
                    $q .= " end where id in ({$request->to}) and team_id = {$crew->team_id};";

                    return [
                        'code'     => 0,
                        'msg'      => '编辑成功',
                        'redirect' => DB::update (DB::raw ($q))
                    ];
                }
            }

        }
        else if ($request->name) {
            $crew->name = $request->name;
            $crew->save ();
        }

        $data = $request->only ($this->formNames);
        try {
            CrewRepository::update ($id, $data);
            return [
                'code'     => 0,
                'msg'      => '编辑成功',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.crew.index')
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '编辑失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前审批节点已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 审批节点管理-删除审批节点
     *
     * @param int $id
     * @return array
     */
    public function delete ($id)
    {
        try {
            CrewRepository::delete ($id);
            return [
                'code'     => 0,
                'msg'      => '删除成功',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.crew.index')
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
