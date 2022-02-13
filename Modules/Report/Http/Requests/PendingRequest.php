<?php

namespace Modules\Report\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\System\Http\Requests\GeneralRequest;

class PendingRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    private $rules;
    private $model;

    public function prepareForValidation()
    {
        $this->merge([
            // 'content' => ''
        ]);
    }

    public function withValidator($validator)
    {
        // $validator->after(function ($validator) {
        //     $validator->errors()->add('system_action_code', 'The title cannot contain bad words!');
        // });
    }

    public function rules()
    {
        return [
            'linen_outstanding_ori_company_id' => 'required',
            'linen_outstanding_status' => 'required',
        ];
    }
}
