<?php

namespace Modules\Item\Http\Services;

use Exception;
use Illuminate\Validation\Rule;
use Modules\System\Dao\Enums\GroupUserStatus;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Plugins\Alert;

class DeleteLinenService extends DeleteService
{
    public function delete(CrudInterface $repository, $code)
    {
        $check = false;
        if(auth()->user()->group_user != GroupUserStatus::Owner){
            Alert::error('Delete Harus Pak Bos');            
        }
        else{
            $rules = ['code' => 'required'];
            request()->validate($rules, ['code.required' => 'Please select any data !']);
            $check = $repository->deleteRepository($code);
    
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
