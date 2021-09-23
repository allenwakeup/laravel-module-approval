<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;


use Goodcatch\Modules\Approval\Http\Requests\Admin\CategoryRequest;
use Goodcatch\Modules\Approval\Http\Resources\Admin\CategoryResource\CategoryCollection;
use Goodcatch\Modules\Approval\Repositories\Admin\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRequest $request)
    {
        $action = $request->get ('action');
        $data_type = $request->get ('data_type');
        $condition = $request->validated();

        if (isset ($condition ['pid'])) {
            $condition ['pid'] = ['=', $condition ['pid']];
        } else {
            if ($action !== 'search') {
                $condition['pid'] = ['=', 0];
            }
        }

        if ($data_type === 'tree')
        {
            if (!empty ($request->keyword) && is_numeric ($request->keyword))
            {
                $data = CategoryRepository::tree2 (intval ($request->keyword));
            } else {
                $data = CategoryRepository::tree2 (0);
            }
        } else if ($data_type === 'select') {
            $data = CategoryRepository::selectTree ($request->pid ?? 0);
        }
        else {
            $data = CategoryRepository::list(
                $request->per_page??30,
                $request->validated(),
                $request->keyword
            );
        }
        if($data instanceof Collection){
            return $this->success($data);
        }
        return $this->success(new CategoryCollection($data, __('base.success')));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->success(CategoryRepository::find($id), __('base.success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{
            return $this->success(CategoryRepository::add(array_merge(['pid' => 0], $request->validated())), __('base.success'));
        } catch (QueryException $e) {
            return $this->error(__('base.error') . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前数据已存在' : '其它错误'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (CategoryRequest $request, $id)
    {
        $data = $request->validated();



        try {
            $res = CategoryRepository::update ($id, array_merge(['pid' => 0], $data));
                        return $this->success($res, __('base.success'));
        } catch (QueryException $e) {
            return $this->error(__('base.error') . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前数据已存在' : '其它错误'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idArray = array_filter(explode(',',$id),function($item){
            return is_numeric($item);
        });

        try{
            return $this->success(CategoryRepository::delete($idArray), __('base.success'));
        } catch (QueryException $e) {
            return $this->error(__('base.error') . $e->getMessage());
        }
    }
}