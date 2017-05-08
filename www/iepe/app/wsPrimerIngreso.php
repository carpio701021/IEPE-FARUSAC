<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 25/03/17
 * Time: 07:57 PM
 */

use Auth;
use App\Admin;
use App\Aspirante;

function verificar_prueba_especifica($VERIFICAR_PE) {
    $RESPUESTA = [];
    //return ($VERIFICAR_PE);

    //verificar resultado de estudiante
    try{
        //verificar el usuario, la contraseña y el rol
        $usuario = $VERIFICAR_PE['USR'];
        $pass = $VERIFICAR_PE['PWD'];
        if (!Auth::guard('admin')->attempt(['registro_personal' => $usuario, 'password' => $pass]) || !Auth::guard('admin')->user()->tieneRol('consultor_ws')) {
            $RESPUESTA['ERROR'] = '1';
            $RESPUESTA['MSG_ERROR'] = 'Error de autenticacion. Usuario o contraseña invalidos.';
            return $RESPUESTA;
        }

        //verifica que el usuario exista
        $aspirante = Aspirante::where('NOV',$VERIFICAR_PE['NOV'])->first();
        if($aspirante===null)
            return erroresWsPrimerIngreso(2);

        //traer resultados satisfactorios
        $resultados = $aspirante->resultadosPruebaEspecifica();
        if($resultados===null)
            return $RESPUESTA=[
                'NOV' => $VERIFICAR_PE['NOV'],
                'RESULTADO' => 'Insatisfactorio',
                'ERROR' => '0',
                'MSG_ERROR' => ''
            ];

        //devolver respuesta
        $RESPUESTA['NOV'] = $aspirante->getNOV();
        $RESPUESTA['UA'] = $VERIFICAR_PE['UA'] ;
        $RESPUESTA['EXT'] = '';
        $RESPUESTA['CAR'] = '';
        $RESPUESTA['CICLO'] = '';
        $RESPUESTA['RESULTADO'] = 'Satisfactorio';
        $RESPUESTA['FECHA_CALIFICACION'] = $resultados->updated_at;
        $RESPUESTA['FECHA_CADUCA'] = '';
        $RESPUESTA['NOTA'] = '';
        $RESPUESTA['AUTORIZACION'] = 'Codigo de constancia '.md5($resultados->getFechaAplicacion().'-'.$aspirante->getNOV());
        $RESPUESTA['ERROR'] = '0';
        $RESPUESTA['MSG_ERROR'] = '';

        return $RESPUESTA;
    } catch (Exception $e) {
        return erroresWsPrimerIngreso(100,$e);
    }
}

function erroresWsPrimerIngreso($noError,$exception = null){
    $RESPUESTA = [];
    $RESPUESTA['ERROR'] = $noError;
    switch($noError){
        case 1:
            $RESPUESTA['MSG_ERROR'] = 'Error de autenticacion. Usuario o contraseña invalidos.';
            break;
        case 2:
            $RESPUESTA['MSG_ERROR'] = 'No se encontro ninguna coincidencia para el NOV proporcionado.';
            break;
        default:
            $RESPUESTA['MSG_ERROR'] = 'Error inesperado.';
            break;
    }
    if (getenv('APP_DEBUG')==='true' && $exception!=null)  $RESPUESTA['MSG_ERROR'] .= ' Exception: '. $exception;


    return $RESPUESTA;
}

/*
 *
 * RECIBIR un String con el siguiente XML:
<VERIFICAR_PE>
        <USR>10006</USR>
        <PWD>123123</PWD>
        <NOV>1000000003</NOV>
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