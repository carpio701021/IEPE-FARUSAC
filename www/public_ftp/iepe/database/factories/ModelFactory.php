<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Aspirante::class, function (Faker\Generator $faker) {
    return [
    	'NOV' => $faker->numberBetween(0,201699999),
        'nombre' => $faker->name,
        'apellido' => $faker->lastname,
        'email' => $faker->email,
        'password' => bcrypt(str_random(60)),
        'remember_token' => str_random(10),
    ];
});