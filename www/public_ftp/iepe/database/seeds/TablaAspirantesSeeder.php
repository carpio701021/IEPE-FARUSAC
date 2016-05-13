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
        factory(App\Aspirante::class, 50)->create();
    }
}
