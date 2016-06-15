<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actas extends Model
{
    protected $fillable=['path_pdf','aplicacion_id','estado'];
}
