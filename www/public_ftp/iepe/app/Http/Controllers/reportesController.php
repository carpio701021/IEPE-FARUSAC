<?php

namespace App\Http\Controllers;

use App\AspiranteAplicacion;
use Illuminate\Http\Request;
use App\Aspirante;
use App\Actas;

use App\Http\Requests;
use Excel;
use Carbon\Carbon;

class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.reportes.index');
    }

    public function reporteGeneral(){


        Excel::create('ReporteAspirantes_'.Carbon::now(), function($excel) {

            // Set the title
            $excel->setTitle('Reporte de aprobados');

            // Chain the setters
            $excel->setCreator('Javier Carpio y Daniel Chavarría')
                ->setCompany('Plataforma de aspirantes, facultad de Arquitectura USAC');

            // Call them separately
            $excel->setDescription('Reporte auto generado con propósito de estudio sobre los datos de todas las aplicaciones realizadas.');

            $excel->sheet('First sheet', function($sheet) {
                $consulta = AspiranteAplicacion::
                join('aspirantes','aspirantes_aplicaciones.aspirante_id','=','aspirantes.NOV')
                    ->join('aplicaciones_salones_horarios','aplicaciones_salones_horarios.id','=','aspirantes_aplicaciones.aplicacion_salon_horario_id')
                    ->join('aplicaciones','aplicaciones_salones_horarios.aplicacion_id','=','aplicaciones.id')
                    ->leftJoin('actas','aspirantes_aplicaciones.acta_id','=','actas.id')
                    ->leftJoin('formularios','aspirantes.NOV','=','formularios.NOV')
                    ->get();
                //dd($consulta);

                //$sheet->fromArray($consulta);
                $data = [];
                foreach($consulta as $tupla){
                    $data[] = [
                        'Número de Orientación Vocacional' => $tupla->NOV,
                        'Nombres' => $tupla->nombre,
                        'Apellidos' => $tupla->apellido,
                        'RA' => $tupla->nota_RA,
                        'APE' => $tupla->nota_APE,
                        'RV' => $tupla->nota_RV,
                        'APN' => $tupla->nota_APN,
                        'Percentil RA evaluado' => $tupla->percentil_RA,
                        'Percentil APE evaluado' => $tupla->percentil_APE,
                        'Percentil RV evaluado' => $tupla->percentil_RV,
                        'Percentil APN evaluado' => $tupla->percentil_APN,
                        'Año de aplicacion' => $tupla->year,
                        'Número de aplicación' => $tupla->naplicacion,
                        'No. Acta' => $tupla->acta_id,
                        'Resultado' => $tupla->resultado,
                        'Correo' => $tupla->email,
                        'Estado del acta' => $tupla->estado,
                        'Residencia' => $tupla->residencia,
                        'Departamento' => $tupla->departamento,
                        'Municipio' => $tupla->municipio,
                        'Estado Civil' => $tupla->estado_civil,
                        'Estado Laboral' => $tupla->estado_laboral,
                        'Título' => $tupla->titulo,
                        'Teléfono' => $tupla->telefono,
                        'Celular' => $tupla->celular,
                        'Año del título' => $tupla->anio_titulo,
                        'Número de dependientes' => $tupla->dependientes,
                        'Centro educativo' => $tupla->centro_educativo,
                        'Dirección de centro educativo' => $tupla->direccion_centro_educativo,
                        'Sector del centro educativo' => $tupla->sector,
                        'Carrera de interés' => $tupla->carrera,
                        'Jornada de interés' => $tupla->jornada,
                        'Confirmó sus intereses' => (isset($tupla->confirmacion_intereses)?'Si':'No'),
                        'Caso especial' => (isset($tupla->irregular)?'Si':'No'),
                        'Fecha de inicio de asignaciones' => $tupla->fecha_inicio_asignaciones,
                        'Fecha de fin de asignaciones' => $tupla->fecha_fin_asignaciones,
                    ];

                }

                $sheet->fromArray($data);
            });

        })->store('xls', storage_path('reportes/general').'['.Carbon::now().']')->download('xls');

    }
}
