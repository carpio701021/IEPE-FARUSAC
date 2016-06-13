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
        Route::get('/', function () {
            return view('admin.index');
        });
        Route::resource('/conf', 'AdminController');

        Route::group(['middleware' => ['adminRol:jefe_bienestar']], function () {
            Route::resource('aplicacion', 'AplicacionController');
            Route::get('aplicacion/{aplicacion_id}/arte', 'AplicacionController@getArte');
            Route::post('aplicacion/subirResultados/{aplicacion_id}/percentiles','AplicacionController@actualizarPercentiles');
            Route::get('aplicacion/{aplicacion_id}/actas', 'AplicacionController@getActas');

            Route::resource('aplicacion/subirResultados','AspiranteAplicacionController');

            //Route::resource('datos','DatosController');
            Route::post('datos/insert','DatosController@insert');
            Route::resource('datos','DatosController');
            Route::get('datos/insert/search','DatosController@search');

            Route::resource('aplicacion/acta','ActaController');
            Route::get('aplicacion/acta/{aplicacion_id}/irregular','ActaController@getReporteIrregular');


            Route::post('aplicacion/acta/{aspirante_aplicacion_id}/resultado','AspiranteAplicacionController@cambiarIrregularAprobado');
        });



        Route::group(['middleware' => ['adminRol:superadmin']], function () {
            Route::resource('usuarios','GestionUsuariosController');
            Route::resource('datos','DatosController');
        });



    });
});



    Route::group(['middleware' => 'aspirante_web'], function () {
        Route::post('/password/sendResetLink','Auth\PasswordController@sendResetLink');
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



        });
});


