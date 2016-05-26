<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AplicacionSalon extends Model
{
    //

    protected $table = 'aplicaciones_salones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aplicacion_id','salon_id',
    ];

}
