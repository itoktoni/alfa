<?php

namespace Modules\Linen\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\OpnameStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\KotorFacades;
use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Models\Grouping;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Http\Requests\GeneralRequest;

class OpnameSaveRequest extends GeneralRequest
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
    }

    public function withValidator($validator)
    {
        $check = OpnameFacades::where('linen_opname_status', OpnameStatus::Proses)->where('linen_opname_company_id', request()->get('linen_opname_company_id'))->count();
        if ($check > 0) {

            $validator->after(function ($validator) {
                $validator->errors()->add('linen_opname_status', 'Tidak boleh lebih dari 1 Opname');
            });

        }
    }

    public function rules()
    {
        return [
            'linen_opname_company_id' => 'required',
            'linen_opname_date' => 'required',
            'linen_opname_status' => 'required',
        ];
    }
}
