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
        $serviceActionStr = $urlService . '/verificar_prueba_especifica_str';

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
                'CUI' => array ('name'=>'CUI', 'type' => 'xsd:string'),
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
                'CUI'  => array('name' => 'CUI', 'type' => 'xsd:string'),
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


        $server->register("verificar_prueba_especifica_str",
            array("pxml" => "xsd:string"),
            array("result" => "xsd:string"),   // output parameters
            $namespace, //'urn:WS_PRIMER_INGRESO',                // namespace
            $serviceActionStr, //'urn:WS_PRIMER_INGRESO/verificar_prueba_especifica',                // soapaction
            'rpc',                        // style
            'encoded',                    // use
            'Servicios relacionados a primer ingreso a la Facultad de Arquitectura USAC. Igual que el primero pero el input y el output en un solo string.'    // documentation
        );

//update aplicaciones set percentil_RA_disenio = percentil_RA, percentil_APE_disenio = percentil_APE, percentil_RV_disenio = percentil_RV, percentil_APN_disenio = percentil_APN where percentil_RA_disenio

        //dd(get_class_methods('SoapController'));
        //dd([
        //    "get_defined_functions" => get_defined_functions(),
        //    "get_declared_classes" => get_declared_classes()
        //]);

        $rawPostData = file_get_contents("php://input");
        return \Response::make($server->service($rawPostData), 200, array('Content-Type' => 'text/xml; charset=ISO-8859-1'));
    }

}
