<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Validation\Rule;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Models\OutstandingLock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class OpnameDeleteService
{
    public function delete(CrudInterface $repository, $code)
    {
        $rules = ['code' => 'required'];
        request()->validate($rules, ['code.required' => 'Please select any data !']);
        $check = $repository->deleteRepository($code);

        OpnameDetail::whereIn('linen_opname_detail_key', $code)->delete();
        OutstandingLock::whereIn('linen_outstanding_opname', $code)->delete();

        if ($check['status']) {

            if (request()->wantsJson()) {
                return response()->json($check)->getData();
            }

            Alert::delete();
        } else {
            Alert::error($check['data']);
        }

        return $check;
    }
}
