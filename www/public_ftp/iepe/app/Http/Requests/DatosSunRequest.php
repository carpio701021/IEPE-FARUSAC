<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DatosSunRequest extends Request
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
            "orientacion"=>"required|integer|min:1000000000|max:9999999999",
            "primer_apellido"=>"required|string|max:255",
            "segundo_apellido"=>"required|string|max:255",
            "primer_nombre"=>"required|string|max:255",
            "segundo_nombre"=>"required|string|max:255",
            "fecha_nacimiento"=>"required|date",
            "sexo"=>"required|integer|min:0|max:1",
            "id_materia"=>"required|integer",
            "aprobacion"=>"integer|max:255",
            "fecha_evaluacion"=>"required|date",
            "anio_evaluacion"=>"required|integer",
        ];
    }
}
