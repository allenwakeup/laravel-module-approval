<?php

namespace Goodcatch\Modules\Approval\Http\Controllers;

use Goodcatch\Modules\Base\Http\Controllers\SpaController as Controller;
use Illuminate\Support\Facades\View;

class SpaController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        View::share('goodcatch', 'Goodcatch Modules Core');
    }

    protected function moduleIndex(array $view_content){
        return view('approval::index', $view_content);
    }
}