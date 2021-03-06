<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Aplicacion extends Model
{
    //
    //use SoftDeletes;
    protected $table = 'aplicaciones';
    //protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year','naplicacion','fecha_inicio_asignaciones',
        'fecha_fin_asignaciones', 'irregular'
    ];
    

    function nombre(){
        if($this->irregular>0) 
            return 'Aplicación '.$this->naplicacion.'.'.$this->irregular.' del '.$this->year;
        else 
            return 'Aplicación '.$this->naplicacion.' del '.$this->year;
    }

    function addSalon($edificio,$nombre,$capacidad){
        $salon = Salon::firstOrCreate([
            'nombre' => $nombre,
            'edificio' => $edificio,
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

    private function generarSalonesHorarios($ids_salones, $ids_horarios,$fechasA){
        foreach($fechasA as $f) {
            foreach($ids_horarios as $h){
                foreach($ids_salones as $s){
                    (AplicacionSalonHorario::firstOrCreate([
                        'aplicacion_id' => $this->id,
                        'salon_id' => $s,
                        'horario_id' => $h,
                        'fecha_aplicacion' => $f,
                    ]));
                }
            }
        }
    }

    function asignarSalonesHorarios($salones,$horarios,$fechasA){
        $ids_salones = Array();
        $ids_horarios = Array();

        foreach($salones as $salon){
            $ids_salones[] = $salon->id;
        }
        foreach($horarios as $horario){
            $ids_horarios[] = $horario->id;
        }
        $this->generarSalonesHorarios($ids_salones, $ids_horarios,$fechasA);
    }

    function agregarSalonesHorarios($rsalones,$rhorarios,$fechasA){
        //meter salones
        AplicacionSalonHorario::where('aplicacion_id',$this->id)->delete();
        $ids_salones = Array();
        foreach($rsalones as $salon){
            $sals =  explode(":==:", $salon,3);
            $ids_salones[] = $this->addSalon($sals[0],$sals[1],$sals[2]);
        }
        //meter horarios
        $ids_horarios = Array();
        foreach($rhorarios as $horario){
            $hs =  explode("-", $horario,2);
            $ids_horarios[] = $this->addHorario($hs[0],$hs[1]);
        }
        $arr_fechas = Array();
        foreach($fechasA as $fecha){
            $arr_fechas[] = $fecha;
        }
        $this->generarSalonesHorarios($ids_salones, $ids_horarios,$fechasA);
    }

    function getHorarios(){
        return
            $this->belongsToMany(
                'App\Horario','aplicaciones_salones_horarios','aplicacion_id','horario_id'
            )->distinct()->get()
            ;
    }

    function getSalones(){
        return
            $this->belongsToMany(
                'App\Salon','aplicaciones_salones_horarios','aplicacion_id','salon_id'
            )->distinct()->get()
            ;
    }

    function getFechasA(){
        $f =AplicacionSalonHorario::where('aplicacion_id',$this->id)
            ->get();
        $fs = Array();
        foreach($f as $fe){
            $fs[$fe->fecha_aplicacion] = $fe->fecha_aplicacion;
        }
        //dd($fs);
        return $fs;
    }

    function getCapacidadMaxima(){
        return
            $this->belongsToMany(
                'App\Salon','aplicaciones_salones_horarios','aplicacion_id','salon_id'
            )->sum('capacidad')
            ;
    }

    function getCountAsignados(){
        return
            $this->hasMany('App\AplicacionSalonHorario','aplicacion_id')->sum('asignados')
            ;
    }

    public function calificar($carrera){
        $salonesHorarios = $this->getSalonesHorarios();
        foreach ($salonesHorarios as $salonhorario){
            $asignaciones = $salonhorario->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
            ->join('formularios','aspirante_id','=','NOV')            
            ->select('aspirantes_aplicaciones.id','nota_RA','nota_APE','nota_RV','nota_APN','resultado','carrera')
            ->where('resultado','<>','irregular');                    
            foreach ($asignaciones->get() as $asignacion){                
                
                if($asignacion->carrera=="arquitectura"){
                    if($asignacion->nota_RA>=$this->percentil_RA
                        && $asignacion->nota_APE>=$this->percentil_APE
                        && $asignacion->nota_RV>=$this->percentil_RV
                        && $asignacion->nota_APN>=$this->percentil_APN){
                        $asignacion->resultado='aprobado';
                    }else{
                        $asignacion->resultado='reprobado';
                    }
                }else{
                    if($asignacion->nota_RA>=$this->percentil_RA_disenio
                        && $asignacion->nota_APE>=$this->percentil_APE_disenio
                        && $asignacion->nota_RV>=$this->percentil_RV_disenio
                        && $asignacion->nota_APN>=$this->percentil_APN_disenio){
                        $asignacion->resultado='aprobado';
                    }else{
                        $asignacion->resultado='reprobado';
                    }
                }
                
                $asignacion->save();
            }
        }
    }
    
    public function getSalonesHorarios(){
        return $this->hasMany('App\AplicacionSalonHorario','aplicacion_id')->get();
    }

    /**
     * @deprecated 
     * se usó en el primer release, sustituido por el metodo getResumenCalificacion 
     **/
    public function getResumen_Areas(){
        $aprobados_RA=0;$reprobados_RA=0;
        $aprobados_APE=0;$reprobados_APE=0;
        $aprobados_RV=0;$reprobados_RV=0;
        $aprobados_APN=0;$reprobados_APN=0;


        $horarios = $this->hasMany('App\AplicacionSalonHorario','aplicacion_id');
        foreach($horarios->get() as $ash){
            $aprobados_RA += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_RA','>=',$this->percentil_RA)->where('resultado','<>','pendiente')->count();
            $reprobados_RA += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_RA','<',$this->percentil_RA)->where('resultado','<>','pendiente')->count();
            $aprobados_APE += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_APE','>=',$this->percentil_APE)->where('resultado','<>','pendiente')->count();
            $reprobados_APE += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_APE','<',$this->percentil_APE)->where('resultado','<>','pendiente')->count();
            $aprobados_RV += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_RV','>=',$this->percentil_RV)->where('resultado','<>','pendiente')->count();
            $reprobados_RV += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_RV','<',$this->percentil_RV)->where('resultado','<>','pendiente')->count();
            $aprobados_APN += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_APN','>=',$this->percentil_APN)->where('resultado','<>','pendiente')->count();
            $reprobados_APN += $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('nota_APN','<',$this->percentil_APN)->where('resultado','<>','pendiente')->count();
        }
        return ['aRA'=>$aprobados_RA,'rRA'=>$reprobados_RA,
            'aAPE'=>$aprobados_APE,'rAPE'=>$reprobados_APE,
            'aRV'=>$aprobados_RV,'rRV'=>$reprobados_RV,
            'aAPN'=>$aprobados_APN,'rAPN'=>$reprobados_APN,];
    }

    
    /**
     * llamada a un store procedure para obtener los resultados de una calificacion efectuada
     * @return array
     * 
     */
    public function getResumenCalificacion(){
        $resumen = DB::select('CALL resumenCalificacion('.$this->id.')')[0];        
        return [
            'aRA'=>$resumen->aprobados_RA,
            'rRA'=>$resumen->reprobados_RA,
            'aAPE'=>$resumen->aprobados_APE,
            'rAPE'=>$resumen->reprobados_APE,
            'aRV'=>$resumen->aprobados_RV,
            'rRV'=>$resumen->reprobados_RV,
            'aAPN'=>$resumen->aprobados_APN,
            'rAPN'=>$resumen->reprobados_APN,
            'aRA_disenio'=>$resumen->aprobados_RA_disenio,
            'rRA_disenio'=>$resumen->reprobados_RA_disenio,
            'aAPE_disenio'=>$resumen->aprobados_APE_disenio,
            'rAPE_disenio'=>$resumen->reprobados_APE_disenio,
            'aRV_disenio'=>$resumen->aprobados_RV_disenio,
            'rRV_disenio'=>$resumen->reprobados_RV_disenio,
            'aAPN_disenio'=>$resumen->aprobados_APN_disenio,
            'rAPN_disenio'=>$resumen->reprobados_APN_disenio,
            'aprobados_arquitectura'=> $resumen->aprobados_arquitectura,
            'reprobados_arquitectura'=> $resumen->reprobados_arquitectura,
            'aprobados_disenio'=> $resumen->aprobados_disenio,
            'reprobados_disenio'=> $resumen->reprobados_disenio,
                ];
    }

    public function getCountAprobados(){
        $horarios = $this->getSalonesHorarios();
        $aprobados=0;
        foreach($horarios as $ash){
            $aprobados+= $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('resultado','aprobado')->count();
        }
        return $aprobados;
    }

    public function getCountAprobadosNuevaActa(){
        $horarios = $this->getSalonesHorarios();
        $aprobados=0;
        foreach($horarios as $ash){
            $aprobados+= $ash->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                ->where('resultado','aprobado')
                ->where('acta_id','0')
                ->count();
        }
        return $aprobados;
    }

    public function getAsignaciones(){
        $asig=Db::table('aspirantes_aplicaciones as aa')
            ->join('aplicaciones_salones_horarios as ash','ash.id','=','aa.aplicacion_salon_horario_id')
            ->where('ash.aplicacion_id','=',$this->id)
            ->selectRaw('aa.*');
        return $asig;
    }

    public function getActas(){
        return $this->hasMany('App\Actas','aplicacion_id')->get();
    }

}
