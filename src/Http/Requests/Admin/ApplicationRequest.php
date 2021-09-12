<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

class ApplicationRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:50',
                    'proxy_staff_id' => 'numeric|exists:core_staff,id',
                    'project_id' => 'required|numeric|exists:ap_projects,id',
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
