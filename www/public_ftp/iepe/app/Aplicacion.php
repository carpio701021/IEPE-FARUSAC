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
        $salon = new Salon([
            'nombre' => $nombre,
            'capacidad' => $capacidad,
        ]);
        $salon->save();
        $aplicacion_salon = new AplicacionSalon([
            'salon_id'=>$salon->id,
            'aplicacion_id'=>$this->id,
        ]);
        $aplicacion_salon->save();
    }

    function addHorario($inicio,$fin){
        $horario = new Horario([
            'hora_inicio' => $inicio,
            'hora_fin' => $fin,
            'aplicacion_id'=>$this->id,
        ]);
        $horario->save();
    }


}
