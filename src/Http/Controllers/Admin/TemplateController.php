<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Controllers\Admin;


use Goodcatch\Modules\Approval\Http\Requests\Admin\TemplateRequest;
use Goodcatch\Modules\Approval\Http\Resources\Admin\TemplateResource\TemplateCollection;
use Goodcatch\Modules\Approval\Repositories\Admin\TemplateRepository;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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
        $data_type = $request->get ('data_type');
        $condition = $request->only(['pid', 'name']);


        if ($data_type === 'select') {
            $data = TemplateRepository::selectTree ($request->pid ?? 0);
        } else {
            $data = TemplateRepository::list(
                $request->per_page??30,
                $condition,
                $request->keyword
            );
        }
        if($data instanceof Collection){
            return $this->success($data);
        }
        return $this->success(new TemplateCollection($data, __('base.success')));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->success(TemplateRepository::findWidthCategory($id), __('base.success'));
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
        if(! is_null($template) && ! empty($template->bpmn_file)) {
            $file = storage_path(bpmn_path($template->bpmn_file));
            if (file_exists($file) && is_readable($file)) {
                header("content-type: application/bpmn20-xml;charset=utf-8");
                return response()->download($file);
            }
        } else {
            return $this->error(__('approval::pages.admin.template.bpmn.empty'));
        }
        return $this->error(__('approval::pages.admin.template.download.failed'));

    }

    /**
     * upload bpmn file
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id){

        $file = $request->file('file');

        if(is_null ($file)){
            return $this->error('no file specific');
        }
        $template = TemplateRepository::find($id);

        if(is_null($template)){
            return $this->error('no template exists');
        }

        if(empty($template->bpmn_file)){

            $path = date('Ym'). '/' . date('d');

            // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
            $extension = strtolower($file->getClientOriginalExtension()) ?: 'bpmn';

            // 如果上传的不是指定后缀将终止操作
            if ( ! in_array($extension, ['bpmn'])) {
                return $this->error(__('base.error'), [
                    'extension' => $extension
                ]);
            }
            $file_name = 'approval_template_' . time() . '_' . str_random(10) . '.' . $extension;
        } else {
            $file_name = basename($template->bpmn_file);
            $path = dirname($template->bpmn_file);
        }

        // 移动到我们的目标存储路径中
        $request->file->move(storage_path(bpmn_path($path)), $file_name);

        $file_path = $path . '/' . $file_name;
        DB::table($template->getTable())->where('id', $template->id)->update([
            'bpmn_file' => $file_path
        ]);
        $template->save();

        return $this->success([ 'path' => $file_path ], __('base.success'));
    }
}