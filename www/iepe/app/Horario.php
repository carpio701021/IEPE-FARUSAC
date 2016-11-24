<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Horario extends Model
{
    //
    //use SoftDeletes;
    //protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hora_inicio','hora_fin',
    ];

    public function printHorario(){
        return substr($this->hora_inicio,0,5).' - '.substr($this->hora_fin,0,5);
    }
}
