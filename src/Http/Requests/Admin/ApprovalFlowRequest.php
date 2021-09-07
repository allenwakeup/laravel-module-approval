<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

use Goodcatch\Modules\Approval\Model\Admin\ApprovalFlow;
use Goodcatch\Modules\Approval\Model\Admin\Audit;
use Goodcatch\Modules\Approval\Model\Admin\Application;

class ApprovalFlowRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $status_in = [
            Application::STATUS_DISABLE,
            Application::STATUS_ENABLE,
        ];

        switch ($this->method()) {
            case 'PUT':
                return [
                    'status' => 'required|numeric|in:' . implode(',', [Audit::RESULT_DENY, Audit::RESULT_PASS]),
                    'note' => 'string|max:255'
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
