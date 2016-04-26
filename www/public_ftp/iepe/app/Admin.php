<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function AdminRol(){
    	return $this->hasMany('App\AdminRol','admin_registro_personal','registro_personal');
    }
}
