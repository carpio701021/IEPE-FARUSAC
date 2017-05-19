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

    public function getActaAprobada(){
        //dd(Actas::where('id',$this->acta_id)->get());
        if ( $this->acta_id == 0) return null;
        return Actas::where('id',$this->acta_id)
            ->where('estado','aprobada')
            ->first();
    }


    //metodos comentados hasta revisar su funcionamiento (tomar en cuenta que ahora los percentiles van por carrera)
    /*
    public function getResultadoAPE(){
        return ($this->nota_APE>=$this->getAplicacion()->percentil_APE);

    }
    public function getResultadoRA(){
        return ($this->nota_RA>=$this->getAplicacion()->percentil_RA);
    }

    public function getResultadoRV(){
        return ($this->nota_RV>=$this->getAplicacion()->percentil_RV);
    }

    public function getResultadoAPN(){
        return ($this->nota_APN>=$this->getAplicacion()->percentil_APN);
    }
    */

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
        $asignacion = new AspiranteAplicacion();
        $aplicaciones_salones_horarios = AplicacionSalonHorario::where("aplicacion_id",$aplicacion_id)
            ->orderby('id','asc')
            ->get();
        foreach ($aplicaciones_salones_horarios as $ash){
            if($ash->getSalon()->capacidad>$ash->asignados){
                $this->aspirante_id=$aspirante_id;
                $this->aplicacion_salon_horario_id = $ash->id;
                $this->save();
                //$ash->increment('asignados');
                $ash->actualizarCupo();
                return true;
            }
        }
        return false;
    }
}
