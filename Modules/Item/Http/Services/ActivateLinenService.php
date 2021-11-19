<?php

namespace Modules\Item\Http\Services;

use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Events\GantiChipLinenEvent;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Notes;

class ActivateLinenService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check['status'] = true;
        if($data->get('item_linen_status') != LinenStatus::GantiChip){

            $check = $repository->updateRepository($data->all(), $code);
        }
        else{

            GantiChipLinenEvent::dispatch($data->{LinenFacades::mask_rfid()}, $data->{LinenFacades::mask_old_rfid()}, $data->{LinenFacades::mask_company_id()}, $data->{LinenFacades::mask_location_id()}, $data->{LinenFacades::mask_product_id()}, $data->{LinenFacades::mask_rent()}, $data->{LinenFacades::mask_status()});
            $check = Notes::update($data->all());
        }

        if ($check['status']) {
            if(request()->wantsJson()){
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
