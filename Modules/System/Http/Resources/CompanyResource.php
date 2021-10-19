<?php

namespace Modules\System\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Http\Resources\ProductResource;
use Modules\System\Plugins\Views;
use ProductSeeder;

class CompanyResource extends JsonResource
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
            'company_id' => $this->company_id,
            'company_name' => $this->company_name,
            'locations' => LocationResource::collection($this->has_location),
            'products' => ProductResource::collection($this->has_product),
        ];
    }
}
