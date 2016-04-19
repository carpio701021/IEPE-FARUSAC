<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaEspecifica extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
