<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Approval\Http\Requests\Admin\TeamRequest;
use Goodcatch\Modules\Approval\Model\Admin\Team;
use Goodcatch\Modules\Approval\Repositories\Admin\TeamRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeamController extends BaseController
{
    protected $formNames = ['name', 'project_id', 'departments', 'employees', 'to', 'order'];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb[] = ['title' => '审批组列表', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.team.index')];
    }

    /**
     * 审批组管理-审批组列表
     *
     */
    public function index ()
    {
        $this->breadcrumb[] = ['title' => '审批组列表', 'url' => ''];
        return view ('approval::admin.team.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批组列表数据接口
     *
     * @param Request $request
     * @return array
     */
    public function list (TeamRequest $request)
    {
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);

        if ($request->pid) {
            $data = TeamRepository::list ($perPage, $condition, $request->pid);
        }
        else {
            $data = TeamRepository::list ($perPage, $condition);
        }


        return $data;
    }

    /**
     * 审批组管理-新增审批组
     *
     */
    public function create ()
    {
        $this->breadcrumb[] = ['title' => '新增审批组', 'url' => ''];
        return view ('approval::admin.team.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批组管理-保存审批组
     *
     * @param TeamRequest $request
     * @return array
     */
    public function save (TeamRequest $request)
    {
        try {

            TeamRepository::add ($request->only ($this->formNames));
            return [
                'code'   => 0,
                'msg'    => '新增成功',
                'reload' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '新增失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前审批组已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 审批组管理-编辑审批组
     *
     * @param int $id
     * @return View
     */
    public function edit ($id)
    {
        $this->breadcrumb[] = ['title' => '编辑审批组', 'url' => ''];

        $model = TeamRepository::find ($id);
        return view ('approval::admin.team.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 审批组管理-更新审批组
     *
     * @param TeamRequest $request
     * @param int $id
     * @return array
     */
    public function update (TeamRequest $request, $id)
    {
        $team = Team::find ($id);
        // 修改排序
        if ($request->to) {
            if ($team) {

                $ids = explode (',', $request->to);
                $teams = Team::whereIn ('id', $ids)->get ();
                if ($teams->count () > 0) {

                    $teams_tobe_sorted = [];
                    $q = 'update ap_teams set `order` = case id';
                    foreach ($teams as $team) {
                        $teams_tobe_sorted [ $team->id ] = $team;
                    }
                    foreach ($ids as $idx => $team_id) {
                        $q .= " when $team_id then $idx ";
                    }
                    $q .= " end where id in ({$request->to}) and project_id = {$team->project_id};";

                    return [
                        'code'     => 0,
                        'msg'      => '编辑成功',
                        'redirect' => DB::update (DB::raw ($q))
                    ];
                }
            }

        }
        else if ($request->name) {
            $team->name = $request->name;
            $team->save ();
        }

        return [
            'code'     => 1,
            'msg'      => '编辑失败：',
            'redirect' => false
        ];

    }

    /**
     * 审批组管理-删除审批组
     *
     * @param int $id
     */
    public function delete ($id)
    {
        try {
            TeamRepository::delete ($id);
            return [
                'code'     => 0,
                'msg'      => '删除成功',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.team.index')
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
