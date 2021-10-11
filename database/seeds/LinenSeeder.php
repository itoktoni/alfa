<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Item\Dao\Models\Linen;

class LinenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Linen::factory(1)->create([
        //     'item_linen_created_by' => 1
        // ]);

        // Linen::create([
        //     'item_linen_created_by' => 1
        // ]);

        factory(Linen::class, 1)->create();

    }
}
