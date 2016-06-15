<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actas extends Model
{
    protected $fillable=['path_pdf','aplicacion_id','estado'];

    public function evaluarEstado(){
        if($this->aprobacion_decano==1 && $this->aprobacion_secretaria=1){
            $this->estado='aprobada';
        }
        if($this->aprobacion_decano==-1 || $this->aprobacion_secretaria=-1){
            $this->estado='reprobada';
        }
        $this->save();
    }
}
