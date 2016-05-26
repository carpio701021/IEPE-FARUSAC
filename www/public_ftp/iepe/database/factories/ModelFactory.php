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


$factory->define(App\Aspirante::class, function (Faker\Generator $faker) {
    return [
    	'NOV' => $faker->numberBetween(0,201699999),
        'nombre' => $faker->name,
        'apellido' => $faker->lastname,
        'email' => $faker->email,
        'password' => bcrypt('123123'),
        'remember_token' => str_random(10),   
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
    	'registro_personal' => $faker->unique()->numberBetween(0,1000000),        
        'email' => $faker->email,
        'nombre' => $faker->name,
        'apellido' => $faker->lastname,
        'password' => bcrypt('123123'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\AdminRol::class, function (Faker\Generator $faker) {
    return [
    	'rol' => $faker->numberBetween(1,4)               
    ];
});