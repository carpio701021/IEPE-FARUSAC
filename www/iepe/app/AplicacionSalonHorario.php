<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AplicacionSalonHorario extends Model
{



    protected $table = 'aplicaciones_salones_horarios';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aplicacion_id','salon_id','horario_id','fecha_aplicacion'
    ];

    public function getSalon(){
        return $this->belongsTo('App\Salon','salon_id')->first();
    }

    function getAplicacion(){
        return $this->belongsTo('App\Aplicacion','aplicacion_id')->first();
    }


    function getHorario(){
        return $this->belongsTo('App\Horario','horario_id')->first();
    }
    
    public function getAsignaciones(){
        return $this->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')->get();
    }

    public function printNombre(){
        return $this->getSalon()->nombre.'_'.$this->getHorario()->id;
    }


    public function getFechaFormatoGt(){
        return Carbon::parse($this->fecha_aplicacion )->format('d/m/Y');
    }

    public function actualizarCupo(){
        $this->asignados = AspiranteAplicacion::where('aplicacion_salon_horario_id',$this->id)->count();
        $this->save();
    }

}
