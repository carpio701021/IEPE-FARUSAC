<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Aspirante extends Authenticatable
{
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
    protected $primaryKey = 'NOV';
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'NOV';
    }
    protected $fillable = [
        'NOV','nombre','apellido', 'email', 'password',
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
