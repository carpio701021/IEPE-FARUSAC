<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //protected $table = 'salones'
}
