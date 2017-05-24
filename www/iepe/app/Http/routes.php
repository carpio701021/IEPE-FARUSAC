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

Route::get('aspirante', function () {
    return redirect('/');
});

Route::any('soap/wsPrimerIngreso', 'SoapController@wsPrimerIngreso');

//Route::any('soap/wsPrimerIngreso', 'SoapController@wsPrimerIngreso');

Route::get('soap/wsPrimerIngresox', function () {
/*
 * <VERIFICAR_PE>
        <USR>usuario</USR>
        <PWD>contraseña</PWD>//Este usuario y contraseña es para uso de ustedes, y ustedes nos dan las credenciales para consumirlo.
        <NOV>2011026874</NOV>
        <UA>05</UA>
        <EXT>00</EXT>
        <CAR>01</CAR>
        <CICLO>2016</CICLO>
</VERIFICAR_PE>
 */

    $respuesta = verificar_prueba_especifica([
        'USR' => '10006',
        'PWD' => '123123',
        'NOV' => '1000000958',
        'UA' => '02',
        'EXT' => '00',
        'CAR' => '01',
        'CICLO' => '2016'
    ]);

    return view('welcome2',compact('respuesta'));
});

Route::group(['prefix' => 'aspirante'], function () {

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
        //Authentication Routes...
        $this->get('login', 'AuthAdmin\AuthController@showLoginForm')->name('admin.login');
        $this->post('login', 'AuthAdmin\AuthController@login')->name('admin.login');
        $this->get('logout', 'AuthAdmin\AuthController@logout')->name('admin.logout');


        Route::group(['middleware' => ['auth:admin']], function () {

            Route::group(['middleware' => ['adminRol:directores']], function () {
                //********** RUTAS DE DIRECTORES DE ESCUELA*************
                Route::get('escuela/primerIngreso', 'AnioController@indexPrimerIngreso')->name('admin.escuela.primerIngreso');
                Route::post('escuela/primerIngreso/guardarCupo', 'AnioController@guardarCupo')->name('admin.escuela.primerIngreso.guardarCupo');
                Route::get('escuela/primerIngreso/nuevo', 'AnioController@nuevoAnio')->name('admin.escuela.primerIngreso.nuevo');
                Route::get('escuela/primerIngreso/listado', 'AnioController@getListado')->name('admin.escuela.primerIngreso.listado');

            });

            Route::get('/', function () {
                return view('admin.index');
            })->name('admin.index');
            Route::resource('/conf', 'AdminController');

            Route::group(['middleware' => ['adminRol:jefe_bienestar']], function () {

                Route::resource('aplicacion', 'AplicacionController');
                Route::get('aplicacion/{aplicacion_id}/arte', 'AplicacionController@getArte')->name('admin.aplicacion.arte');
                Route::get('aplicacion/{aplicacion_id}/especial', 'AplicacionController@getCrearEspecial')->name('admin.aplicacion.especial');

                Route::get('aplicacion/{aplicacion_id}/actas', 'AplicacionController@getActas')->name('admin.aplicacion.actas');
                Route::get('aplicacion/{aplicacion_id}/listados', 'AplicacionController@getListados')->name('admin.aplicacion.listados');
                Route::get('aplicacion/{aplicacion_id}/listadoGeneral', 'AplicacionController@getListadoGeneral')->name('admin.aplicacion.listadoGeneral');
                Route::get('aplicacion/{aplicacion_id}/habilitar', 'AplicacionController@habilitarResultados')->name('admin.aplicacion.habilitar');
                Route::post('aplicacion/notificar','AplicacionController@notificar')->name('admin.aplicacion.notificar');

                Route::resource('aspirantes','ListaNegraController');
                Route::get('CasosEspeciales','ListaNegraController@getListaNegra')->name('admin.listaNegra');
                Route::get('CasosEspeciales/{search}','ListaNegraController@listaNegraShow')->name('admin.listaNegra.search');
                Route::resource('aplicacion/subirResultados','AspiranteAplicacionController',['only' => [
                    'edit','update'
                ]]);
                Route::post('aplicacion/subirResultados/{aplicacion_id}/percentiles','AplicacionController@actualizarPercentiles')->name('admin.aplicacion.percentiles');
                Route::get('aplicacion/plantilla/resultados','AspiranteAplicacionController@descargarPlantillaResultados')->name('admin.aplicacion.plantillaResutlados');


                //Route::resource('datos','DatosController');
                Route::post('datos/insert','DatosController@insert')->name('admin.datos.insert');
                Route::get('datos/create','DatosController@create')->name('admin.datos.create');
                Route::get('datos/insert/search','DatosController@search')->name('admin.datos.search');

                Route::get('acta/{aplicacion_id}/irregular','ActaController@getReporteIrregular')->name('admin.acta.irregular');
                Route::post('acta/{aspirante_aplicacion_id}/resultado','AspiranteAplicacionController@cambiarIrregularAprobado')->name('admin.acta.resultado');

                //recursos
                Route::get('recursos','RecursosController@index')->name('admin.recursos');
                Route::post('recursos/reglamento','RecursosController@postReglamento')->name('admin.recursos.reglamento');
                Route::post('recursos/imagenInformativa','RecursosController@postImagenInformativa')->name('admin.recursos.imagenInformativa');
                Route::post('recursos/videoBienvenida','RecursosController@postBienvenida')->name('admin.recursos.bienvenida');
                Route::post('recursos/guia-asignacion','RecursosController@postGuiaAsignacion')->name('admin.recursos.guia-asignacion');
                Route::post('recursos/guia-aplicacion','RecursosController@postGuiaAplicacion')->name('admin.recursos.guia-aplicacion');

                Route::get('reportes', 'reportesController@index')->name('admin.reportes.index');
                Route::get('reportes/general', 'reportesController@reporteGeneral')->name('admin.reportes.reporteGeneral');

            });

            Route::group(['middleware' => ['adminRol:secretario_decano_jefe_bienestar']], function () {
                Route::resource('acta', 'ActaController');
                Route::get('acta/search/{aplicacion_id}', 'ActaController@getQueryActas')->name('admin.acta.search');
                Route::get('acta/info/{acta_id}', 'ActaController@getInfoActa')->name('admin.acta.info');
                Route::get('acta/getAplicacionesAnio/{anio}','AplicacionController@getAplicacionesAnio')->name('admin.acta.getAplicacionesAnio');
                Route::get('acta/{acta_id}/constanciasSatisfactorias', 'ActaController@getConstanciasSatisfactorias')->name('admin.acta.constanciasSatisfactorias');
            });

            Route::group(['middleware' => ['adminRol:superadmin']], function () {
                Route::get('usuarios/adminsEliminados','GestionUsuariosController@adminsEliminados')->name('admin.usuarios.adminsEliminados');
                Route::get('usuarios/adminsEliminados/restore/{id}','GestionUsuariosController@restoreAdmin')->name('admin.usuarios.adminsEliminados.restoreAdmin');
                Route::resource('usuarios','GestionUsuariosController');
                

                Route::post('datos','DatosController@store')->name('admin.datos');
                Route::get('datos','DatosController@index')->name('admin.datos');
                Route::get('datos/plantilla','DatosController@descargarPlantilla')->name('admin.datos.plantilla');
                Route::get('notificar','AnioController@index')->name('admin.notificar');
                Route::get('notificar/listado','AnioController@generarListado')->name('admin.notificar.listado');
                Route::get('notificar/enviar','AnioController@enviarEscuela')->name('admin.notificar.enviar');
            });

        });
    });








});



