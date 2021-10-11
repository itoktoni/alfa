<?php

namespace Modules\Item\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
           'item_product_id' => $this->item_product_id,
           'item_product_name' => $this->item_product_name
       ];
    }
}
