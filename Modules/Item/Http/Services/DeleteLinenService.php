<?php

namespace Modules\Item\Http\Services;

use Exception;
use Illuminate\Validation\Rule;
use Modules\Item\Dao\Models\LinenDetail;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Models\Outstanding;
use Modules\System\Dao\Enums\GroupUserStatus;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Plugins\Alert;

class DeleteLinenService extends DeleteService
{
    public function delete(CrudInterface $repository, $code)
    {
        $check = false;
        if(!in_array(auth()->user()->group_user, [GroupUserStatus::Owner, GroupUserStatus::Developer, GroupUserStatus::Administrator])){
            Alert::error('Delete Harus Pak Bos');
        }
        else{
            $rules = ['code' => 'required'];
            request()->validate($rules, ['code.required' => 'Please select any data !']);
            $check = $repository->deleteRepository($code);

            LinenDetail::whereIn('item_linen_detail_rfid', $code)->delete();
            GroupingDetail::whereIn('linen_grouping_detail_rfid', $code)->delete();
            KotorDetail::whereIn('linen_kotor_detail_rfid', $code)->delete();
            OpnameDetail::whereIn('linen_opname_detail_rfid', $code)->delete();
            Outstanding::whereIn('linen_outstanding_rfid', $code)->delete();

            if ($check['status']) {

                if (request()->wantsJson()) {
                    return response()->json($check)->getData();
                }

                Alert::delete();
            } else {
                Alert::error($check['data']);
            }
        }


        return $check;
    }
}
