<?php

namespace Modules\Linen\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\KotorFacades;
use Modules\Linen\Dao\Models\Grouping;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Http\Requests\GeneralRequest;

class KotorRequest extends GeneralRequest
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
        $key = $this->linen_kotor_key;
        $session = $this->linen_kotor_session;
        $company = CompanyFacades::find($this->linen_kotor_company_id);
        $location = LocationFacades::find($this->linen_kotor_location_id);
        $linen = LinenFacades::dataRepository()
        ->whereIn(LinenFacades::mask_rfid(), $this->rfid)
        ->with([
            'has_company', 'has_location', 'has_product'
        ])->get();

        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen[LinenFacades::mask_rfid()] => $data_linen];
            });
        }

        $kotor = $linen->map(function ($item) use ($company, $location, $key) {
            $user = auth()->user();
            $description = LinenStatus::LinenKotor;
            if ($company->company_id != $item->item_linen_company_id) {

                $description = LinenStatus::BedaRs;
            }
            // else if($company->company_id == $item->mask_company_id && $location->location_id != $item->mask_location_id){

            //     $description = LinenStatus::BedaRuangan;
            // }
            $data = [

                'linen_kotor_detail_rfid' => $item->mask_rfid,
                'linen_kotor_detail_product_id' => $item->mask_product_id ?? '',
                'linen_kotor_detail_product_name' => $item->mask_product_name ?? '',
                'linen_kotor_detail_ori_company_id' => $item->mask_company_id ?? '',
                'linen_kotor_detail_ori_company_name' => $item->mask_company_name ?? '',
                'linen_kotor_detail_ori_location_id' => $item->mask_location_id ?? '',
                'linen_kotor_detail_ori_location_name' => $item->mask_location_name ?? '',
                'linen_kotor_detail_scan_company_id' => $company->company_id ?? '',
                'linen_kotor_detail_scan_company_name' => $company->company_name ?? '',
                'linen_kotor_detail_scan_location_id' => $location->location_id ?? '',
                'linen_kotor_detail_scan_location_name' => $location->location_name ?? '',
                'linen_kotor_detail_created_at' => date('Y-m-d H:i:s') ?? '',
                'linen_kotor_detail_created_by' => $user->id ?? '',
                'linen_kotor_detail_created_name' => $user->name ?? '',
                'linen_kotor_detail_key' => $key ?? '',
                'linen_kotor_detail_session' => $session ?? '',
                'linen_kotor_detail_description' => $description,
            ];

            return $data;
        })->toArray();

        $outstanding = $linen->map(function ($item) use ($company, $location, $key) {

            $user = auth()->user();

            $description = $this->{KotorFacades::mask_description()};
            if ($this->{KotorFacades::mask_status()} == TransactionStatus::Kotor) {

                if ($company->company_id != $item->item_linen_company_id) {

                    $description = LinenStatus::BedaRs;
                }
            }

            $data = [

                'linen_outstanding_rfid' => $item->mask_rfid,
                'linen_outstanding_product_id' => $item->mask_product_id ?? '',
                'linen_outstanding_product_name' => $item->mask_product_name ?? '',
                'linen_outstanding_ori_company_id' => $item->mask_company_id ?? '',
                'linen_outstanding_ori_company_name' => $item->mask_company_name ?? '',
                'linen_outstanding_ori_location_id' => $item->mask_location_id ?? '',
                'linen_outstanding_ori_location_name' => $item->mask_location_name ?? '',
                'linen_outstanding_scan_company_id' => $company->company_id ?? '',
                'linen_outstanding_scan_company_name' => $company->company_name ?? '',
                'linen_outstanding_scan_location_id' => $location->location_id ?? '',
                'linen_outstanding_scan_location_name' => $location->location_name ?? '',
                'linen_outstanding_created_at' => date('Y-m-d H:i:s') ?? '',
                'linen_outstanding_created_by' => $user->id ?? '',
                'linen_outstanding_created_name' => $user->name ?? '',
                'linen_outstanding_key' => $key ?? '',
                'linen_outstanding_session' => $session ?? '',
                'linen_outstanding_process' => TransactionStatus::Kotor ?? '',
                'linen_outstanding_status' => $this->{KotorFacades::mask_status()} ?? '',
                'linen_outstanding_description' => $description,
            ];

            return $data;
            
        })->toArray();

        $this->merge([
            'kotor' => $kotor,
            'outstanding' => $outstanding,
            'linen_kotor_company_name' => $company->company_name ?? '',
            'linen_kotor_location_name' => $location->location_name ?? '',
            'linen_kotor_total' => count($kotor),
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
            'linen_kotor_key' => 'required|unique:linen_kotor',
            'linen_kotor_status' => 'required',
            'linen_kotor_description' => 'required',
            'linen_kotor_company_id' => 'required|exists:system_company,company_id',
            'linen_kotor_location_id' => 'required|exists:system_location,location_id',
            'rfid.*' => 'required|exists:item_linen,item_linen_rfid|unique:linen_outstanding,linen_outstanding_rfid',
        ];
    }
}
