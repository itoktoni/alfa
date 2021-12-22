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

        // if ($data) {

        //     // GROUPING INTO KEY
        //     $group = collect($data)->mapToGroups(function ($item) {
        //         return [$item['linen_key'] . $item['linen_company_id'] . $item['linen_location_id'] . $item['linen_form_id'] . $item['linen_description_id'] => $item];
        //     });
        //     foreach ($group as $key => $fix_linen) {
        //         $request[$key]["linen_opname_batch"] = $key;
        //         $request[$key]["linen_opname_key"] = $fix_linen[0]['linen_kotor_detail_key'];
        //         $request[$key]["linen_opname_status"] = $fix_linen[0]['linen_kotor_detail_form'];
        //         $request[$key]["linen_opname_company_id"] = $fix_linen[0]['linen_kotor_detail_scan_company_id'];
        //         $request[$key]["linen_opname_company_name"] = $fix_linen[0]['linen_kotor_detail_scan_company_name'];
        //         $request[$key]["linen_opname_location_id"] = $fix_linen[0]['linen_kotor_detail_scan_location_id'];
        //         $request[$key]["linen_opname_location_name"] = $fix_linen[0]['linen_kotor_detail_scan_location_name'];
        //         $request[$key]["detail"] = $fix_linen->toArray();
        //     }
        // }

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
