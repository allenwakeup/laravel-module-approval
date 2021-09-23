<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;


use Goodcatch\Modules\Approval\Http\Requests\Admin\TemplateRequest;
use Goodcatch\Modules\Approval\Http\Resources\Admin\TemplateResource\TemplateCollection;
use Goodcatch\Modules\Approval\Model\Admin\Template;
use Goodcatch\Modules\Approval\Repositories\Admin\TemplateRepository;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class TemplateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return $this->success(
            new TemplateCollection(TemplateRepository::list(
                $request->per_page??30,
                $request->validated(),
                $request->keyword
            )));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->success(TemplateRepository::find($id), __('base.success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TemplateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        try{
            return $this->success(TemplateRepository::add(array_merge(['pid' => 0], $request->validated())), __('base.success'));
        } catch (QueryException $e) {
            return $this->error(__('base.error') . (Str::contains ($e->getMessage (), 'Duplicate entry') ? '当前数据已存在' : '其它错误'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TemplateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (TemplateRequest $request, $id)
    {
        $data = $request->validated();



        try {
            $res = TemplateRepository::update ($id, array_merge(['pid' => 0], $data));
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
            return $this->success(TemplateRepository::delete($idArray), __('base.success'));
        } catch (QueryException $e) {
            return $this->error(__('base.error') . $e->getMessage());
        }
    }


    /**
     * go get template file
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function download(Request $request, $id){
        $template = TemplateRepository::find($id);
        if(is_null($template)) {
            $file = storage_path($template->path);
            if (file_exists($file) && is_readable($file)) {
                header("content-type: text/xml;charset=utf-8");
                return response()->download($file);
            }
        }
        return $this->error('no template found', [
            '$id' => $id
        ]);

    }

    /**
     * upload bpmn file
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id){

        $file = $request->file;

        if(is_null ($file)){
            return $this->error('no file specific');
        }
        $template = TemplateRepository::find($id);

        $path = $upload_path = storage_path('app/process/' . date('Ym'). '/' . date('d'));

        if(is_null($template) || empty($template->path)){
            // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
            // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/

            // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
            $extension = strtolower($request->file->getClientOriginalExtension()) ?: 'bpmn';

            // 如果上传的不是指定后缀将终止操作
            if ( ! in_array($extension, ['bpmn'])) {
                return $this->error(__('base.error'), [
                    'extension' => $extension
                ]);
            }
            $path = $path . '/approval_template_' . time() . '_' . str_random(10) . '.' . $extension;

            $request->file->move($path);
        } else {
            $path = $template->path;
        }

        // 移动到我们的目标存储路径中
        $request->file->move($path);

        return $this->success([ 'path' => $path ], __('base.success'));
    }
}