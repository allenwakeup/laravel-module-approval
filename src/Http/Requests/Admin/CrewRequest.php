<?php

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;


use Goodcatch\Modules\Approval\Model\Admin\Crew;

class CrewRequest extends BaseRequest
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
                    'name' => 'required|max:50',
                    'team_id' => 'required|numeric|exists:ap_teams,id',
                    'condition' => 'required|max:20|in:' . implode(',', [
                            Crew::CONDITION_PARENT,
                            Crew::CONDITION_PEOPLE_ONE,
                            Crew::CONDITION_PEOPLE_ALL,
                            Crew::CONDITION_TAG,
                            Crew::CONDITION_COMBINE_ALL
                        ]),
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
