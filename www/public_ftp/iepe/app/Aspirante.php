<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{	
    public function Formulario(){
    	return $this->hasMany('App\Formulario','NOV','NOV');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NOV','name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
