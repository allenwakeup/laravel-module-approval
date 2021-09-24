<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Model\Admin;

use Goodcatch\Modules\Laravel\Model\Model as BaseModel;
use DateTimeInterface;

abstract class Model extends BaseModel
{

    /**
     * @return string module table with prefix
     */
    protected function getModuleTablePrefix () {
        return 'ap_';
    }

    /**
     * 为数组 / JSON 序列化准备日期。
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

}
