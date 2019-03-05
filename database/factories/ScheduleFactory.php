<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'date' => '2019-07-16',
        'time' => '01:99pm',
    ];
});
