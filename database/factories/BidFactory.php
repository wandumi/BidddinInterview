<?php

use Faker\Generator as Faker;

$factory->define(App\Bid::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'price' => $faker->numberBetween(100,20000),
    ];
});
