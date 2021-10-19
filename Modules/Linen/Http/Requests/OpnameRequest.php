<?php

namespace Modules\Linen\Http\Requests;

use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
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
        $linen = LinenFacades::dataRepository()
        ->whereIn(LinenFacades::getKeyName(), $this->rfid)->get();

        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen[LinenFacades::mask_rfid()] => $data_linen];
            });
        }

        $validate = $linen->map(function ($item){

            $user = auth()->user();

            $data = [
                'linen_opname_detail_key' => $this->{OpnameFacades::getKeyName()},
                'linen_opname_detail_rfid' => $item->mask_rfid,
                'linen_opname_detail_company_id' => $item->mask_company_id ?? '',
                'linen_opname_detail_company_name' => $item->mask_company_name ?? '',
                'linen_opname_detail_location_id' => $item->mask_location_id ?? '',
                'linen_opname_detail_location_name' => $item->mask_location_name ?? '', 
                'linen_opname_detail_product_id' => $item->mask_product_id ?? '',
                'linen_opname_detail_product_name' => $item->mask_product_name ?? '',
            ];

            return $data;

        })->toArray();

        $this->merge([  
            'detail' => $validate,
            'linen_opname_total' => count($validate),
        ]);

    }

    public function withValidator($validator)
    {
        // $validator->after(function ($validator) {

        //     $data = OpnameDetail::whereIn('linen_opname_detail_rfid', $this->rfid)->whereNull('linen_opname_detail_delivery')->get();
        //     if($data){
        //         foreach($data as $error){

        //             $validator->errors()->add('linen_opname_detail_rfid : ', 'RFID '.$error->linen_opname_detail_rfid.' sudah masuk barcode : '.$error->linen_opname_detail_barcode);
        //         }
        //     }
        // });
    }

    public function rules()
    {
        return [
            'linen_opname_key' => 'required',
            'linen_opname_location_id' => 'required|exists:system_location,location_id',
            'linen_opname_company_id' => 'required|exists:system_company,company_id',
            'rfid.*' => 'required',
        ];
    }
}
