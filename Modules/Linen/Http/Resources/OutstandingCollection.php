<?php

namespace Modules\Linen\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Linen\Dao\Facades\OutstandingFacades;

class OutstandingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status' => true,
            'code' => 200,
            'name' => 'list',
            'message' => 'Data berhasil di ambil',
            'data' => [
                'total' => $this->collection->count(),
                'data' => $this->collection,
            ]
        ];
    }
}
