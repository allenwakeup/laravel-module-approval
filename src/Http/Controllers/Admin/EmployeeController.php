<?php
/**
 * Date: 2019/2/25 Time: 14:49
 *
 * @author  Allen <ali@goodcatch.cn>
 * @version v1.0.0
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Lightcms\Http\Controllers\Controller;
use Goodcatch\Modules\Approval\Http\Requests\Admin\EmployeeRequest;
use Goodcatch\Modules\Approval\Model\Admin\Employee;
use Goodcatch\Modules\Approval\Repositories\Admin\EmployeeRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    protected $formNames = ['pid', 'code', 'name', 'birthday', 'gender', 'mobile', 'email', 'social1', 'social2', 'social3', 'social4', 'social5', 'title', 'rank', 'hired', 'workday', 'department_id', 'status'];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb[] = ['title' => '主数据管理', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.employee.index')];
    }

    /**
     * 主数据管理-员工列表
     *
     */
    public function index ()
    {
        $this->breadcrumb[] = ['title' => '员工列表', 'url' => ''];
        return view ('approval::admin.employee.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 主数据管理-员工列表数据
     *
     * @param Request $request
     * @return array
     */
    public function list (Request $request)
    {
        $type = $request->type;
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);
        if ($type) {
            $data = EmployeeRepository::selectUser ($perPage, $request->keyword, $type);

        }
        else {

            $data = EmployeeRepository::list ($perPage, $condition);
        }
        return $data;
    }

    /**
     * 主数据管理-新增员工
     *
     */
    public function create ()
    {
        $this->breadcrumb[] = ['title' => '新增员工', 'url' => ''];
        return view ('approval::admin.employee.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 主数据管理-保存员工
     *
     * @param EmployeeRequest $request
     * @return array
     */
    public function save (EmployeeRequest $request)
    {
        try {
            $user = EmployeeRepository::add ($request->only ($this->formNames));
            return [
                'code'     => 0,
                'msg'      => '新增成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '新增失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前用户已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 主数据管理-编辑员工
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ($id)
    {
        $this->breadcrumb[] = ['title' => '编辑员工', 'url' => ''];

        $user = EmployeeRepository::find ($id);
        return view ('approval::admin.employee.add', ['id' => $id, 'model' => $user, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 主数据管理-更新员工
     *
     * @param EmployeeRequest $request
     * @param int $id
     * @return array
     */
    public function update (EmployeeRequest $request, $id)
    {
        $data = $request->only ($this->formNames);
        if (! isset($data[ 'status' ])) {
            $data[ 'status' ] = Employee::STATUS_DISABLE;
        }
        if ($request->input ('password') == '') {
            unset($data[ 'password' ]);
        }

        try {
            EmployeeRepository::update ($id, $data);
            return [
                'code'     => 0,
                'msg'      => '编辑成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '编辑失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前用户已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 主数据管理-删除员工
     *
     * @param int $id
     */
    public function delete ($id)
    {
        try {
            EmployeeRepository::delete ($id);
            return [
                'code'     => 0,
                'msg'      => '删除成功',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.employee.index')
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
