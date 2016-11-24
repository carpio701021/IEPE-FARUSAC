<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Admin;

class GestionUsuariosRequest extends Request
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
        if($this->password == ''){
            unset($this['password']);
            unset($this['password_confirmation']);
        }
        switch($this->method())
        {
            case 'PUT': {
                return [
                    'registro_personal' => 'required|numeric',
                    'nombre' => 'required|max:50',
                    'apellido' => 'required|max:50',
                    'email' => 'required|email|max:255',
                    'password' => 'confirmed|min:6',
                    'rol' => 'required|max:50',
                ];
            }
            default:
            {
                return [
                    'registro_personal' => 'required|numeric|unique:admins',
                    'nombre' => 'required|max:50',
                    'apellido' => 'required|max:50',
                    'email' => 'required|email|max:255|unique:admins',
                    'password' => 'required|confirmed|min:6',
                    'rol' => 'required|max:50',
                ];
            }
        }
    }
}
