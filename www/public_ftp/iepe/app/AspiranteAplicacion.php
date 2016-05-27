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

    public function getHorario(){
        return Horario::where('id','=',$this->horario_id)->first();
    }

    public function getSalon(){
        return Salon::where('id','=',$this->salon_id)->first();
    }

    public function getAplicacion(){
        return Aplicacion::where('id','=',$this->aplicacion_id)->first();
    }

    public function getResultado(){
        //validar si se puede o no retornar el resultado aún
        return $this->resultado;
    }

    public function asignar($aspirante_id, $aplicacion_id){
        $this->aspirante_id=$aspirante_id;
        $this->aplicacion_id=$aplicacion_id;
        $aplicaciones_salones_horarios = AplicacionSalonHorario::where("aplicacion_id",$aplicacion_id)
            ->get();

        foreach ($aplicaciones_salones_horarios as $ash){
            if($ash->getSalon()->capacidad>$ash->asignados){
                $this->horario_id =$ash->horario_id;
                $this->salon_id=$ash->salon_id;
                $ash->increment('asignados');//aqui truena
                dd($ash);
                break;
            }
        }

    }
}
