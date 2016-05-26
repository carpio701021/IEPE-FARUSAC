<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id_formulario';
    protected $fillable=[
        'nombre','apellido','residencia','departamento','genero',
        'fecha_nacimiento','estado_civil','estado_laboral','titulo','anio_titulo',
        'dependientes','centro_educativo','direccion_centro_educativo','sector','carrera', 'jornada'
    ];
}
