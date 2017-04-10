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
/*
Route::any('soap/wsPrimerIngreso', function () {
    $urlService =  url('soap/wsPrimerIngreso') ; // action('SoapController@wsPrimerIngreso');
    $namespace = $urlService.'?wsdl';
    $serviceAction = $urlService . '/verificar_prueba_especifica';

    global $HTTP_SERVER_VARS;
    $_SERVER['PHP_SELF'] = url('soap/wsPrimerIngreso');
    $server = new \nusoap_server();


    $server->configureWSDL('wsPrimerIngreso', false, $urlService);
    //$this->server->debug_flag = false;
    $server->wsdl->schemaTargetNamespace = $namespace;
    // Parametros de entrada
    $server->wsdl->addComplexType(
        'VERIFICAR_PE',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'USR' => array ('name'=>'USR', 'type' => 'xsd:string'),
            'PWD' => array ('name'=>'PWD', 'type' => 'xsd:string'),
            'NOV' => array ('name'=>'NOV', 'type' => 'xsd:string'),
            'UA' => array ('name'=>'UA', 'type' => 'xsd:string'),
            'EXT' => array ('name'=>'EXT', 'type' => 'xsd:string'),
            'CAR' => array ('name'=>'CAR', 'type' => 'xsd:string'),
            'CICLO' => array ('name'=>'CICLO', 'type' => 'xsd:string'),
        )
    );
    // Parametros de salida
    $server->wsdl->addComplexType(
        'RESPUESTA',
        'complexType',
        'struct',
        'all',
        '',
        array(
            'NOV'  => array('name' => 'NOV', 'type' => 'xsd:string'),
            'UA'  => array('name' => 'UA', 'type' => 'xsd:string'),
            'EXT'  => array('name' => 'EXT', 'type' => 'xsd:string'),
            'CAR'  => array('name' => 'CAR', 'type' => 'xsd:string'),
            'CICLO'  => array('name' => 'CICLO', 'type' => 'xsd:string'),
            'RESULTADO'  => array('name' => 'RESULTADO', 'type' => 'xsd:string'),
            'FECHA_CALIFICACION'  => array('name' => 'FECHA_CALIFICACION', 'type' => 'xsd:string'),
            'FECHA_CADUCA'  => array('name' => 'FECHA_CADUCA', 'type' => 'xsd:string'),
            'NOTA'  => array('name' => 'NOTA', 'type' => 'xsd:string'),
            'AUTORIZACION'  => array('name' => 'AUTORIZACION', 'type' => 'xsd:string'),
            'ERROR'  => array('name' => 'ERROR', 'type' => 'xsd:string'),
            'MSG_ERROR'  => array('name' => 'MSG_ERROR', 'type' => 'xsd:string')
            //'greeting' => array('name' => 'greeting', 'type' => 'xsd:string'),
            //'winner' => array('name' => 'winner', 'type' => 'xsd:boolean')
        )
    );

    $server->register('verificar_prueba_especifica',                // method name
        array('VERIFICAR_PE' => 'tns:VERIFICAR_PE'),        // input parameters
        array('RESPUESTA' => 'tns:RESPUESTA'),    // output parameters
        $namespace, //'urn:WS_PRIMER_INGRESO',                // namespace
        $serviceAction, //'urn:WS_PRIMER_INGRESO/verificar_prueba_especifica',                // soapaction
        'rpc',                        // style
        'encoded',                    // use
        'Servicios relacionados a primer ingreso a la Facultad de Arquitectura USAC'    // documentation
    );



    function verificar_prueba_especifica($VERIFICAR_PE) {
        //global $server;

        $RESPUESTA = [];

        //verificar el usuario y la contraseña
        //$admins = Admin::findAll();
        //dd($admins);
        //verificar resultado de estudiante


        //devolver respuesta
        $RESPUESTA['NOV'] = $VERIFICAR_PE['NOV'] ;
        $RESPUESTA['UA'] = 'Hola '.$VERIFICAR_PE['UA'] ;
        $RESPUESTA['EXT'] = '';
        $RESPUESTA['CAR'] = '';
        $RESPUESTA['CICLO'] = '';
        $RESPUESTA['RESULTADO'] = '';
        $RESPUESTA['FECHA_CALIFICACION'] = '';
        $RESPUESTA['FECHA_CADUCA'] = '';
        $RESPUESTA['NOTA'] = '';
        $RESPUESTA['AUTORIZACION'] = '';
        $RESPUESTA['ERROR'] = '';
        $RESPUESTA['MSG_ERROR'] = '';


        return $RESPUESTA;
    }

    //dd($this->server);


    $rawPostData = file_get_contents("php://input");
    return \Response::make($server->service($rawPostData), 200, array('Content-Type' => 'text/xml; charset=ISO-8859-1'));
});// */

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

    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('aspirante.password.reset');
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



