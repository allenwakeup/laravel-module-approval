<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;


use Goodcatch\Modules\Approval\Http\Requests\Admin\ApplicationRequest;
use Goodcatch\Modules\Approval\Model\Admin\Application;
use Goodcatch\Modules\Approval\Model\Admin\Project;
use Goodcatch\Modules\Approval\Repositories\Admin\ApplicationRepository;
use Goodcatch\Modules\Approval\Repositories\Admin\ProjectRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ApplicationController extends BaseController
{
    protected $formNames = ['name', 'proxy_staff_id', 'project_id'];

    public function __construct ()
    {
        parent::__construct ();

        $this->breadcrumb[] = ['title' => '申请列表', 'url' => route ('admin::' . module_route_prefix ('.') . 'approval.application.index')];
    }

    /**
     * 申请管理-申请列表
     *
     */
    public function index ()
    {
        $this->breadcrumb[] = ['title' => '申请列表', 'url' => ''];
        return view ('approval::admin.application.index', ['breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 申请列表数据接口
     *
     * @param ApplicationRequest $request
     * @return array
     */
    public function list (ApplicationRequest $request)
    {
        $perPage = (int) $request->get ('limit', 50);
        $condition = $request->only ($this->formNames);

        $data = ApplicationRepository::list ($perPage, $condition, $request->with_content);

        return $data;
    }

    /**
     * 申请管理-新增申请
     * @param ApplicationRequest $request
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function create (ApplicationRequest $request)
    {
        $this->breadcrumb[] = ['title' => '新增申请', 'url' => ''];

        $assign = [];
        $assign [ 'breadcrumb' ] = $this->breadcrumb;

        if ($request->id && is_numeric ($request->id)) {
            $project = Project::find ($request->id);

            if ($project) {

                $assign [ 'project' ] = $project;

                return view ('approval::admin.application-adapter.add-' . $project->adapter->code, $assign);
            }
        }
        return view ('approval::admin.application.add', $assign);
    }

    /**
     * 申请管理-保存申请
     *
     * @param ApplicationRequest $request
     * @return array
     */
    public function save (ApplicationRequest $request)
    {
        try {
            $data = $request->only ($this->formNames);
            $data ['staff_id'] = $this->staff->id;
            $data ['status'] = Application::STATUS_SUBMITTED;
            ApplicationRepository::add ($request->only ($this->formNames));
            return [
                'code'     => 0,
                'msg'      => '新增成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '新增失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前申请已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 申请管理-编辑申请
     *
     * @param int $id
     * @return View
     */
    public function edit ($id)
    {
        $this->breadcrumb[] = ['title' => '编辑申请', 'url' => ''];

        $model = ApplicationRepository::find ($id);
        return view ('approval::admin.application.add', ['id' => $id, 'model' => $model, 'breadcrumb' => $this->breadcrumb]);
    }

    /**
     * 申请管理-更新申请
     *
     * @param ApplicationRequest $request
     * @param int $id
     * @return array
     */
    public function update (ApplicationRequest $request, $id)
    {
        $data = $request->only (['proxy_staff_id']);
        try {
            ApplicationRepository::update ($id, $data);
            return [
                'code'     => 0,
                'msg'      => '编辑成功',
                'redirect' => true
            ];
        }
        catch (QueryException $e) {
            return [
                'code'     => 1,
                'msg'      => '编辑失败：' . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前申请已存在' : '其它错误'),
                'redirect' => false
            ];
        }
    }

    /**
     * 申请管理-删除申请
     *
     * @param int $id
     * @return array
     */
    public function delete ($id)
    {
        try {
            ApplicationRepository::delete ($id);
            return [
                'code'   => 0,
                'msg'    => '删除成功',
                'reload' => true
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

    /*
     * 申请管理-上传申请
     *
     * @param ApplicationRequest $request
     * @param ExcelUploadHandler $uploader
     * @return array
     */
    /*public function upload (ApplicationRequest $request, ExcelUploadHandler $uploader)
    {

        $res = $uploader->save ($request->file, 'excel', 'app');

        if ($res) {
            $application = new Application;
            $user = \Auth::user ();
            try {
                $application->new_name = random_int (2, 999);
            }
            catch (\Exception $e) {
                $application->new_name = 1;
            }
            $application->admin_user_id = $user->id;
            $application->path = $res [ 'path' ];
            $application->display = $res [ 'origin' ];
            if ($request->proxy_staff_id) {
                $application->admin_user_id = $request->proxy_staff_id;
                $application->proxy_user_id = $user->id;
            }
            $application->project_id = $request->project_id;
            $application->save ();

            return [
                'code' => 0,
                'msg'  => '上传成功',
                'data' => $res [ 'origin' ]
            ];
        }

        return [
            'code' => 1,
            'msg'  => '上传失败',

        ];
    }
*/
    /**
     * 申请管理-提交申请
     *
     * @param ApplicationRequest $request
     * @return array
     */
    public function submit (ApplicationRequest $request)
    {
        $application = Application::find ($request->id);
        // 申请者提交，必须是本人
        if (($application->isBelongToStaff ($this->staff) || $application->isBelongToProxy ($this->staff))) {
            $application->status = Application::STATUS_SUBMITTED;
            $application->addNote (date ('Y-m-d H:i:s') . '「' . $this->staff->display . '」提交了的申请');
            $result = $application->save ();
            if ($result > 0) {
                return [
                    'code'   => 0,
                    'msg'    => '提交成功',
                    'reload' => true
                ];
            }
        }
        return [
            'code'     => 0,
            'msg'      => '提交失败',
            'redirect' => false
        ];
    }

    /*
     * 申请管理-转换申请数据
     *
     * @param ApplicationRequest $request
     * @return array
     */
    /*
    public function convert (ApplicationRequest $request)
    {

        $application = Application::find ($request->id);
        $user = \Auth::user ();
        // 申请者提交，必须是本人
        if ($user->id === $application->admin_user_id
            && $application->status === Application::STATUS_UPLOADED
            && $application->convert_status !== Application::CONVERT_STATUS_SUCCESS) {

            ConvertExcel::dispatch ($application);

            // $data = $this->testApplicationConvert($application);


            return [
                'code'     => 0,
                'msg'      => '已加入转换队伍中，请耐心等候转换完成',
                'redirect' => route ('admin::' . module_route_prefix ('.') . 'approval.application.index'),
                // 'data' => $data
            ];

        }
        return [
            'code'     => 0,
            'msg'      => '转换失败',
            'redirect' => false
        ];
    }

    private function testApplicationConvert ($application)
    {
        $ximport_adapters = config ('ximport.adapters');
        if (isset ($ximport_adapters) && array_key_exists ($application->project->adapter, $ximport_adapters)) {
            if (array_key_exists ('settings', $ximport_adapters[ $this->application->project->adapter ])) {
                $class = $ximport_adapters[ $this->application->project->adapter ][ 'settings' ];

                $file = storage_path () . $application->path;
                if (file_exists ($file) && is_readable ($file)) {
                    $ximport_settings = config ('ximport.settings');

                    if (isset ($ximport_settings) && isset ($ximport_settings [ $class ])) {
                        $data = Excel::toArray (new $class (), $file);
                        if (isset ($data)) {
                            // 遍历已经转换的数据
                            foreach ($data as $sheet_name => &$sheet_data) {
                                // 读取每一个sheet配置
                                $sheet_config = $ximport_settings[ $class ][ $sheet_name ];
                                if (isset ($sheet_config)) {
                                    // 只对配置了列映射的列进行值转换
                                    if (array_has ($sheet_config, 'column.mapping')) {
                                        $column_mapping = array_get ($sheet_config, 'column.mapping');
                                        if (isset ($sheet_data)) {
                                            foreach ($sheet_data as $ridx => &$row_data) {
                                                if (isset($row_data)) {
                                                    // 找到有值的列，并且有列转换规则的列
                                                    \collect ($row_data)->filter (function ($cval, $ckey) use ($column_mapping)
                                                    {
                                                        return isset ($cval) && array_has ($column_mapping, $ckey) && array_has ($column_mapping[ $ckey ], 'rules');
                                                    })->each (function ($cval, $ckey) use ($column_mapping, $data, $sheet_data, &$row_data)
                                                    {
                                                        // 传递整体数据，和当前sheet数据，以及当前列和列值，方便转换器转换数值
                                                        app ('import.transformer')->dispatcher ($data, $sheet_data, $ckey, $cval, array_get ($column_mapping[ $ckey ], 'rules'),
                                                            // callback to here
                                                            function ($transformer_payload) use (&$row_data)
                                                            {
                                                                $row_data [ $transformer_payload->column_key ] = $transformer_payload->column_value;
                                                            }
                                                        );
                                                    });
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        return $data;
                    }
                }
            }
        }
        return false;
    }
*/
    /**
     *
     * 申请管理-申请详情
     *
     * @param ApplicationRequest $request
     * @return View
     */
    public function detail (ApplicationRequest $request)
    {
        $application = Application::with (['applier', 'proxy', 'project.department', 'audits'])->find ($request->id);
        $user = \Auth::user ();
        if ($user->isSuperAdmin ()
            || ($application
                && ($application->isBelongToStaff ($this->staff)
                    || $application->isBelongToProxy ($this->staff)
                    || $user->isApplicationOperatorParentUser ($application)
                    || $application->project->isStaffInCrews ($this->staff)))
        ) {
            $audits = $application->audits;
            if (isset ($audits)) {
                $crew_audit_map = [];
                foreach ($audits as $audit) {
                    $crew_audit_map [ $audit->crew_id ] = $audit;
                }
            }

            if ($application->project->adapter && array_has (ProjectRepository::adapter (), $application->project->adapter)) {
                $adapter = ProjectRepository::adapter ($application->project->adapter);
                return view ('approval::admin.application-adapter.detail-' . strtolower ($adapter [ 'id' ]), ['model' => $application, 'audits' => $crew_audit_map]);
            }

            return view ('approval::admin.application.detail', ['model' => $application, 'audits' => $crew_audit_map]);
        }

        return view ('approval::admin.application.detail', []);
    }

}