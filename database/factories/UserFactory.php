<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    if(empty(App\User::where('email', 'monica@gmail.com')->first())){
        App\User::create([
            'name' => 'MONICA J. BARIL',
            'email' => 'monica@gmail.com',
            'role' => 'administrator',
            'password' => bcrypt('sadsad'),
            'remember_token' => str_random(10),
        ]);
    }

	if(empty(App\User::where('email', 'kllopez@iplusonline.com')->first())){
        App\User::create([
            'name' => 'Red Carabao',
            'email' => 'kllopez@iplusonline.com',
            'role' => 'administrator',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);
    }

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'role' => 'administrator',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
