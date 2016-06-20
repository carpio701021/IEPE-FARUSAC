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
            Route::get('aplicacion/{aplicacion_id}/especial', 'AplicacionController@getCrearEspecial');
            Route::post('aplicacion/subirResultados/{aplicacion_id}/percentiles','AplicacionController@actualizarPercentiles');
            Route::get('aplicacion/{aplicacion_id}/actas', 'AplicacionController@getActas');
            Route::get('aplicacion/{aplicacion_id}/listados', 'AplicacionController@getListados');


            Route::resource('aplicacion/subirResultados','AspiranteAplicacionController');

            //Route::resource('datos','DatosController');
            Route::post('datos/insert','DatosController@insert');
            Route::get('datos/create','DatosController@create');
            Route::get('datos/insert/search','DatosController@search');

            Route::get('acta/{aplicacion_id}/irregular','ActaController@getReporteIrregular');
            Route::get('acta/{acta_id}/notificar','ActaController@notificar');

            Route::post('acta/{aspirante_aplicacion_id}/resultado','AspiranteAplicacionController@cambiarIrregularAprobado');
        });

        Route::group(['middleware' => ['adminRol:secretario_decano_jefe_bienestar']], function () {
            Route::resource('acta', 'ActaController');
            Route::get('acta/search/{aplicacion_id}', 'ActaController@getQueryActas');
            Route::get('acta/info/{acta_id}', 'ActaController@getInfoActa');
            Route::get('acta/getAplicacionesAnio/{anio}','AplicacionController@getAplicacionesAnio');
            Route::get('acta/{acta_id}/constanciasSatisfactorias', 'ActaController@getConstanciasSatisfactorias');
        });

        Route::group(['middleware' => ['adminRol:superadmin']], function () {
            Route::resource('usuarios','GestionUsuariosController');
            //Route::resource('datos','DatosController');
            Route::post('datos','DatosController@store');
            Route::get('datos','DatosController@index');
            Route::get('notificar','AnioController@index');
            Route::get('notificar/listado','AnioController@generarListado');
            Route::get('notificar/enviar','AnioController@enviarEscuela');
        });

    });
});



Route::group(['middleware' => 'aspirante_web'], function () {
    Route::post('/password/sendResetLink','Auth\PasswordController@sendResetLink');
    Route::get('aspirante/activation/{token}', 'Auth\AuthController@activateUser')->name('aspirante.activate');
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


