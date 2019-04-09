<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'tracking_no' => str_random(10),
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '1 days', $timezone = null),
        'time' => $faker->time($format = 'H:i:s', $max = 'now'),
    ];
});
