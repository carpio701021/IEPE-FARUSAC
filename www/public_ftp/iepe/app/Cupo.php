<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupo extends Model
{
    protected $fillable =['carrera','jornada','cantidad','anio'];

    public function getCupo($carrera,$jornada){
        return Cupo::where('anio',$this->anio)
            ->where('carrera',$carrera)
            ->where('jornada',$jornada)
            ->first()
            ->cantidad;

    }
}
