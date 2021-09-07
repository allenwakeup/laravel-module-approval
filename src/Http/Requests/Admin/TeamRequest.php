<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

class TeamRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        switch ($this->method()) {
            case 'GET':
                return [
                    'pid' => 'numeric',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'max:50'
                ];
                break;
            case 'POST':
                return [
                    'name' => 'required|max:50',
                    'departments' => '',
                    'project_id' => 'required|numeric|exists:ap_projects,id',
                    'order' => 'numeric',
                ];
                break;
        }
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'name.max' => '名称长度不能大于50',
        ];
    }
}
