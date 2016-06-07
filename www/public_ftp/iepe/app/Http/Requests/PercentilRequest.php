<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PercentilRequest extends Request
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
            'percentil_RA'                  => 'required|integer|max:100|min:0',
            'percentil_APE'                  => 'required|integer|max:100|min:0',
            'percentil_RV'                  => 'required|integer|max:100|min:0',
            'percentil_APN'                  => 'required|integer|max:100|min:0',

        ];
    }
}
