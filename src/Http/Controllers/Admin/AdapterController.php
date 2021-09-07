<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Lightcms\Http\Controllers\Controller;
use Goodcatch\Modules\Approval\Http\Requests\Admin\AdapterRequest;
use Goodcatch\Modules\Approval\Repositories\Admin\AdapterRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdapterController extends Controller
{
    protected $formNames = [
        'pid', 'category_id', 'code', 'name', 'description', 'alias',
        'payload', 'group'
    ];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb [] = ['title' => '适配器列表', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.adapter.index')];
    }

    /**
     * 适配器管理-适配器列表
     *
     */
    public function index ()
    {
        $this->breadcrumb [] = ['title' => '适配器列表', 'url' => ''];
        return view ('approval::admin.adapter.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 适配器管理-适配器列表数据接口
     *
     * @param Request $request
     * @return array
     */
    public function list (Request $request)
    {
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);

        $data = AdapterRepository::list ($perPage, $condition, $request->keyword);

        return $data;
    }

    /**
     * 适配器管理-新增适配器
     *
     */
    public function create ()
    {
        $this->breadcrumb [] = ['title' => '新增适配器', 'url' => ''];
        return view ('approval::admin.adapter.add', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 适配器管理-适配器详情
     *
     */
    public function detail ($id)
    {
        return view ('admin.detail', ['model' => AdapterRepository::find ($id)]);
    }

    /**
     * 适配器管理-保存适配器
     *
     * @param AdapterRequest $request
     * @return array
     */
    public function save (AdapterRequest $request)
    {
        $data = $request->only ($this->formNames);
        if (empty ($data ['pid']))
        {
            $data ['pid'] = 0;
        }
        try {
            AdapterRepository::add ($data);
            return [
                'code'     => 0,
                'msg'      => '新增成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '新增失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前适配器已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 适配器管理-编辑适配器
     *
     * @param int $id
     * @return View
     */
    public function edit ($id)
    {
        $this->breadcrumb [] = ['title' => '编辑适配器', 'url' => ''];

        $model = AdapterRepository::find ($id);
        return view ('approval::admin.adapter.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 适配器管理-更新适配器
     *
     * @param AdapterRequest $request
     * @param int $id
     * @return array
     */
    public function update (AdapterRequest $request, $id)
    {
        $data = $request->only ($this->formNames);
        if (empty ($data ['pid']))
        {
            $data ['pid'] = 0;
        }
        if ($data ['pid'] === $id)
        {
            unset ($data ['pid']);
        }
        try {
            AdapterRepository::update ($id, $data);
            return [
                'code'     => 0,
                'msg'      => '编辑成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '编辑失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前适配器已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 适配器管理-删除适配器
     *
     * @param int $id
     * @return array
     */
    public function delete ($id)
    {
        try {
            AdapterRepository::delete ($id);
            return [
                'code'     => 0,
                'msg'      => '删除成功',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.adapter.index')
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
