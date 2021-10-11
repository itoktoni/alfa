<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Item\Dao\Facades\LinenFacades;
use Faker\Factory as Faker;
use Modules\Item\Dao\Models\Product;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Models\Company;
use Modules\System\Dao\Models\Location;

class LinenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $user = User::all()->pluck('id');
        $product = Product::all();

        foreach (Company::whereIn('company_id', [626,627])->get() as $company) {

            $location = $company->locations;

            foreach($location as $loc){

                foreach($product as $prod){

                    foreach(range(1,100) as $index){

                        LinenFacades::create([
                            'item_linen_rfid' => $faker->numerify($company->company_id.'#####################'),
                            'item_linen_rent' => $faker->randomElement(array_keys(LinenFacades::rent())),
                            'item_linen_status' => $faker->randomElement(array_keys(LinenFacades::status())),
                            'item_linen_created_at' => $faker->date('Y-m-d H:i:s'),
                            'item_linen_location_id' => $loc->location_id,
                            'item_linen_company_id' => $company->company_id,
                            'item_linen_product_id' => $prod->item_product_id,
                            'item_linen_created_by' => $faker->randomElement($user),
                        ]);
                    }
                }
                
            }
            
        }

    }
}
