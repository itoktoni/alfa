<?php

namespace Modules\Item\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Item\Dao\Enums\RegisterStatus;
use Modules\Item\Dao\Enums\RentStatus;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;

class LinenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'item_linen_rfid' => $this->item_linen_rfid,
           'item_product_name' => $this->item_linen_product_name,
           'company_id' => $this->item_linen_company_id,
           'company_name' => $this->item_linen_company_name,
           'location_id' => $this->item_linen_location_id,
           'location_name' => $this->item_linen_location_name,
           'item_linen_rent' => LinenStatus::getDescription($this->item_linen_rent) ?? '',
           'item_linen_status' => LinenStatus::getDescription($this->item_linen_status) ?? '',
           'item_linen_session' => $this->item_linen_session,
           'item_linen_created_at' => $this->item_linen_created_at->format('Y-m-d H:i:s') ?? null,
       ];
    }
}
