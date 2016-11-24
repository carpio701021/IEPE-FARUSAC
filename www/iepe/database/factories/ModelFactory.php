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


$factory->define(App\Formulario::class, function (Faker\Generator $faker) {
    return [
        'residencia'      => $faker->address,
        'departamento'      => $faker->state,
        'municipio'      => $faker->state,
        'estado_civil'  => 'soltero',
        'estado_laboral'  => 'trabaja',
        'telefono'  => '00000000',
        'celular'  => '00000000',
        'titulo'  => $faker->jobTitle,
        'anio_titulo'=> 2016,
        'dependientes'=>1,
        'centro_educativo'=>$faker->city,
        'direccion_centro_educativo'=> $faker->address,
        'sector'         => $faker->numberBetween(1,2),
        'carrera'      => $faker->numberBetween(1,2),
        'jornada'=> $faker->numberBetween(1,2),
        'confirmacion_intereses'=>0,
    ];
});

$factory->define(App\Aspirante::class, function (Faker\Generator $faker) {
    return [
        'NOV'           => $faker->unique()->numberBetween(1000000000,1000001200),
        'nombre'        => $faker->name,
        'apellido'      => $faker->lastname,
        'email'         => $faker->unique()->email,
        'password'      => bcrypt('123123'),
        'remember_token'=> str_random(10),
        'activated'=> true,
    ];
});

$factory->define(App\AspiranteAplicacion::class, function(Faker\Generator $faker){
    return [
        //'aspirante_id'                  =>  $faker->unique()->numberBetween(1000000000,1000001200),
        'aplicacion_salon_horario_id'   =>  $faker->numberBetween(1,20),
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