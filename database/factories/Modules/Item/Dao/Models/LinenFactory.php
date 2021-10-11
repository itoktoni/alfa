<?php

namespace Database\Factories\Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\Linen;

class LinenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Linen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_linen_rfid' => $this->faker->company,
            'item_linen_rent' => $this->faker->randomElement(array_keys(LinenFacades::rent())),
            'item_linen_status' => $this->faker->randomElement(array_keys(LinenFacades::status())),
            'item_linen_created_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
