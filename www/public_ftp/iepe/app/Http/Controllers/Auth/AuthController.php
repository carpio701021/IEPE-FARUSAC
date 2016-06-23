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
use App\ActivationService;

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
    protected $activationService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('aspirante_web', ['except' => 'logout']);
        $this->activationService = $activationService;
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
            'required'      => 'El campo :attribute es obligatorio.',
            'unique'        => 'El :attribute proporcionado ya esta registrado. <a class="btn btn-link" href="'.url('/password/reset').'">Recuperar contraseña</a><br>Si el problema persiste presentarse a la oficina de Orientacion Estudiantil de Arquitectura.',
            'numeric'       => 'El campo :attribute debe ser numérico',
            'email'         => 'El campo :attribute debe ser un correo electrónico válido.',
            'confirmed'     => 'El campo :attribute no concuerda con la confirmación.',
        ];
        return Validator::make($data, [
            'NOV' => 'required|numeric|unique:aspirantes',
            'email' => 'required|confirmed|email|max:255|unique:aspirantes',
            'password' => 'required|confirmed|min:6',
        ],$messages);
    }

    public function activateUser($token)
    {
        if ($aspirante = $this->activationService->activateUser($token)) {
            auth()->login($aspirante);
            return redirect($this->redirectPath());
        }
        abort(404);
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
            $errors = Array('NOV'=>'Usted esta tratando de acceder con un número de carnet. Favor intente con su número de orientación vocacional. Si continua el error, pasar a la oficina de Orientación Estudiantil de Arquitectura.');
            return redirect('/register')->withErrors($errors)->withInput();
        }

        //redirect('/register')->with('status', 'We sent you an activation code. Check your email.');

        /**Verificar si existe en la base de datos del SUN (deben ganar lenguaje-> 3 y matematicas-> 4)**/
        $lenguaje = Datos_sun::where('orientacion',$request->NOV)
            ->where('id_materia','3')
            ->where('aprobacion','1')
            ->first();
        $mate = Datos_sun::where('orientacion',$request->NOV)
            ->where('id_materia','4')
            ->where('aprobacion','1')
            ->first();

        //dd($mate);

        if($lenguaje == null || $mate == null){
            $errors = Array('NOV'=>'No se han encontrado registros válidos en nuestra base de datos.');
            return redirect('/register')->withErrors($errors)->withInput();
        }

        //Auth::guard($this->getGuard())->login($this->create($request->all()));
        $user = $this->create($request->all());
        $user->NOV = $request->NOV;
        Auth::guard($this->getGuard())->login($user);
        $this->activationService->sendActivationMail($user);

        //return redirect($this->redirectPath());
        $request->session()->flash('status','Te hemos enviado un código de verificación. Revisa tu correo.');
        return redirect('/login');
        //return redirect('/login')->with('status', 'Te hemos enviado un código de verificación. Revisa tu correo.');
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


    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            $request->session()->flash('status','Necesitas confirmar tu correo. Se te ha enviado un código de verificación, por favor revisa tu correo.');
            return redirect('/login');
            //return back()->with('warning', 'Necesitas confirmar tu correo. Nosotros te enviamos un código de verificación, por favor revisa tu correo.');
        }
        return redirect()->intended($this->redirectPath());
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

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
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
