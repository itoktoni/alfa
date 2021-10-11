<?php

namespace Modules\Linen\Http\Requests;

use Modules\Item\Dao\Facades\LinenFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Http\Requests\GeneralRequest;

class OutstandingBatchUpdateRequest extends GeneralRequest
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
        $session = $this->linen_outstanding_session ?? false;
        $status = $this->linen_outstanding_status ?? false;
        $company = $this->linen_outstanding_scan_company_id ?? false;
        $location = $this->linen_outstanding_scan_location_id ?? false;

        $linen = LinenFacades::dataRepository()->whereIn('item_linen_rfid', $this->data)->get();
        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen['item_linen_rfid'] => $data_linen];
            });
        }

        $validate = collect($this->data)->mapWithKeys(function ($item) use ($linen, $company, $location, $session, $status) {

            $user_id = auth()->user()->id;
            $data = [
                'linen_outstanding_rfid' => $item,
                'linen_outstanding_created_at' => now(),
                'linen_outstanding_updated_at' => now(),
                'linen_outstanding_updated_by' => $user_id,
                'linen_outstanding_created_by' => $user_id,
            ];

            if ($company) {

                $data_company = CompanyFacades::find($this->linen_outstanding_scan_company_id);

                $data = array_merge($data, [
                    'linen_outstanding_scan_company_id' => $data_company->company_id ?? '',
                    'linen_outstanding_scan_company_name' => $data_company->company_name ?? 'Beda Rumah Sakit',
                ]);
            }

            if ($location) {

                $data_location = LocationFacades::find($this->linen_outstanding_scan_location_id);

                $data = array_merge($data, [
                    'linen_outstanding_scan_location_id' => $data_location->location_id ?? '',
                    'linen_outstanding_scan_location_name' => $data_location->location_name ?? 'Beda Location',
                ]);
            }

            if ($status) {

                $data = array_merge($data, [
                    'linen_outstanding_status' => $status ?? '',
                ]);
            }

            if($session){

                $data = array_merge($data, [
                    'linen_outstanding_session' => $session,
                ]);
            }

            if (isset($linen[$item])) {

                $slinen = $linen[$item];

                if ($slinen->company_id != $company) {
                    $data = array_merge($data, [
                        'linen_outstanding_description' => 2,
                    ]);
                } else if ($slinen->location_id != $location) {
                    $data = array_merge($data, [
                        'linen_outstanding_description' => 3,
                    ]);
                } else {
                    $data = array_merge($data, [
                        'linen_outstanding_description' => 1,
                    ]);
                }
                $data = array_merge($data, [
                    'linen_outstanding_product_id' => $slinen->item_linen_product_id ?? '',
                    'linen_outstanding_product_name' => $slinen->product->item_product_name ?? '',
                    'linen_outstanding_ori_location_id' => $slinen->location_id,
                    'linen_outstanding_ori_location_name' => $slinen->location_name ?? '',
                    'linen_outstanding_ori_company_id' => $slinen->company_id ?? '',
                    'linen_outstanding_ori_company_name' => $slinen->company_name ?? '',
                ]);

            } else {
                $data = array_merge($data, [
                    'linen_outstanding_description' => 2,
                ]);
            }

            return [$item => $data];
        })->toArray();


        $this->merge([
            'detail' => $validate ?? [],
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
            'linen_outstanding_status' => 'required|in:1,2,3',
            'data.*' => 'required|exists:item_linen,item_linen_rfid',
        ];
    }
}
