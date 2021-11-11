<?php

namespace Modules\Linen\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\KotorFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Models\Grouping;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Http\Requests\GeneralRequest;

class KotorSyncRequest extends GeneralRequest
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
        $request = $grouping = $sync = $detail_kotor = $data_outstanding = [];
        // DATA GET FROM POST
        $data = collect(request()->get('data'));
        $rfid = $data->pluck("linen_rfid")->toArray();

        // GET DATA FROM DATABASE AND MAP TO EACH LINEN
        $linen = LinenFacades::dataRepository()->whereIn(LinenFacades::mask_rfid(), $rfid)->with([
            'has_company', 'has_location', 'has_product'
        ])->get();

        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen[LinenFacades::mask_rfid()] => $data_linen];
            });
        }

        foreach ($data as $mapping) {

            $item = $linen[$mapping['linen_rfid']] ?? false;
            if ($item) {

                $user = auth()->user();
                $description = LinenStatus::LinenKotor;
                if ($mapping['linen_company_id'] != $item->item_linen_company_id) {
                    $description = LinenStatus::BedaRs;
                }

                $detail_kotor[] = [

                    'linen_kotor_detail_rfid' => $item->mask_rfid,
                    'linen_kotor_detail_product_id' => $item->mask_product_id ?? '',
                    'linen_kotor_detail_product_name' => $item->mask_product_name ?? '',
                    'linen_kotor_detail_ori_company_id' => $item->mask_company_id ?? '',
                    'linen_kotor_detail_ori_company_name' => $item->mask_company_name ?? '',
                    'linen_kotor_detail_ori_location_id' => $item->mask_location_id ?? '',
                    'linen_kotor_detail_ori_location_name' => $item->mask_location_name ?? '',
                    'linen_kotor_detail_scan_company_id' => $mapping['linen_company_id'] ?? '',
                    'linen_kotor_detail_scan_company_name' => $mapping['linen_company_name'] ?? '',
                    'linen_kotor_detail_scan_location_id' => $mapping['linen_location_id'] ?? '',
                    'linen_kotor_detail_scan_location_name' => $mapping['linen_location_name'] ?? '',
                    'linen_kotor_detail_created_at' => date('Y-m-d H:i:s') ?? '',
                    'linen_kotor_detail_created_by' => $user->id ?? '',
                    'linen_kotor_detail_created_name' => $user->name ?? '',
                    'linen_kotor_detail_key' => $mapping['linen_key'] ?? '',
                    'linen_kotor_detail_form' => $mapping['linen_form_id'] ?? '',
                    'linen_kotor_detail_description' => $description,
                ];

                $data_outstanding[] = [

                    'linen_outstanding_rfid' => $item->mask_rfid,
                    'linen_outstanding_product_id' => $item->mask_product_id ?? '',
                    'linen_outstanding_product_name' => $item->mask_product_name ?? '',
                    'linen_outstanding_ori_company_id' => $item->mask_company_id ?? '',
                    'linen_outstanding_ori_company_name' => $item->mask_company_name ?? '',
                    'linen_outstanding_ori_location_id' => $item->mask_location_id ?? '',
                    'linen_outstanding_ori_location_name' => $item->mask_location_name ?? '',
                    'linen_outstanding_scan_company_id' => $mapping['linen_company_id'] ?? '',
                    'linen_outstanding_scan_company_name' => $mapping['linen_company_name'] ?? '',
                    'linen_outstanding_scan_location_id' => $mapping['linen_location_id'] ?? '',
                    'linen_outstanding_scan_location_name' => $mapping['linen_location_name'] ?? '',
                    'linen_outstanding_created_at' => date('Y-m-d H:i:s') ?? '',
                    'linen_outstanding_created_by' => $user->id ?? '',
                    'linen_outstanding_created_name' => $user->name ?? '',
                    'linen_outstanding_key' => $mapping['linen_key'] ?? '',
                    'linen_outstanding_process' => TransactionStatus::Kotor ?? '',
                    'linen_outstanding_status' => $mapping['linen_form_id'] ?? '',
                    'linen_outstanding_description' => $description,
                ];
            }
        }

        if ($detail_kotor) {

            // GROUPING INTO KEY
            $group = collect($detail_kotor)->mapToGroups(function ($item) {
                return [$item['linen_kotor_detail_key'] => $item];
            });

            foreach ($group as $key => $fix_linen) {
                $request[$key]["linen_kotor_key"] = $key;
                $request[$key]["linen_kotor_status"] = $fix_linen[0]['linen_kotor_detail_form'];
                $request[$key]["linen_kotor_description"] = $fix_linen[0]['linen_kotor_detail_description'];
                $request[$key]["linen_kotor_company_id"] = $fix_linen[0]['linen_kotor_detail_scan_company_id'];
                $request[$key]["linen_kotor_location_id"] = $fix_linen[0]['linen_kotor_detail_scan_location_id'];
                $request[$key]["detail"] = $fix_linen->toArray();
            }
        }

        $outstanding_search = OutstandingFacades::select(OutstandingFacades::mask_rfid())->whereIn(OutstandingFacades::mask_rfid(), $rfid)->get();
        $pluck = $outstanding_search->pluck(OutstandingFacades::mask_rfid())->toArray();
        if($pluck){

            $data_outstanding = collect($data_outstanding)->whereNotIn(OutstandingFacades::mask_rfid(), $pluck)->toArray();
        }

        $this->merge([
            'kotor' => $request,
            'outstanding' => $data_outstanding,
        ]);
    }


    public function rules()
    {
        return [
            'data' => 'required',
        ];
    }
}
