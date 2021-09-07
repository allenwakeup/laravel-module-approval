<?php

namespace Goodcatch\Modules\Approval\Database\Seeders;

use Goodcatch\Modules\Base\Traits\PermissionSeedsTrait;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    use PermissionSeedsTrait;

    const MODULE_NAME = '审批流模块';
    const MODULE_ALIAS = 'approval';

    public function getSeedsMenus (){
        return [
            [
                'name' => self::MODULE_NAME,
                'children' => [
                    [
                        'name' => '主数据',
                        'children' => [
                            [
                                'name' => '部门管理',
                                'link' => $this->getSeedsModuleApiUri(self::MODULE_ALIAS,'departments'),
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getSeedsPermissionGroups (){
        return [
            // 主数据
            // 地区管理
            $this->getSeedsModuleMenuGroupName(self::MODULE_ALIAS, '部门管理') => [
                self::MODULE_ALIAS . '.departments'
            ]
        ];
    }
}
