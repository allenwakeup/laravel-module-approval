<?php

return [
    'name' => 'Approval',
    'model' => [
        'Goodcatch\\Modules\\Approval\\Model\\Admin' => [
            'table' => env('MODULE_APPROVAL_STAFF_TABLE', 'core_staff'),
        ]
    ]
];
