<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $primaryKey = 'registro_personal';
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'registro_personal';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registro_personal','nombre','apellido', 'email', 'password','rol'
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRolName(){
        return $this->posiblesRoles()[$this->rol];
    }

    public function tieneRol($xrol){
        return $this->rol == $xrol;
    }

    public function posiblesRoles(){
        return [
            'superadmin'                =>  'Super admin',
            'jefe_bienestar'            =>  'Jefe de Bienestar',
            'secretario'                =>  'Secretario',
            'decano'                    =>  'Decano',
            'director_arquitectura'     =>  'Director de Arquitectura',
            'director_disenio_grafico'  =>  'Director de Diseño Gráfico',
            'consultor_ws'  =>  'Consultor de servicios Web'
        ];
    }
    
    public function nombre(){                        
        return $this->nombre.' '.$this->apellido;                      
    }
}
