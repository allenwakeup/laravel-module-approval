<?php

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Goodcatch\Modules\Lightcms\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->breadcrumb[] = ['title' => '审批', 'url' => route('admin::' . module_route_prefix ('.') . 'approval.index')];
    }

    /**
     * 模块-审批流程
     *
     * @return Response
     */
    public function index()
    {
        return view('approval::admin.home.index');
    }

}
