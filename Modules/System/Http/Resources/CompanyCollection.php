<?php

namespace Modules\System\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Item\Dao\Enums\RegisterStatus;
use Modules\Item\Dao\Enums\RentStatus;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\ReturStatus;
use Modules\Linen\Dao\Enums\RewashStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\ReturFacades;
use Modules\Linen\Dao\Facades\ReturnFacades;
use Modules\Linen\Dao\Facades\RewashFacades;

class CompanyCollection extends ResourceCollection
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
                'form' => [
                    [
                        'id' => TransactionStatus::Kotor,
                        'name' => TransactionStatus::getDescription(TransactionStatus::Kotor),
                        'data' => [
                            [
                                'id' => LinenStatus::LinenKotor,
                                'name' => LinenStatus::getDescription(LinenStatus::LinenKotor)
                            ]
                        ]
                    ],
                    [
                        'id' => TransactionStatus::Retur,
                        'name' => TransactionStatus::getDescription(TransactionStatus::Retur),
                        'data' => [
                            [
                                'id' => LinenStatus::LinenRusak,
                                'name' => LinenStatus::getDescription(LinenStatus::LinenRusak)
                            ],
                            [
                                'id' => LinenStatus::ChipRusak,
                                'name' => LinenStatus::getDescription(LinenStatus::ChipRusak)
                            ],
                            [
                                'id' => LinenStatus::KelebihanStock,
                                'name' => LinenStatus::getDescription(LinenStatus::KelebihanStock)
                            ],
                        ]
                    ],
                    [
                        'id' => TransactionStatus::Rewash,
                        'name' => TransactionStatus::getDescription(TransactionStatus::Rewash),
                        'data' => [
                            [
                                'id' => LinenStatus::Bernoda,
                                'name' => LinenStatus::getDescription(LinenStatus::Bernoda)
                            ],
                            [
                                'id' => LinenStatus::BahanUsang,
                                'name' => LinenStatus::getDescription(LinenStatus::BahanUsang)
                            ],
                        ],
                    ]
                ],
                'rental' => collect(LinenStatus::getOptions([
                    LinenStatus::Rental, LinenStatus::Cuci
                ]))->map(function ($item, $key) {
                    return ['id' => strval($key), 'name' => $item];
                })->toArray(),
                'retur' => collect(LinenStatus::getOptions([
                    LinenStatus::ChipRusak, LinenStatus::LinenRusak, LinenStatus::KelebihanStock
                ]))->map(function ($item, $key) {
                    return ['id' => strval($key), 'name' => $item];
                })->toArray(),
                'rewash' => collect(LinenStatus::getOptions([
                    LinenStatus::Bernoda, LinenStatus::BahanUsang
                ]))->map(function ($item, $key) {
                    return ['id' => strval($key), 'name' => $item];
                })->toArray(),
                'status' => collect(LinenStatus::getOptions([
                    LinenStatus::Register, LinenStatus::GantiChip
                ]))->map(function ($item, $key) {
                    return ['id' => strval($key), 'name' => $item];
                })->toArray(),
                'data' => $this->collection,
            ]
        ];
    }
}
