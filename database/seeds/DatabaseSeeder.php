<?php

use App\Dao\Models\Branch;
use Illuminate\Database\Seeder;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Models\ProductDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(GroupModuleConnectionModuleTableSeeder::class);
        // $this->call(GroupModulesTableSeeder::class);
        // $this->call(GroupUserConnectionGroupModuleTableSeeder::class);
        // $this->call(GroupUsersTableSeeder::class);
        // $this->call(ModuleConnectionActionTableSeeder::class);
        // $this->call(ModulesTableSeeder::class);
        // $this->call(ActionsTableSeeder::class);

        // Company::query()->delete();
        Branch::query()->delete();
        Product::query()->delete();
        ProductDetail::query()->delete();

        // $this->call(CompanyTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(BranchTableSeeder::class);

        $data_product = Product::all();
        $data_branch = Branch::all();

        foreach ($data_branch as $branch) {
            foreach ($data_product as $product) {

                $data = [
                    'item_detail_name' => $product->item_product_name,
                    'item_detail_product_id' => $product->item_product_id,
                    'item_detail_product_name' => $product->item_product_name,
                    'item_detail_product_image' => $product->item_product_image,
                    'item_detail_product_slug' => $product->item_product_slug,
                    'item_detail_branch_id' => $branch->branch_id,
                    'item_detail_branch_name' => $branch->branch_name,
                    'item_detail_branch_address' => $branch->branch_address,
                    'item_detail_branch_province_id' => $branch->branch_rajaongkir_province_id,
                    'item_detail_branch_city_id' => $branch->branch_rajaongkir_city_id,
                    'item_detail_branch_area_id' => $branch->branch_rajaongkir_area_id,
                ];

                $color_id = null;
                $color_name = null;

                $size_id = null;
                $size_name = null;

                $variant_id = null;
                $variant_name = null;

                if ($product->item_product_price % 2 == 0) {

                    $color_id = collect([1, 2, 3, 4, 5])->random();
                    $color_name = 'DEFAULT';

                    if ($color_id == 1) {
                        $color_name = 'BLUE';
                    } elseif ($color_id == 2) {
                        $color_name = 'GREEN';
                    } elseif ($color_id == 3) {
                        $color_name = 'RED';
                    } elseif ($color_id == 4) {
                        $color_name = 'YELLOW';
                    } elseif ($color_id == 5) {
                        $color_name = 'WHITE';
                    }

                    $size_name = 'Default';
                    $size_id = collect(['S', 'M', 'L', 'XL'])->random();

                    if ($size_id == 'S') {
                        $size_name = 'Small';
                    } elseif ($size_id == 'M') {
                        $size_name = 'Medium';
                    } elseif ($size_id == 'L') {
                        $size_name = 'Large';
                    } elseif ($size_id == 'XL') {
                        $size_name = 'Extra Large';
                    }
                } else {

                    $variant_id = rand(1,2);
                    $variant_name = $variant_id == 1 ? '30cm' : '40cm';
                }

                $data = array_merge($data, [
                    'item_detail_variant_id' => $variant_id,
                    'item_detail_variant_name' => $variant_name,
                    'item_detail_color_id' => $color_id,
                    'item_detail_color_name' => $color_name,
                    'item_detail_size_id' => $size_id,
                    'item_detail_size_name' => $size_name,
                ]);

                factory(ProductDetail::class, 2)->create($data);
            }
        }

    }
}
