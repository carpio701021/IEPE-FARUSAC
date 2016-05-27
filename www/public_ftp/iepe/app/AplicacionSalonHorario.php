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


}
