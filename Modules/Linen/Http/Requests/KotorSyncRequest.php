<?php

namespace Modules\Linen\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\ResponseStatus;
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

        // // GET DATA FROM DATABASE AND MAP TO EACH LINEN
        $linen = LinenFacades::dataRepository()->whereIn(LinenFacades::mask_rfid(), $rfid)->with([
            'has_company', 'has_location', 'has_product'
        ])->get();

        if ($linen) {
            $linen = $linen->mapWithKeys(function ($data_linen) {
                return [$data_linen[LinenFacades::mask_rfid()] => $data_linen];
            });
        }

        $list_outstanding = OutstandingFacades::dataRepository()->whereIn(OutstandingFacades::mask_rfid(), $rfid)->get();

        if ($list_outstanding) {
            $list_outstanding = $list_outstanding->mapWithKeys(function ($data_outstanding) {
                return [$data_outstanding[OutstandingFacades::mask_rfid()] => $data_outstanding];
            });
        }

        foreach ($data as $mapping) {

            $rfid_key = $mapping['linen_rfid'];
            $item = $linen[$rfid_key] ?? false;
            $description = $mapping['linen_description_id'];
            $form = $mapping['linen_form_id'];

            $mapping['linen_status'] = ResponseStatus::Failed;
            $sync[$rfid_key] = $mapping;

            if ($item) {

                $user = auth()->user();
                if ($form == TransactionStatus::Kotor && $mapping['linen_company_id'] != $item->item_linen_company_id) {
                    $description = LinenStatus::BedaRs;
                }

                if (isset($list_outstanding[$rfid_key])) {

                    $mapping['linen_status'] = ResponseStatus::Exists;
                    $sync[$rfid_key] = $mapping;
                    
                } else {
                    
                    $mapping['linen_status'] = ResponseStatus::Create;
                    $sync[$rfid_key] = $mapping;

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
                        'linen_kotor_detail_form' => $form ?? '',
                        'linen_kotor_detail_description' => $description,
                        'linen_kotor_detail_group' => $mapping['linen_key'] . $mapping['linen_company_id'] . $mapping['linen_location_id'] . $form . $description
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
                        'linen_outstanding_updated_at' => date('Y-m-d H:i:s') ?? '',
                        'linen_outstanding_created_by' => $user->id ?? '',
                        'linen_outstanding_updated_by' => $user->id ?? '',
                        'linen_outstanding_created_name' => $user->name ?? '',
                        'linen_outstanding_key' => $mapping['linen_key'] ?? '',
                        'linen_outstanding_process' => TransactionStatus::Kotor ?? '',
                        'linen_outstanding_status' => $mapping['linen_form_id'] ?? '',
                        'linen_outstanding_description' => $description,
                    ];
                }
            }
            else{

                $mapping['linen_status'] = ResponseStatus::Unknown;
                $sync[$rfid_key] = $mapping;
            }
        }

        if ($detail_kotor) {

            // GROUPING INTO KEY
            $group = collect($detail_kotor)->mapToGroups(function ($item) {
                return [$item['linen_kotor_detail_key'] . $item['linen_kotor_detail_scan_company_id'] . $item['linen_kotor_detail_scan_location_id'] . $item['linen_kotor_detail_form'] . $item['linen_kotor_detail_description'] => $item];
            });

            foreach ($group as $key => $fix_linen) {
                $request[$key]["linen_kotor_group"] = $key;
                $request[$key]["linen_kotor_key"] = $fix_linen[0]['linen_kotor_detail_key'];
                $request[$key]["linen_kotor_status"] = $fix_linen[0]['linen_kotor_detail_form'];
                $request[$key]["linen_kotor_description"] = $fix_linen[0]['linen_kotor_detail_description'];
                $request[$key]["linen_kotor_company_id"] = $fix_linen[0]['linen_kotor_detail_scan_company_id'];
                $request[$key]["linen_kotor_company_name"] = $fix_linen[0]['linen_kotor_detail_scan_company_name'];
                $request[$key]["linen_kotor_location_id"] = $fix_linen[0]['linen_kotor_detail_scan_location_id'];
                $request[$key]["linen_kotor_location_name"] = $fix_linen[0]['linen_kotor_detail_scan_location_name'];
                $request[$key]["detail"] = $fix_linen->toArray();
            }
        }

        // $list_rfid = collect($sync);
        // $map = $list_rfid->map(function($item){

        //     $send['linen_rfid'] = strval($item['linen_rfid']);
        //     $send['linen_status'] = $item['linen_status'];
        //     return $send;
        // });
        // dd($map->values()->toArray());

        $this->merge([
            'kotor' => $request,
            'outstanding' => $data_outstanding,
            'sync' => $sync
        ]);
    }


    public function rules()
    {
        return [
            'data' => 'required',
        ];
    }
}
