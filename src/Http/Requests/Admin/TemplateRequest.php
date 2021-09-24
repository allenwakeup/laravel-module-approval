<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

use Goodcatch\Modules\Approval\Http\Requests\BaseRequest;
use Goodcatch\Modules\Approval\Model\Admin\Template;
use Illuminate\Validation\Rule;

class TemplateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        $rules = [
            'pid' => 'integer|exclude_if:pid,0|exists:ap_templates,id|different:id',
            'category_id' => 'integer|exclude_if:category_id,0|exists:ap_categories,id|different:id',
            'code' => ['max:50', $this->uniqueOrExists (Template::class, 'code') . ':ap_templates'],
            'name' => ['required', 'max:50', $this->uniqueOrExists (Template::class, 'name') . ':ap_templates'],
            'short' => 'max:20',
            'alias' => 'max:20',
            'description' => 'max:255',
            'type' => 'integer',
            'group' => 'max:20',
            'order' => 'integer',
            'status' => [
                'required',
                Rule::in ([Template::STATUS_DISABLE, Template::STATUS_ENABLE])
            ]
        ];
        switch ($this->method()) {
            case 'GET':
                $rules = [
                    'pid' => 'integer|exclude_if:pid,0|exists:ap_templates,id'
                ];
                break;
        }
        return $rules;

    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages ()
    {
        return [
            'pid.different'=>'上级不能是自己',
            'name.required' => '名称不能为空',
            'name.max' => '名称长度不能大于50'
        ];
    }
}
