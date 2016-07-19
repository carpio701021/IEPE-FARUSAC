<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id_formulario';
    protected $fillable=[
        'residencia','departamento',
        'estado_civil','estado_laboral','titulo','anio_titulo','telefono','celular',
        'dependientes','centro_educativo','direccion_centro_educativo','sector','carrera', 'jornada',
        'confirmacion_intereses','municipio'
    ];
}
