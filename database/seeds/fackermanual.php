n<?php

use App\Dao\Facades\CompanyFacades;
use App\Dao\Models\Branch;
use App\Dao\Models\Company;
use bheller\ImagesGenerator\ImagesGeneratorProvider;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\Crm\Dao\Models\Customer;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Models\ProductDetail;
use Modules\Rajaongkir\Dao\Models\City;
use Modules\Rajaongkir\Facade\Area;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('id_ID');

        foreach (range(1, 50) as $index) {
            Customer::create([
                'crm_customer_name' => $faker->company,
                'crm_customer_contact_description' => $faker->text(100),
                'crm_customer_contact_address' => $faker->text(50),
                'crm_customer_contact_email' => $faker->email,
                'crm_customer_contact_phone' => $faker->phoneNumber,
                'crm_customer_contact_person' => $faker->name,
            ]);
        }

        foreach (range(1, 100) as $index) {

            Company::create([

                'company_contact_name' => $faker->company,
                'company_contact_description' => $faker->text(300),
                'company_contact_address' => $faker->address,
                'company_contact_email' => $faker->email,
                'company_contact_phone' => $faker->phoneNumber,
                'company_contact_person' => $faker->name,
            ]);
        }

        $com = CompanyFacades::dataRepository()->get();
        $data_area = Area::whereIn('rajaongkir_area_province_id',['6', '5', '3'])->get(10)->random();
        
        foreach ($data_area as $area) {

            $company = $com->random()->first();
            Branch::create([
                'branch_name' => 'Branch '.$faker->company,
                'branch_description' => $faker->text(200),
                'branch_company_id' => $company->company_id,
                'branch_address' => $faker->address,
                'branch_email' => $faker->companyEmail,
                'branch_phone' => $faker->phoneNumber,
                'branch_person' => $faker->name,
                'branch_rajaongkir_province_id' => $area->rajaongkir_area_province_id,
                'branch_rajaongkir_city_id' => $area->rajaongkir_area_city_id,
                'branch_rajaongkir_area_id' => $area->rajaongkir_area_id,
            ]);
        }

        foreach (range(1, 2) as $index) {

            $name = $faker->name;
            $slug = $faker->slug;

            $faker->addProvider(new ImagesGeneratorProvider($faker));
            $image = $faker->imageGenerator('public/files/product', 300, 400, 'jpg', false, $name, $faker->hexcolor, $faker->hexcolor);
            $save = Product::create([
                'item_product_slug' => $slug,
                'item_product_min_stock' => 1,
                'item_product_max_stock' => 1,
                'item_product_sku' => $faker->numberBetween(10000, 20000),
                'item_product_buy' => $faker->numberBetween(10000, 20000),
                'item_product_sell' => $faker->numberBetween(10000, 20000),
                'item_product_discount' => $faker->numberBetween(10000, 20000),
                'item_product_price' => $faker->numberBetween(100000, 700000),
                'item_product_stroke' => $faker->numberBetween(600000, 900000),
                'item_product_image' => $image,
                'item_product_item_sub_category_id' => null,
                'item_product_item_category_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6']),
                'item_product_item_brand_id' => $faker->randomElement(['1', '2', '3']),
                'item_product_item_tag_json' => json_encode($faker->randomElements([
                    'sepatu',
                    'tshirt',
                    'snickers',
                    'bantal',
                    'kasur',
                    'komputer',
                    'mainan',
                    'motor',
                    'meja',
                    'galon',
                    'sofa',
                    'kabel',
                    'usb',
                    'handphone',
                    'android',
                    'iphone',
                ], 4)),
                'item_product_name' => $name,
                'item_product_description' => $faker->text(600),
                'item_product_updated_at' => $faker->date('Y-m-d H:i:s'),
                'item_product_created_at' => $faker->date('Y-m-d H:i:s'),
                'item_product_deleted_at' => null,
                'item_product_updated_by' => 'faker',
                'item_product_created_by' => 'faker',
                'item_product_counter' => $faker->randomDigit,
                'item_product_status' => 1,
                'item_product_weight' => $faker->numberBetween(100, 900),
                'item_product_display' => 1,
                'item_product_stock' => $faker->numberBetween(100, 500),
                'item_product_min_order' => $faker->numberBetween(1, 10),
                'item_product_max_order' => 0,
                'item_product_flag_name' => $faker->word,
                'item_product_flag_color' => $faker->hexcolor,
                'item_product_flag_background' => $faker->hexcolor,
                'item_product_page_content_1' => $faker->text(1000),
                'item_product_page_content_2' => $faker->text(1000),
                'item_product_page_content_3' => $faker->text(1000),
                'item_product_page_name_1' => $faker->sentence(1),
                'item_product_page_name_2' => $faker->sentence(1),
                'item_product_page_name_3' => $faker->sentence(1),
                'item_product_page_active_3' => 1,
                'item_product_page_active_2' => 1,
                'item_product_page_active_1' => 1,
                'item_product_page_seo' => $faker->sentence(10),
                'item_product_sold' => $faker->numberBetween(50, 100),
                'item_product_is_variant' => 0,
            ]);

            for ($x = 1; $x <= 5; $x++) {

                $product_id = $save->item_product_id;
                $product_name = $save->item_product_name;
                $product_image = $save->item_detail_product_image;
                $product_slug = $save->item_detail_product_slug;

                $random_variant = $faker->numberBetween(1, 2);
                $variant_name = $random_variant == 1 ? '30cm' : '40cm';

                $random_branch = $faker->numberBetween(1, 4);
                if ($random_branch == 1) {
                    $location = 5;
                    $branch = 'Labways Indohitek';
                    $address = 'Bekasi';
                } elseif ($random_branch == 2) {

                    $location = 6;
                    $branch = 'Indo Inovasi Prima';
                    $address = 'Jakarta Timur';
                } elseif ($random_branch == 3) {

                    $location = 7;
                    $branch = 'Benline Optima';
                    $address = 'Tangerang';
                } elseif ($random_branch == 4) {

                    $location = 8;
                    $branch = 'Mitrais';
                    $address = 'Yogyakarta';
                } else {

                    $location = 1;
                    $branch = 'Maju Mundur';
                    $address = 'Planet Namex';
                }

                $random_color = $faker->numberBetween(1, 5);
                if ($random_color == 1) {
                    $color = 'BLUE';
                } elseif ($random_color == 2) {
                    $color = 'GREEN';
                } elseif ($random_color == 3) {
                    $color = 'RED';
                } elseif ($random_color == 4) {
                    $color = 'YELLOW';
                } elseif ($random_color == 5) {
                    $color = 'WHITE';
                }

                $size = 'Default';
                $random_size = $faker->randomElement(['S', 'M', 'L', 'XL']);
                if ($random_color == 'S') {
                    $size = 'Small';
                } elseif ($random_size == 'M') {
                    $size = 'Medium';
                } elseif ($random_size == 'L') {
                    $size = 'Large';
                } elseif ($random_size == 'XL') {
                    $size = 'Extra Large';
                }

                // ProductDetail::create([
                //     'item_detail_name' => $product_name,
                //     'item_detail_price' => $faker->numberBetween(10000, 20000),
                //     'item_detail_product_id' => $product_id,
                //     'item_detail_product_name' => $product_name,
                //     'item_detail_product_image' => $product_image,
                //     'item_detail_product_slug' => $product_slug,
                //     'item_detail_variant_id' => $random_variant,
                //     'item_detail_variant_name' => $variant_name,
                //     'item_detail_branch_id' => $random_branch,
                //     'item_detail_branch_name' => $branch,
                //     'item_detail_branch_address' => $address,
                //     'item_detail_branch_location' => $location,
                // ]);

                // ProductDetail::create([
                //     'item_detail_name' => $product_name,
                //     'item_detail_price' => $faker->numberBetween(10000, 20000),
                //     'item_detail_product_id' => $product_id,
                //     'item_detail_product_name' => $product_name,
                //     'item_detail_product_image' => $product_image,
                //     'item_detail_product_slug' => $product_slug,
                //     'item_detail_color_id' => $random_color,
                //     'item_detail_color_name' => $color,
                //     'item_detail_size_id' => $random_size,
                //     'item_detail_size_name' => $size,
                //     'item_detail_branch_id' => $random_branch,
                //     'item_detail_branch_name' => $branch,
                //     'item_detail_branch_address' => $address,
                //     'item_detail_branch_location' => $location,
                // ]);

                ProductDetail::create([
                    'item_detail_name' => $product_name,
                    'item_detail_price' => $faker->numberBetween(10000, 20000),
                    'item_detail_product_id' => $product_id,
                    'item_detail_product_name' => $product_name,
                    'item_detail_product_image' => $product_image,
                    'item_detail_product_slug' => $product_slug,
                    'item_detail_branch_id' => $random_branch,
                    'item_detail_branch_name' => $branch,
                    'item_detail_branch_address' => $address,
                    // 'item_detail_branch_location' => $location,
                ]);

                $faker->unique(true);
            }
        }

        // factory(Product::class, 500)->create();
    }
}
