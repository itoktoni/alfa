<?php

use App\Dao\Models\Branch;
use Illuminate\Database\Seeder;
use Modules\Rajaongkir\Dao\Models\Area;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data_area = Area::whereIn('rajaongkir_area_province_id', ['6', '5', '3'])->get()->random(5);
        foreach ($data_area as $area) {
            factory(Branch::class, 1)->create([
                'branch_rajaongkir_province_id' => $area->rajaongkir_area_province_id,
                'branch_rajaongkir_city_id' => $area->rajaongkir_area_city_id,
                'branch_rajaongkir_area_id' => $area->rajaongkir_area_id,
            ]);
        }

    }
}
