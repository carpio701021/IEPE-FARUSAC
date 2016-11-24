<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_sun extends Model
{
    protected $table= 'datos_sun';

    protected $fillable =['orientacion','primer_apellido','segundo_apellido','primer_nombre','segundo_nombre',
        'fecha_nacimiento','sexo','id_materia','aprobacion','fecha_evaluacion','anio_evaluacion'];


}
