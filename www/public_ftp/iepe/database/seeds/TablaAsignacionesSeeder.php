<?php

use Illuminate\Database\Seeder;

class TablaAsignacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aspirante::class,500)->create()->each(function ($a){
            $aspirante=App\Aspirante::where('email',$a->email)->first();
            $asignacion=factory(App\AspiranteAplicacion::class)->make(['aspirante_id'=>$aspirante->NOV]);
            $asignacion->save();
            //echo dd($asignacion);
            factory(App\Formulario::class)->make(['NOV'=>$aspirante->NOV])->save();
            $salonHorario=App\AplicacionSalonHorario::find($asignacion->aplicacion_salon_horario_id);
            $salonHorario->asignados++;
            $salonHorario->save();
        });
    }
}