Route::group(['middleware' => 'aspirante_web'], function () {
    Route::post('password/sendResetLink','Auth\PasswordController@sendResetLink')->name('aspirante.sendResetLink');//componer rutas
    Route::get('activation/{token}', 'Auth\AuthController@activateUser')->name('aspirante.activate');//componer correo

    /** auth routes equivalentes a Route::auth(); **/
    Route::get('login', 'Auth\AuthController@showLoginForm')->name('aspirante.login');
    Route::post('login', 'Auth\AuthController@login')->name('aspirante.login');
    Route::get('logout', 'Auth\AuthController@logout')->name('aspirante.logout');

    Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('aspirante.register');
    Route::post('register', 'Auth\AuthController@register')->name('aspirante.register');

    Route::get('aspirante/password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('aspirante.password.reset');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('aspirante.password.email');
    Route::post('password/reset', 'Auth\PasswordController@reset')->name('aspirante.password.reset');
    //fin auth


    Route::get('/', 'HomeController@index')->name('aspirante.home');

    //recursos del aspirante
    Route::get('recursos/imagenInformativa', 'RecursosController@viewImagenInformativa')->name('aspirante.recursos.imagenInformativa');
    Route::get('recursos/reglamento', 'RecursosController@getReglamento')->name('aspirante.recursos.reglamento');
    Route::get('recursos/guia-asignacion', 'RecursosController@viewGuiaAsignacion')->name('aspirante.recursos.guia-asignacion');
    Route::get('recursos/guia-aplicacion', 'RecursosController@viewGuiaAplicacion')->name('aspirante.recursos.guia-aplicacion');

    Route::group(['middleware' => ['auth:aspirante_web']], function () {
        Route::get('configuracion', function () {
            return view('aspirante.configurarCuenta');
        })->name('aspirante.configuracion');
        Route::post('configuracion/guardar', "AspiranteController@actualizarCuenta")->name('aspirante.configuracion.guardar');
        Route::resource('datos', 'AspiranteController');
        Route::resource('formulario', 'formularioController');
        Route::get('actualizarCUI', 'formularioController@actualizarCUI');
        Route::post('actualizarCUI', 'formularioController@storeCUI');
        Route::get('aprobados', 'formularioController@getConfirmacion');
        Route::post('formulario/{formulario_id}/confirmar', 'formularioController@confirmarIntereses')->name('aspirante.formulario.confirmar');
        Route::resource('PruebaEspecifica', 'AspiranteAplicacionController', ['only' => [
            'create','store','show'
        ]]);



    });
});



