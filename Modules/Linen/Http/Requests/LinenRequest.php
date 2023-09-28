<?php

namespace Modules\Linen\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\System\Http\Requests\GeneralRequest;

class LinenRequest extends GeneralRequest
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
            'item_linen_rfid.*' => 'required|unique:item_linen,item_linen_rfid',
        ];
    }
}
