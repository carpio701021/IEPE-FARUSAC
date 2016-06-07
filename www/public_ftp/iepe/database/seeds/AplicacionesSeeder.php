<?php

use Illuminate\Database\Seeder;
use App\Aplicacion;
use App\Horario;
use App\Salon;
use App\AplicacionSalonHorario;

class AplicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $horario[] = new Horario(['hora_inicio'=>'08:00', 'hora_fin'=>'10:00']);end($horario)->save();
        $horario[] = new Horario(['hora_inicio'=>'10:00', 'hora_fin'=>'12:00']);end($horario)->save();

        $salon[] = new Salon(['nombre'=>'T1 L III 6','capacidad'=>'80']);end($salon)->save();
        $salon[] = new Salon(['nombre'=>'T1 L III 7','capacidad'=>'90']);end($salon)->save();
        $salon[] = new Salon(['nombre'=>'T1 L III 8','capacidad'=>'100']);end($salon)->save();
        $salon[] = new Salon(['nombre'=>'T1 L II 4','capacidad'=>'75']);end($salon)->save();
        $salon[] = new Salon(['nombre'=>'T1 L II 5','capacidad'=>'75']);end($salon)->save();

        $aplicacion[] =new Aplicacion(['fecha_inicio_asignaciones'=>'2016/05/24',
            'fecha_fin_asignaciones'=>'2016/10/27',
            'fecha_aplicacion'=>'2016/05/29',
            'fecha_publicacion_resultados'=>'2016/05/30',
            'nombre'=>'Primera Aplicacion 2016'
        ]); end($aplicacion)->save();


        $aplicacion[] =new Aplicacion(['fecha_inicio_asignaciones'=>'2016/08/15',
            'fecha_fin_asignaciones'=>'2016/08/25',
            'fecha_aplicacion'=>'2016/08/30',
            'fecha_publicacion_resultados'=>'2016/09/10',
            'nombre'=>'Segunda Aplicacion 2016'
        ]); end($aplicacion)->save();

        $aplicacion[] =new Aplicacion(['fecha_inicio_asignaciones'=>'2015/10/10',
            'fecha_fin_asignaciones'=>'2015/10/20',
            'fecha_aplicacion'=>'2015/10/23',
            'fecha_publicacion_resultados'=>'2015/10/28',
            'nombre'=>'Cuarta Aplicacion 2015'
        ]);end($aplicacion)->save();

        $aplicacion[] =new Aplicacion(['fecha_inicio_asignaciones'=>'2017/06/20',
            'fecha_fin_asignaciones'=>'2017/06/30',
            'fecha_aplicacion'=>'2017/07/03',
            'fecha_publicacion_resultados'=>'2017/07/10',
            'nombre'=>'Primera Aplicacion 2017'
        ]); end($aplicacion)->save();

        foreach ($aplicacion as $a) {
            foreach ($horario as $h){
                foreach ($salon as $s) {
                    AplicacionSalonHorario::create(['aplicacion_id'=>$a->id,'salon_id'=>$s->id,'horario_id'=>$h->id]);
                }
            }
        }
        
        //factory(App\AspiranteAplicacion::class,1200)->create();
    }
}
