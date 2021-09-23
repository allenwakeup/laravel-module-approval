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
                'icon' => 'icon-gc-' . self::MODULE_NAME,
                'children' => [
                    [
                        'name' => '主数据',
                        'children' => [
                            [
                                'name' => '模版分类',
                                'icon' => 'icon-gc-categories',
                                'link' => $this->getSeedsModuleApiUri(self::MODULE_ALIAS,'categories'),
                            ],
                            [
                                'name' => '模版管理',
                                'icon' => 'icon-gc-templates',
                                'link' => $this->getSeedsModuleApiUri(self::MODULE_ALIAS,'templates'),
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
            // 模版分类
            $this->getSeedsModuleMenuGroupName(self::MODULE_ALIAS, '模版分类') => [
                self::MODULE_ALIAS . '.categories'
            ],
            // 模版管理
            $this->getSeedsModuleMenuGroupName(self::MODULE_ALIAS, '模版管理') => [
                self::MODULE_ALIAS . '.templates' => array_merge($this->api_actions, [
                    'upload' => ['name' => '上传', 'content' => 'BPMN上传'],
                    'download' => ['name' => '下载', 'content' => 'BPMN下载']
                ])
            ]
        ];
    }
}
