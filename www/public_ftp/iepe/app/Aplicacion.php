<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunidad extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
