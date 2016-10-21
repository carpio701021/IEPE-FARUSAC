<?php

namespace App\Http\Controllers\Auth;

use App\Aspirante;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->subject="Restablecer contraseña";
        $this->redirectPath='/aspirante';
    }

    public function sendResetLink(Request $request){
        $aspirante=Aspirante::find($request->NOV);
        if($aspirante){
            $request['email']=$aspirante->email;
        }
        //dd($request->email);
        //dd($request);
        return $this->sendResetLinkEmail($request);
    }

}
