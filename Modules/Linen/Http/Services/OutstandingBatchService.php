<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\Log;
use Modules\Linen\Dao\Facades\MasterOutstandingFacades;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Notes;

class OutstandingBatchService
{
    public function save($repository, $data)
    {
        $check = false;
        try {
            $exists = $repository->batchSelectRepository(array_keys($data->detail))->get();

            if(!empty($exists)){
                $data_rfid = $exists->pluck('linen_outstanding_rfid');
                $repository->batchDeleteRepository($data_rfid);
            }

            $check = $repository->batchSaveRepository($data->detail);

            if(isset($check['status']) && $check['status']){

                Alert::create($data->detail);
            }
            else{

                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }

    public function update($repository, $data)
    {
        $where = $data->data;

        Log::error($data);

        if (!is_array($where)) {
            $where = [$data->data];
        }

        $update = $data->all();
        unset($update['rfid']);
        unset($update['type']);
        $pull = $repository->WhereIn('linen_outstanding_rfid', $where);
        $check = $pull->update($update);
        if ($check) {
            if(request()->wantsJson()){
                $notes = Notes::update($data->all());
                return response()->json($notes)->getData();
            }

            Alert::update();

        } else {

            return Notes::error($data);
            Alert::error($data);
        }
        return $check;
    }
}
