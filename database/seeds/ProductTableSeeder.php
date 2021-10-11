<?php

use Illuminate\Database\Seeder;
use Modules\Item\Dao\Models\Product;
use Modules\Rajaongkir\Facade\Area;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 24)->create();
    }
}
