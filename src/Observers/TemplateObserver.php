<?php


namespace Goodcatch\Modules\Approval\Observers;


use Goodcatch\Modules\Approval\Model\Admin\Template;
use Illuminate\Support\Facades\DB;


/**
 * 更新分类层级信息
 *
 * Class DepartmentObserver
 * @package Goodcatch\Modules\Approval\Observers
 */
class TemplateObserver
{


    // creating, created, updating, updated, saving
    // saved, deleting, deleted, restoring, restored
    public function created (Template $item)
    {
        
        $this->updatePathAndLevel($item);

    }

    public function updated (Template $item)
    {
        $this->updatePathAndLevel($item);

    }

    /**
     * 更新部门的路径
     * @param $item
     */
    private function updatePathAndLevel(Template $item){
        $table = $item->getTable();
        $category = $item->category;
        $id = $item->id;
        if($item->pid > 0){

            $path = $item->id;
            $path_text = $item->name;
            $level = 1;
            $item = $item->parent;

            while(! is_null($item)){
                $path = $item->id . ',' . $path;
                $path_text = $item->name . ',' . $path_text;
                $level ++;
                $item = $item->parent;
            }

            DB::table($table)->where('id', $id)->update([
                'path_text'=>$path_text,
                'path'=>$path,
                'level'=>$level
            ]);
        }

        if(isset($category) && $category->id > 0){
            $categories = $category->name;
            $category = $category->parent;
            while(! is_null($category)){
                $categories = $category->name . ',' . $categories;
                $category = $category->parent;
            }
            DB::table($table)->where('id', $id)->update([
                'categories'=>$categories,
            ]);
        }




    }

}
