<?php

namespace Modules\Linen\Http\Requests;

use Modules\Item\Dao\Facades\LinenFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Http\Requests\GeneralRequest;

class OpnameRequest extends GeneralRequest
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
        $company = CompanyFacades::find($this->linen_opname_company_id);
        $linen = LinenFacades::dataRepository()->whereIn('item_linen_rfid', $this->rfid)->with([
            'company', 'location', 'product'
        ])->get();

        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen['item_linen_rfid'] => $data_linen];
            });
        }

        $validate = $linen->map(function ($item) use($company) {

            $user = auth()->user();
            $data = [

                'linen_opname_detail_rfid' => $item->item_linen_rfid,
                'linen_opname_detail_product_id' => $item->product->item_product_id ?? '',
                'linen_opname_detail_product_name' => $item->product->item_product_name ?? '',
                'linen_opname_detail_key' => $this->linen_opname_key,
                'linen_opname_detail_company_id' => $item->company->company_id ?? '',
                'linen_opname_detail_company_name' => $item->company->company_name ?? '',
                'linen_opname_detail_location_id' => $item->location->location_id ?? '',
                'linen_opname_detail_location_name' => $item->location->location_name ?? '', 
            ];

            return $data;

        })->toArray();

        $this->merge([  
            'detail' => $validate,
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
            'linen_opname_key' => 'required|exists:linen_opname',
            'linen_opname_company_id' => 'required|exists:system_company,company_id',
            'linen_opname_status' => 'required|in:2,3',
        ];
    }
}
