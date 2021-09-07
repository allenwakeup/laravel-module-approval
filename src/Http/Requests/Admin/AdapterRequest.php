<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Requests\Admin;



class AdapterRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'pid' => 'numeric|different:id|exists:ap_adapters,id',
            'category_id' => 'numeric',
            'code' => 'required|alpha_dash|max:20',
            'name' => 'required|max:50',
            'alias' => 'required|max:50',
            'description' => 'max:255',
            'group' => 'max:20',
            'payload' => 'required|json'
        ];
    }
}
