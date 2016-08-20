<?php

use Illuminate\Database\Seeder;

class TablaAspirantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aspirante::class, 500)->create();
        //factory(App\AspiranteAplicacion::class,1200)->create();
        echo 'termine el seed aspirantes';
    }
}
