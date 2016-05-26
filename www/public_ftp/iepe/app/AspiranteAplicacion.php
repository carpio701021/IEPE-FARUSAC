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
    //protected $fillable=['horario_id','aspirante_id','aplicacion_id','salon_id'];

    public function getHorario(){
        return Horario::find($this->horario_id)->first();
    }

    public function getSalon(){
        return Salon::find($this->salon_id)->first();
    }

    public function getAplicacion(){
        return Aplicacion::where('id','=',$this->aplicacion_id)->first();
    }

    public function getResultado(){
        //validar si se puede o no retornar el resultado aún
        return $this->resultado;
    }
}
