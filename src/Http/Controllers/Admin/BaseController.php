<?php


/**
 *
 * This file <BaseController.php> was created by <PhpStorm> at <2021/2/5>,
 * and it is part of project <approval>.
 * @author  Allen Li <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;

use Goodcatch\Modules\Approval\Repositories\Admin\StaffRepository;
use Goodcatch\Modules\Lightcms\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{

    protected $staff;

    public function __construct ()
    {
        parent::__construct ();

        $this->staff = tap (StaffRepository::findByAdminUser (\Auth::guard ('admin')->user ()), function ($staff)
        {
            View::share ('admin_staff', $staff);
        });

        $this->login_user = $user = \Auth::guard ('admin')->user ();

    }


}