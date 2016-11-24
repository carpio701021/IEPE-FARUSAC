<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(TablaAdminsSeeder::class);
        $this->call(AplicacionesSeeder::class);
        $this->call(TablaAspirantesSeeder::class);
        $this->call(TablaAsignacionesSeeder::class);
    }
}
