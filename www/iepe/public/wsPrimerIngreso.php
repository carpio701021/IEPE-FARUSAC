<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 25/03/17
 * Time: 07:57 PM
 */
//namespace App;
require_once "../vendor/econea/nusoap/src/nusoap.php";

// respuesta aqui http://stackoverflow.com/questions/40479452/laravel-with-nusoap-in-a-controller-does-not-work
//use App\Admin;

$server = new soap_server();

$server->configureWSDL('verificar_prueba_especifica', 'urn:verificar_prueba_especifica');

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
    array('return' => 'tns:RESPUESTA'),    // output parameters
    'urn:WS_PRIMER_INGRESO',                // namespace
    'urn:WS_PRIMER_INGRESO#verificar_prueba_especifica',                // soapaction
    'rpc',                        // style
    'encoded',                    // use
    'Servicios relacionados a primer ingreso a la Facultad de Arquitectura USAC'    // documentation
);


function verificar_prueba_especifica($VERIFICAR_PE) {
    global $server;

    $RESPUESTA = [];

    //verificar el usuario y la contraseña
    $admins = Admin::findAll();

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

$server->service(file_get_contents("php://input"));

/*
 *
 * RECIBIR un String con el siguiente XML:
<VERIFICAR_PE>
        <USR>usuario</USR>
        <PWD>contraseña</PWD>//Este usuario y contraseña es para uso de ustedes, y ustedes nos dan las credenciales para consumirlo.
        <NOV>2011026874</NOV>
        <UA>05</UA>
        <EXT>00</EXT>
        <CAR>01</CAR>
        <CICLO>2016</CICLO>
</VERIFICAR_PE>

DEVUELVE EL SIGUIENTE XML en un String
En caso de existir resultado:
<RESPUESTA>
        <NOV>2011026874</NOV>
        <UA>05</UA>
        <EXT>00</EXT>
        <CAR>01</CAR>
        <CICLO>2016</CICLO>
        <RESULTADO>Satisfactorio o Insatisfactorio</RESULTADO>
        <FECHA_CALIFICACION>2013-10-15</FECHA_CALIFICACION>
        <FECHA_CADUCA>2016-11-12</FECHA_CADUCA>
        <NOTA>62.46</NOTA> //o vacio si no desean añadirla
        <AUTORIZACION>Si ustedes desean añadir algun codigo o solo poner un mensaje P.E: Consulta con Servidor de Facultad de Medicina Veterinaria.</AUTORIZACION>
        <ERROR>0</ERROR>
        <MSG_ERROR></MSG_ERROR>
</RESPUESTA>

Sino tienen resultados devuelve:
<RESPUESTA>
   <ERROR>6</ERROR>
   <MSG_ERROR>No tiene pruebas realizadas</MSG_ERROR>
</RESPUESTA>

Cualquier duda, estoy a la orden.

Saludos,

El 15 de noviembre de 2016, 09:15, Informática RyE<usac.rye.informatica@gmail.com> escribió:
Buenos Días, los datos que debe contener la carga de pruebas específicas son los siguientes:
-Número de Orientación Vocacional
-Unidad Académica (Código)
-Extensión (Código)
-Carrera (Código)
-Resultado (Satisfactorio o Insatisfactorio)
-Nota (Si no la tuvieran, no hay problema, puede omitirse)
-Fecha de Aprobación (En el formato: YYYY-MM-DD, p.e: 2016-01-14)

 *
 *
 */


?>