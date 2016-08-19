<?php

use Illuminate\Database\Seeder;
use App\Admin;

class TablaAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        (new Admin([
            'registro_personal' =>  '10000',
            'nombre'            =>  'Jose',
            'apellido'          =>  'Tobias',
            'email'             =>  'carpio701021@hotmail.com',
            'password'          =>  bcrypt('123123'),
            'rol'               =>  'superadmin',
        ]))->save();


        (new Admin([
            'registro_personal' =>  '10001',
            'nombre'            =>  'Oscar',
            'apellido'          =>  'Enriquez',
            'email'             =>  'oscar.enriquez@farusac.edu.gt',
            'password'          =>  bcrypt('123123'),
            'rol'               =>  'jefe_bienestar',
        ]))->save();



        (new Admin([
            'registro_personal' =>  '10002',
            'nombre'            =>  'Byron Alfredo',
            'apellido'          =>  'Rabé Rendón',
            'email'             =>  '201213052@ingenieria.usac.edu.gt',
            'password'          =>  bcrypt('123123'),
            'rol'               =>  'decano',
        ]))->save();



        (new Admin([
            'registro_personal' =>  '10003',
            'nombre'            =>  'Publio',
            'apellido'          =>  'Rodríguez',
            'email'             =>  'auxjcarpio@gmail.com',
            'password'          =>  bcrypt('123123'),
            'rol'               =>  'secretario',
        ]))->save();



        (new Admin([
            'registro_personal' =>  '10004',
            'nombre'            =>  'Alexander',
            'apellido'          =>  'Aguilar',
            'email'             =>  '201213058@ingenieria.usac.edu.gt',
            'password'          =>  bcrypt('123123'),
            'rol'               =>  'director_arquitectura',
        ]))->save();



        (new Admin([
            'registro_personal' =>  '10005',
            'nombre'            =>  'Luis',
            'apellido'          =>  'Jurado',
            'email'             =>  'jodaches@gmail.com',
            'password'          =>  bcrypt('123123'),
            'rol'               =>  'director_disenio_grafico',
        ]))->save();




        //factory(App\Admin::class, 10)->create()->each(function($u) {
        	//$u->AdminRol()->save(factory(App\AdminRol::class)->make());
    	//
        //});
    }
}
