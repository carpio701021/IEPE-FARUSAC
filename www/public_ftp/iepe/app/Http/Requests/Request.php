<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function messages()
    {
        return [
            'same'          => 'Contraseña nueva no coincide',
            'different'     => 'La nueva contraseña debe ser diferente a la anterior',
            'size'          => 'The :attribute must be exactly :size.',
            'between'       => 'The :attribute must be between :min - :max.',
            'in'            => 'El campo :attribute debe ser uno de los siguientes valores: :values',
            'required'      => 'El campo :attribute es obligatorio',
            'date'          => 'La fecha :attribute no tiene el formato correcto',
            'numeric'       => 'El campo :attribute debe ser numérico',
            'after'         => 'La :attribute debe estar programada para después de :date',
            'min'           => 'El campo :attribute debe ser mayor o igual a :min',
            'max'           => 'El campo :attribute debe ser menor o igual a :max',
        ];
    }
}
