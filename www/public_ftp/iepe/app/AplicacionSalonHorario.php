<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AplicacionSalonHorario extends Model
{
    //

    protected $table = 'aplicaciones_salones_horarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aplicacion_id','salon_id','horario_id'
    ];

    public function getSalon(){
        return Salon::where('id','=',$this->salon_id)->first();
    }


    function getHorario(){
        return $this->belongsTo('App\Horario','horario_id')->get();
    }

    /*
    public static function find($primaryOne, $primaryTwo, $primaryThree) {
        return Widget::where('aplicacion_id', '=', $primaryOne)
            ->where('salon_id', '=', $primaryTwo)
            ->where('horario_id', '=', $primaryThree)
            ->first();
    }
    //*/
}
