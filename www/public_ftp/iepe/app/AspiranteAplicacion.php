<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AspiranteAplicacion extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //protected $fillable=['horario_id','aspirante_id','aplicacion_id','salon_id'];
}
