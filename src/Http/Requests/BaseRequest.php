<?php
/**
 * @author  Allen <ali@goodcatch.cn>
 */

namespace Goodcatch\Modules\Approval\Http\Requests;

use Goodcatch\Modules\Laravel\Http\Requests\CommonFormRequest as FormRequest;

class BaseRequest extends FormRequest
{

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance ()
    {
        $validator = parent::getValidatorInstance ();
        $validator->addCustomAttributes (__ ('approval::validation.attributes'));
        $validator->setCustomMessages (__ ('approval::validation.custom'));
        $validator->addCustomValues (__ ('approval::validation.values'));
        return $validator;
    }


}

