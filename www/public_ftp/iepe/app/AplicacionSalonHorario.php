<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AplicacionSalonHorario extends Model
{
    //

    protected $table = 'aplicaciones_salones_horarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aplicacion_id','salon_id','horario_id'
    ];

    public function getSalon(){
        return $this->belongsTo('App\Salon','salon_id')->get();
    }


    function getHorario(){
        return $this->belongsTo('App\Horario','horario_id')->get();
    }

}
