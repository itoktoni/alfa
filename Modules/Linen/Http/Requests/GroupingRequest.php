<?php

namespace Modules\Linen\Http\Requests;

use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\GroupingFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Http\Requests\GeneralRequest;

class GroupingRequest extends GeneralRequest
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
        $company = CompanyFacades::find($this->linen_grouping_company_id);
        $location = LocationFacades::find($this->linen_grouping_location_id);

        $linen = OutstandingFacades::dataRepository()->whereIn('linen_outstanding_rfid', $this->rfid)->get();
        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen['linen_outstanding_rfid'] => $data_linen];
            });
        }

        $validate = $linen->map(function ($item) use($company, $location) {

            $user = auth()->user();
            $data = [
                'linen_grouping_detail_rfid' => $item->mask_rfid,
                'linen_grouping_detail_product_id' => $item->mask_product_id ?? '',
                'linen_grouping_detail_product_name' => $item->mask_product_name ?? '',
                'linen_grouping_detail_barcode' => $this->{GroupingFacades::getKeyName()},
                'linen_grouping_detail_ori_company_id' => $item->mask_company_ori ?? '',
                'linen_grouping_detail_ori_company_name' => $item->mask_company_ori_name ?? '',
                'linen_grouping_detail_ori_location_id' => $item->mask_location_ori ?? '',
                'linen_grouping_detail_ori_location_name' => $item->mask_location_ori ?? '', 
                'linen_grouping_detail_scan_company_id' => $company->company_id ?? '',
                'linen_grouping_detail_scan_company_name' => $company->company_name ?? '',
                'linen_grouping_detail_scan_location_id' => $location->location_id ?? '',
                'linen_grouping_detail_scan_location_name' => $location->location_name ?? '',
                'linen_grouping_detail_created_at' => date('Y-m-d H:i:s') ?? '',
                'linen_grouping_detail_created_by' => $user->id ?? '',
                'linen_grouping_detail_created_name' => $user->name ?? '',
                'linen_grouping_detail_status' => $item->linen_outstanding_status ?? '',
                'linen_grouping_detail_description' => $item->linen_outstanding_description ?? '',
            ];

            return $data;

        })->toArray();

        $this->merge([  
            'detail' => $validate,
            'linen_grouping_company_name' => $company->company_name ?? '',
            'linen_grouping_location_name' => $location->location_name ?? '',
            'linen_grouping_total' => count($validate),
        ]);

    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $data = GroupingDetail::whereIn('linen_grouping_detail_rfid', $this->rfid)->whereNull('linen_grouping_detail_delivery')->get();
            if($data){
                foreach($data as $error){

                    $validator->errors()->add('linen_grouping_detail_rfid : ', 'RFID '.$error->linen_grouping_detail_rfid.' sudah masuk barcode : '.$error->linen_grouping_detail_barcode);
                }
            }
        });
    }

    public function rules()
    {
        return [
            'linen_grouping_barcode' => 'required|unique:linen_grouping',
            'linen_grouping_location_id' => 'required|exists:system_location,location_id',
            'linen_grouping_company_id' => 'required|exists:system_company,company_id',
            'linen_grouping_status' => 'required',
            'rfid.*' => 'required|exists:linen_outstanding,linen_outstanding_rfid',
        ];
    }
}
