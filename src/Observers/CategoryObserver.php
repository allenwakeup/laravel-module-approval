<?php


namespace Goodcatch\Modules\Approval\Observers;


use Goodcatch\Modules\Approval\Model\Admin\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


/**
 * 更新分类层级信息
 *
 * Class DepartmentObserver
 * @package Goodcatch\Modules\Core\Observers
 */
class CategoryObserver
{


    // creating, created, updating, updated, saving
    // saved, deleting, deleted, restoring, restored
    public function created (Category $item)
    {
        
        $this->updatePathAndLevel($item);

    }

    public function updated (Category $item)
    {
        $this->updatePathAndLevel($item);

    }

    /**
     * 更新部门的路径
     * @param $item
     */
    private function updatePathAndLevel(Category $item){
        if($item->pid > 0){
            $table = $item->getTable();
            $id = $item->id;
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
                'path'=>$path,
                'path_text'=>$path_text,
                'level'=>$level
            ]);
        }




    }

}
