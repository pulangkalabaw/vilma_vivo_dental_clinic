<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '1 days', $timezone = null),
        'time' => $faker->time($format = 'H:i:s', $max = 'now'),
    ];
});
