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
        $sync = $keys = [];
        // DATA GET FROM POST
        $data = collect(request()->get('data'));
        $rfid = $data->pluck("linen_rfid")->toArray();

        // // GET DATA FROM DATABASE AND MAP TO EACH LINEN
        $linen = LinenFacades::dataRepository()->whereIn(LinenFacades::mask_rfid(), $rfid)->with([
            'has_company', 'has_location', 'has_product'
        ])->get();

        if ($data) {

            foreach ($data as $value) {

                $first_linen = $linen->firstWhere('item_linen_rfid', $value['linen_rfid']);
                if($first_linen){

                    $sync[$value['linen_rfid']] = [
                        'linen_opname_detail_rfid' => $value['linen_rfid'],
                        'linen_opname_detail_key' => $value['linen_key'],
                        'linen_opname_detail_product_id' => $first_linen->item_linen_product_id,
                        'linen_opname_detail_product_name' => $first_linen->item_linen_product_name,
                        'linen_opname_detail_ori_company_id' => $first_linen->item_linen_company_id,
                        'linen_opname_detail_ori_company_name' => $first_linen->item_linen_company_name,
                        'linen_opname_detail_ori_location_id' => $first_linen->item_linen_location_id,
                        'linen_opname_detail_ori_location_name' => $first_linen->item_linen_location_name,
                        'linen_opname_detail_scan_company_id' => $value['linen_company_id'],
                        'linen_opname_detail_scan_company_name' => $value['linen_company_name'],
                        'linen_opname_detail_scan_location_id' => $value['linen_location_id'],
                        'linen_opname_detail_scan_location_name' => $value['linen_location_name'],
                        'linen_opname_detail_scaned_by' => auth()->user()->id,
                        'linen_opname_detail_scaned_name' => auth()->user()->name,
                    ];

                    $keys[$value['linen_key']] = $value['linen_key'];
                }
            }
        }

        $this->merge([
            'sync' => $sync,
            'detail' => $data,
            'keys' => $keys,
        ]);
    }


    public function rules()
    {
        return [
            'data' => 'required',
        ];
    }
}
