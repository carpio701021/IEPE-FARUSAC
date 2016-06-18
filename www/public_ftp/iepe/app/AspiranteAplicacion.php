<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AspiranteAplicacion extends Model
{
    //
    use SoftDeletes;
    protected  $table="aspirantes_aplicaciones";
    protected $dates = ['deleted_at'];
    protected $fillable =['nota_RA','nota_APE','nota_RV','nota_APN','resultado','acta_id'];

    public function getHorario(){
        return $this->belongsTo('App\AplicacionSalonHorario','aplicacion_salon_horario_id')->first()->getHorario();
    }

    public function getSalon(){
        return $this->belongsTo('App\AplicacionSalonHorario','aplicacion_salon_horario_id')->first()->getSalon();
    }

    public function getAplicacion(){
        return $this->belongsTo('App\AplicacionSalonHorario','aplicacion_salon_horario_id')->first()->getAplicacion();
    }

    public function getAspirante(){
        return $this->belongsTo('App\Aspirante','aspirante_id')->first();
    }

    public function getResultado(){
        //validar si se puede o no retornar el resultado aún
        return $this->resultado;
    }

    public function asignar($aspirante_id, $aplicacion_id){
        $aplicaciones_salones_horarios = AplicacionSalonHorario::where("aplicacion_id",$aplicacion_id)->get();
        foreach ($aplicaciones_salones_horarios as $ash){
            if($ash->getSalon()->capacidad>$ash->asignados){
                $this->aspirante_id=$aspirante_id;
                $this->aplicacion_salon_horario_id =$ash->id;
                $ash->increment('asignados');
                return true;
            }
        }
        return false;

    }
}
