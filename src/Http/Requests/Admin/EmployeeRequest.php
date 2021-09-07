<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

use Goodcatch\Modules\Approval\Model\Admin\Employee;
use Illuminate\Validation\Rule;

class EmployeeRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        switch ($this->method ()) {
            case 'POST':
            case 'PUT':
                return [
                    'pid'           => ['integer', function ($attribute, $value, $failure) {
                        if (strcmp (strval ($value), strval ($this->id)) === 0) {
                            $failure (__('approval::validation.parent'));
                        }
                    }],
                    'user_id'       => 'integer',
                    'admin_user_id' => 'integer',
                    'code'          => 'max:50',
                    'name'          => 'required|max:50',
                    'gender'        => [
                        Rule::in ([
                            Employee::GENDER_MALE,
                            Employee::GENDER_UNKNOWN,
                            Employee::GENDER_FEMALE
                        ])
                    ],
                    'mobile'        => 'max:20',
                    'email'         => 'email|max:50',
                    'social1'       => 'max:50',
                    'social2'       => 'max:50',
                    'social3'       => 'max:50',
                    'social4'       => 'max:50',
                    'social5'       => 'max:50',
                    'hired'         => 'date|max:20',
                    'birthday'      => 'date|max:20',
                    'workday'       => 'date|max:20',
                    'department_id' => 'required|integer',
                    'title'         => 'max:20',
                    'rank'          => 'max:20',
                    'status'        => [
                        Rule::in ([
                            Employee::STATUS_ENABLE,
                            Employee::STATUS_DISABLE
                        ])
                    ],
                ];
        }
        return [];
    }

}
