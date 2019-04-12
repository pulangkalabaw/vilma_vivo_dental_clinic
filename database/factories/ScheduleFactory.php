<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    $first_name = $faker->firstName;
    $last_name = $faker->lastName;
    $full_name = explode(" ", trim($first_name) . " " . trim($last_name));
    $acronym = "";
    $initial_name = "";
    foreach ($full_name as $f) {
        $initial_name .= $f[0];
    }

    return [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'initial_name' => $initial_name,
        'contact' => $faker->phoneNumber,
        'address' => $faker->address,
        'tracking_no' => str_random(10),
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '1 days', $timezone = null),
        'time' => $faker->time($format = 'H:i:s', $max = 'now'),
    ];
});
