<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Item\Dao\Facades\LinenFacades;

$factory->define(Linen::class, function (Faker $faker) {
    return [
        'item_linen_rfid' => $faker->company,
        'item_linen_rent' => $faker->randomElement(array_keys(LinenFacades::rent())),
        'item_linen_status' => $faker->randomElement(array_keys(LinenFacades::status())),
        'item_linen_created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
