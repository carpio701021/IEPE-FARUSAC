<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AspiranteAplicacion extends Model
{
    //
    //use SoftDeletes;
    protected  $table="aspirantes_aplicaciones";
    //protected $dates = ['deleted_at'];
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

    public function getFechaAplicacion(){
        $fecha=$this->belongsTo('App\AplicacionSalonHorario','aplicacion_salon_horario_id')->first()->fecha_aplicacion;
        return date('d-m-Y' ,strtotime($fecha));
    }

    public function getResultadoAPE(){
        return ($this->nota_APE>=$this->getaplicacion()->percentil_APE);

    }
    public function getResultadoRA(){
        return ($this->nota_RA>=$this->getaplicacion()->percentil_RA);
    }

    public function getResultadoRV(){
        return ($this->nota_RV>=$this->getaplicacion()->percentil_RV);
    }

    public function getResultadoAPN(){
        return ($this->nota_APN>=$this->getaplicacion()->percentil_APN);
    }

    public function getResultado(){
        //validar si se puede o no retornar el resultado aún
        if($this->resultado == 'irregular')
            return '*Pasar a oficina de orientación estudiantil de Arquitectura para verificar su resultado.';
        elseif($this->resultado == 'aprobado')
            return  'Aprobado - Por favor confirma tus preferencias en la sección de Aprobados, para una futura asignación';
        elseif($this->resultado == 'reprobado')
            return 'Insatisfactorio';
        else
            return $this->resultado;
    }

    public function asignar($aspirante_id, $aplicacion_id){
        $aplicaciones_salones_horarios = AplicacionSalonHorario::where("aplicacion_id",$aplicacion_id)
            ->orderby('fecha_aplicacion','asc')
            ->get();
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
