<?php

namespace Modules\System\Http\Services;

use Illuminate\Validation\Rule;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class DeleteService
{
    public function delete(CrudInterface $repository, $code)
    {
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

        return $check;
    }
}
