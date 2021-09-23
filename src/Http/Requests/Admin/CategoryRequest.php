<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;

use Goodcatch\Modules\Approval\Http\Requests\BaseRequest;
use Goodcatch\Modules\Approval\Model\Admin\Category;
use Illuminate\Validation\Rule;

class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        $rules = [
            'pid' => 'integer|exclude_if:pid,0|exists:ap_categories,id|different:id',
            'code' => ['max:50', $this->uniqueOrExists (Category::class, 'code') . ':ap_categories'],
            'name' => ['required', 'max:50', $this->uniqueOrExists (Category::class, 'name') . ':ap_categories'],
            'short' => 'max:20',
            'alias' => 'max:20',
            'description' => 'max:255',
            'type' => 'integer',
            'order' => 'integer',
            'status' => [
                'required',
                Rule::in ([Category::STATUS_DISABLE, Category::STATUS_ENABLE])
            ]
        ];
        switch ($this->method()) {
            case 'GET':
                $rules = [
                    'pid' => 'integer|exclude_if:pid,0|exists:ap_categories,id'
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
            'pid.different'=>'上级部门不能是自己',
            'name.required' => '名称不能为空',
            'name.max' => '名称长度不能大于50',

        ];
    }
}
