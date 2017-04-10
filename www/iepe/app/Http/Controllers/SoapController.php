<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
//use App\Admin;
//use App\Aspirante;

class SoapController extends Controller
{

    public function wsPrimerIngreso(Request $request){

        $urlService = action('SoapController@wsPrimerIngreso');
        $namespace = $urlService.'?wsdl';
        $serviceAction = $urlService . '/verificar_prueba_especifica';

        global $HTTP_SERVER_VARS;
        $_SERVER['PHP_SELF'] = url('soap/wsPrimerIngreso');
        $server = new \nusoap_server();


        $server->configureWSDL('wsPrimerIngreso', false, $urlService);
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

        $server->register('App\Http\Controllers\SoapController..verificar_prueba_especifica',                // method name
            array('VERIFICAR_PE' => 'tns:VERIFICAR_PE'),        // input parameters
            array('RESPUESTA' => 'tns:RESPUESTA'),    // output parameters
            $namespace, //'urn:WS_PRIMER_INGRESO',                // namespace
            $serviceAction, //'urn:WS_PRIMER_INGRESO/verificar_prueba_especifica',                // soapaction
            'rpc',                        // style
            'encoded',                    // use
            'Servicios relacionados a primer ingreso a la Facultad de Arquitectura USAC'    // documentation
        );

        $rawPostData = file_get_contents("php://input");
        return \Response::make($server->service($rawPostData), 200, array('Content-Type' => 'text/xml; charset=ISO-8859-1'));
    }

    public static function verificar_prueba_especifica($VERIFICAR_PE) {
        $RESPUESTA = [];
        //verificar el usuario y la contraseña
        $usuario = $VERIFICAR_PE['USR'];
        $pass = $VERIFICAR_PE['PWD'];
        if (!Auth::guard('admin')->attempt(['registro_personal' => $usuario, 'password' => $pass]) || !Auth::guard('admin')->user() ->tieneRol('consultor_ws')) {
            $RESPUESTA['ERROR'] = '1';
            $RESPUESTA['MSG_ERROR'] = 'error de autenticacion';
            return $RESPUESTA;
        }


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
        $RESPUESTA['ERROR'] = '0';
        $RESPUESTA['MSG_ERROR'] = '';


        return $RESPUESTA;
    }

}
