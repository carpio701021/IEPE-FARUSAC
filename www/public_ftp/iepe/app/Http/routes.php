<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

    //Authentication Routes...
    $this->get('login', 'AuthAdmin\AuthController@showLoginForm');
    $this->post('login', 'AuthAdmin\AuthController@login');
    $this->get('logout', 'AuthAdmin\AuthController@logout');


    Route::group(['middleware' => ['auth:admin']], function () {
        Route::resource('/conf', 'AdminController');

        Route::resource('aplicacion', 'AplicacionController');
        Route::get('aplicacion/{aplicacion_id}/arte', 'AplicacionController@getArte');

        Route::resource('datos','DatosController');
        
        Route::get('/', function () {
            return view('admin.index');
        });

        /*Route::get('aplicaciones', function () {
            return view('admin.aplicaciones');
        });*/

        Route::get('usuarios', function () {
            return view('admin.usuarios');
        });
    });
});



    Route::group(['middleware' => 'aspirante_web'], function () {
        Route::auth();


        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/configuracion', function () {
            return view('aspirante.configurarCuenta');
        });

        Route::post('/configuracion/guardar', "AspiranteController@actualizarCuenta");

        Route::group(['middleware' => ['auth:aspirante_web'],'prefix' => 'aspirante'], function () {

            Route::resource('/', 'AspiranteController');
            Route::resource('formulario', 'formularioController');
            Route::resource('PruebaEspecifica', 'AspiranteAplicacionController');


            /*Route::get('/aspirante', function () {
                return View::make('aspirante.aspirante');
            });

            Route::get('/aspirante/formulario', function () {
                return View::make('aspirante.index');
            });

            Route::get('/aspirante/PruebaEspecifica', function () {
                return View::make('aspirante.PruebaEspecifica');
            });

            Route::get('/aspirante/ResultadosSatisfactorios', function () {
                return View::make('aspirante.satisfactorio');
            });*/

        });
});


