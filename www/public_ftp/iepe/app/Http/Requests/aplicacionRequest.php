<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class aplicacionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:50',
            'arte'                          => 'required|image',//path_arte
            'fecha_inicio_asignaciones'      => 'required|date|max:10',
            'fecha_fin_asignaciones'        => 'required|date|max:10|after:'.$this->fecha_inicio_asignaciones,
            'fecha_aplicacion'              => 'required|date|max:10|after:'.$this->fecha_fin_asignaciones,
            'fecha_publicacion_resultados'  => 'required|date|max:10|after:'.$this->fecha_aplicacion,
        ];
    }
}
