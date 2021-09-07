<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

class ProjectRequest extends BaseRequest
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
                    'pid'           => 'integer|different:id|exists:ap_projects,id',
                    'name'          => 'required|max:50',
                    'department_id' => 'integer|exists:core_departments,id',
                    'adapter_id'    => 'integer|exists:ap_adapters,id',
                    'order'         => 'integer'
                ];
        }
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages ()
    {
        return [
            'name.required' => '名称不能为空',
            'name.max'      => '名称长度不能大于50',
        ];
    }
}
