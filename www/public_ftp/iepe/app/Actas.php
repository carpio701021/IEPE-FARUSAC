<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actas extends Model
{
    protected $fillable=['path_pdf','aplicacion_id','estado','aprobacion_decanato','aprobacion_secretaria'];

    public function evaluarEstado(){
        if($this->aprobacion_decanato==1 && $this->aprobacion_secretaria==1){
            $this->estado='aprobada';
        }
        if($this->aprobacion_decanato==-1 || $this->aprobacion_secretaria==-1){
            $this->estado='reprobada';
            AspiranteAplicacion::where('acta_id',$this->id)->update(['acta_id'=>0]);
        }
        $this->save();
    }
    
}
