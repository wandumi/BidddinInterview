<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'sku' => $faker->randomNumber,
        'price' => $faker->numberBetween(100,20000),
        'description' => $faker->paragraph,
    ];
});
