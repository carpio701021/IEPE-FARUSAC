<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AplicacionRequest extends Request
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
        //dd($this->messages);
        return [
            'year'                          => 'required|max:50',
            'naplicacion'                   => 'required|max:50',
            'arte'                          => 'image',//path_arte
            'fecha_inicio_asignaciones'     => 'required|date|max:10',
            'fecha_fin_asignaciones'        => 'required|date|max:19|after:'.$this->fecha_inicio_asignaciones,
            //'fecha_aplicacion'              => 'required|date|max:10|after:'.$this->fecha_fin_asignaciones,
            'horarios'                      => 'required',
            'salones'                       => 'required',
            'fechasA'                       => 'required',
        ];
    }
}
