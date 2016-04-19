<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspiranteOportunidad extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
