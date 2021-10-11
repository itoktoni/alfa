<?php

namespace Modules\Item\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Item\Dao\Facades\CompanyProductFacades;
use Modules\System\Http\Requests\GeneralRequest;

class CompanyProductRequest extends GeneralRequest
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
        $check = false;
        if (request()->segment(3) == 'create' || ($this->old_company_id != $this->company_id) || ($this->old_product_id != $this->item_product_id)) {
            
            $check = CompanyProductFacades::where('item_product_id', $this->item_product_id)->where('company_id', $this->company_id)->count();
            if ($check) {

                $validator->after(function ($validator) {
                    $validator->errors()->add('item_product_id', 'Product sudah ada sebelumnya');
                });
            }
        }
    }

    public function rules()
    {
        return [
            'company_id' => 'required',
            'item_product_id' => 'required',
            'company_item_target' => 'required',
            'company_item_weight' => 'required',
            'company_item_price' => 'required',
        ];
    }
}
