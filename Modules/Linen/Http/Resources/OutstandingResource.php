<?php

namespace Modules\Linen\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Linen\Dao\Facades\OutstandingFacades;

class OutstandingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $description = OutstandingFacades::mask_description();
        $status = OutstandingFacades::mask_status();
        
        return [
            'linen_outstanding_id' => $this->linen_outstanding_id,
            'linen_outstanding_rfid' => $this->linen_outstanding_rfid,
            'linen_outstanding_status' => $status[$this->linen_outstanding_status][0] ?? '',
            'linen_outstanding_created_at' => $this->linen_outstanding_created_at->format('Y-m-d H:i:s') ?? null,
            'linen_outstanding_created_by' => $this->linen_outstanding_created_by ?? null,
            'linen_outstanding_created_name' => $this->linen_outstanding_created_name ?? null,
            'linen_outstanding_scan_company_name' => $this->linen_outstanding_scan_company_name,
            'linen_outstanding_ori_company_name' => $this->linen_outstanding_ori_company_name,
            'linen_outstanding_product_name' => $this->linen_outstanding_product_name,
            // 'linen_outstanding_scan_location_name' => $this->linen_outstanding_scan_location_name,
            // 'linen_outstanding_ori_location_name' => $this->linen_outstanding_ori_location_name,
            'linen_outstanding_description' => $description[$this->linen_outstanding_description][0] ?? '',
            'linen_outstanding_session' => $this->linen_outstanding_session,
        ];
    }
}
