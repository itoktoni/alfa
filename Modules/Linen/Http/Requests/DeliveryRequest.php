<?php

namespace Modules\Linen\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\GroupingDetailFacades;
use Modules\Linen\Dao\Models\Grouping;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Http\Requests\GeneralRequest;

class DeliveryRequest extends GeneralRequest
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
        $company = CompanyFacades::find($this->linen_delivery_company_id);

        $grouping = GroupingDetail::whereIn(GroupingDetailFacades::mask_barcode(), $this->barcode)->get();
        $data = $grouping->pluck(GroupingDetailFacades::mask_rfid())->unique() ?? [];
        $stock = $grouping->mapToGroups(function($item){
            return [$item->mask_product_id => $item];
        });
        
        $driver = User::find($this->linen_delivery_driver_id);

        $startDate = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d').' 13:00');
        $endDate = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d').' 23:59');

        $check = Carbon::now()->between($startDate, $endDate);
        $report_date = Carbon::now();
        if($check){
            $report_date = Carbon::now()->addDay(1);
        }

        $this->merge([
            'detail' => $data,
            'stock' => $stock,
            'linen_delivery_company_name' => $company->company_name ?? '',
            'linen_delivery_driver_name' => $driver->name ?? '',
            'linen_delivery_total' => count($grouping),
            'linen_delivery_total_detail' => count($data),
            'linen_delivery_reported_date' => $report_date->format('Y-m-d'),
        ]);
        
    }

    public function withValidator($validator)
    {
        // $validator->after(function ($validator) {
        //     $validator->errors()->add('system_action_code', 'The title cannot contain bad words!');
        // });
    }

    public function rules()
    {
        return [
            'linen_delivery_key' => 'required|unique:linen_delivery',
            'linen_delivery_company_id' => 'required|exists:system_company,company_id',
            'linen_delivery_status' => 'required',
            'barcode.*' => 'required|exists:linen_grouping,linen_grouping_barcode',
        ];
    }
}
