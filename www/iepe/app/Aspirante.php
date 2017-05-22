<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;


class Aspirante extends Authenticatable
{
    public function Formulario(){
    	return $this->hasMany('App\Formulario','NOV','NOV');
    }

    public function getFormulario(){
        return $this->hasMany('App\Formulario','NOV','NOV')->orderby("created_at","desc")->first();
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


    public function getNOV(){
        return $this->NOV;
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /*
     * 
     * @return las aplicaciones asignadas en toda la historia y las disponibles para asignarse
     */
    public function getAplicaciones(){
        return Aplicacion::
        where("fecha_inicio_asignaciones","<=",date("Y-m-d"))
            ->where('irregular',0)
            ->leftJoin('aspirantes_aplicaciones',function($join) {
                $join->on('id',"=","aplicacion_id")
                    ->where('aspirante_id','=',$this->NOV);
            })
            ->get();
        
    }

    public function getNombreCompleto(){
        return $this->nombre.' '.$this->apellido;
    }

    public function getFechaNacimiento(){
        return date('d-m-Y' ,strtotime($this->getFormulario()->fecha_nacimiento));
    }

    public function getGenero(){
        //dd($this);
        return $this->getFormulario()->genero;
        //return Datos_sun::where('orientacion',$this->NOV)->first()->sexo;
    }

    //funcion usada desde la interfaz grafica para mostrar resultados
    public function aprobo(){
        $asignacion = AspiranteAplicacion::where('aspirante_id',$this->NOV)
            ->where('acta_id','>',0)->first();

        if(count($asignacion)>0)
            if($asignacion->getAplicacion()->mostrar_resultados)
                return true;
        else
            return false;
    }

    //funcion para saber si ha ganado o no alguna prueba especifica
    public function resultadosPruebaEspecifica(){
        return AspiranteAplicacion::where('aspirante_id',$this->NOV)
            ->where('acta_id','>',0)
            ->where('resultado','aprobado')
            ->orderBy('created_at','desc')
            ->first();
    }

    public function getCui(){
        return $this->CUI;
    }


}
