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
        'nombre','fecha_inicio_asignaiones',
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

    function generarSalonesHorarios($ids_salones, $ids_horarios){
        foreach($ids_horarios as $h){
            foreach($ids_salones as $s){
                new AplicacionSalonHorarion([
                    'aplicacion_id'     =>  $this->id,
                    'salon_id'          =>  $s,
                    'horario_id'        =>  $h,
                ]);
            }
        }

    }


}
