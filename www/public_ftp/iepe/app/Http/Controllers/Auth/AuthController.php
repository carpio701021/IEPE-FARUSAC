<?php

namespace App\Http\Controllers\Auth;

use App\Aspirante;
use App\Datos_sun;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins,AuthenticatesAndRegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'aspirante';
    protected $redirectAfterLogout = '/';
    protected $guard = 'aspirante_web';
    protected $username = 'NOV';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('aspirante_web', ['except' => 'logout']);
    }

    /**
     * Get the login lockout error message.
     *
     * @param  int  $seconds
     * @return string
     */
    protected function getLockoutErrorMessage($seconds)
    {
        return 'Muchos intentos de ingreso. Vuelva a intentarlo en '.$seconds.' segundos.';
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'unique'   => 'El campo :attribute ya existe. <br>Prueba recuperar<a class="btn btn-link" href="'+url('/password/reset')+'"></a>',
            'numeric'  => 'El campo :attribute debe ser numérico',
            'email'    => 'El campo :attribute debe ser un correo electrónico válido.',
        ];
        return Validator::make($data, [
            'NOV' => 'required|numeric|unique:aspirantes',
            'email' => 'required|email|max:255|unique:aspirantes',
            'password' => 'required|confirmed|min:6',
        ],$messages);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        /**Verificar si es carnet**/
        if( $request->NOV > 100000000 && $request->NOV < 999999999 ){
            $errors = Array('NOV'=>'Usted esta tratando de acceder con un número de carnet.<br>Favor pasar a la oficina de Orientación Estudiantil de la Facultad de Arquitectura para registrar su número de orientación vocacional.');
            return redirect('/register')->withErrors($errors)->withInput();
        }

        /**Verificar si existe en la base de datos del SUN**/
        $existente = Datos_sun::where('orientacion',$request->NOV)->first();
        if($existente == null){
            $errors = Array('NOV'=>'No se han encontrado registros válidos en nuestra base de datos.');
            return redirect('/register')->withErrors($errors)->withInput();
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Aspirante::create([
            'NOV' => $data['NOV'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'Las credenciales no concuerdan o no existen.';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'NOV';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard('aspirante_web')->attempt($credentials) )
        {
            //dd(Auth::user());
            return redirect($this->redirectTo);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect()->back()
            ->withInput( $request->only($this->loginUsername()) )
            ->withErrors([$this->loginUsername() => 'Credenciales incorrectas.'
            ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return $this->guard;
    }

}
