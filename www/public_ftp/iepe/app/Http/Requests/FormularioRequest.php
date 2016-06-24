<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FormularioRequest extends Request
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
            "residencia"=>"required|string|max:255",
            "departamento"=>"required|string|max:255",
            "genero"=>"required|boolean",
            "fecha_nacimiento"=>"required|date",
            "estado_civil"=>"required|in:soltero,casado",
            "estado_laboral"=>"required|in:trabaja,no_trabaja",
            "titulo"=>"required|string|max:255",
            "anio_titulo"=>"required|integer|min:1990",
            "dependientes"=>"required|integer|min:0",
            "centro_educativo"=>"required|string|max:255",
            "direccion_centro_educativo"=>"required|string|max:255",
            "sector"=>"required|in:privado,publico",
            "carrera"=>"required|in:arquitectura,diseño",
            "jornada"=>"required|in:matutina,vespertina"
        ];
    }

    
}
