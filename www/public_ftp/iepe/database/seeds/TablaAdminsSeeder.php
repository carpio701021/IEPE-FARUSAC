<?php

use Illuminate\Database\Seeder;

class TablaAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Admin::class, 10)->create()->each(function($u) {
        	$u->AdminRol()->save(factory(App\AdminRol::class)->make());
    	});
    }
}
