<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aplicacion extends Model
{
    //
    use SoftDeletes;
    protected $table = 'aplicaciones';
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','fecha_inicio_asignaciones',
        'fecha_fin_asignaciones', 'fecha_aplicacion',
        'fecha_publicacion_resultados',
    ];

    function addSalon($nombre,$capacidad){
        $salon = Salon::firstOrCreate([
            'nombre' => $nombre,
            'capacidad' => $capacidad,
        ]);
        return $salon->id;
    }

    function addHorario($inicio,$fin){
        $horario = Horario::firstOrCreate([
            'hora_inicio' => $inicio,
            'hora_fin' => $fin,
        ]);
        return $horario->id;
    }

    private function generarSalonesHorarios($ids_salones, $ids_horarios){
        foreach($ids_horarios as $h){
            foreach($ids_salones as $s){
                (AplicacionSalonHorario::firstOrCreate([
                    'aplicacion_id'     =>  $this->id,
                    'salon_id'          =>  $s,
                    'horario_id'        =>  $h,
                ]));
            }
        }
    }

    function asignarSalonesHorarios($salones,$horarios){
        $ids_salones = Array();
        $ids_horarios = Array();

        foreach($salones as $salon){
            $ids_salones[] = $salon->id;
        }
        foreach($horarios as $horario){
            $ids_horarios[] = $horario->id;
        }
        $this->generarSalonesHorarios($ids_salones, $ids_horarios);
    }

    function agregarSalonesHorarios($rsalones,$rhorarios){
        //meter salones
        $ids_salones = Array();
        foreach($rsalones as $salon){
            $sals =  explode(":==:", $salon,2);
            $ids_salones[] = $this->addSalon($sals[0],$sals[1]);
        }
        //meter horarios
        $ids_horarios = Array();
        foreach($rhorarios as $horario){
            $hs =  explode("-", $horario,2);
            $ids_horarios[] = $this->addHorario($hs[0],$hs[1]);
        }
        $this->generarSalonesHorarios($ids_salones, $ids_horarios);
    }




}
