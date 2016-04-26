<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{	
    public function Formulario(){
    	return $this->hasMany('App\Formulario','NOV');
    }
}
