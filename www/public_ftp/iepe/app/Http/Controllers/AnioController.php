<?php

namespace App\Http\Controllers;

use App\AspiranteAplicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Aplicacion;
use Maatwebsite\Excel\Facades\Excel;

class AnioController extends Controller
{
    public function index(){
        $anios = Aplicacion::selectraw('year')->groupby('year')->paginate(3);
        //return view('admin.aplicacion.index',['aplicacion'=> $aplicacion]);
        return view('admin.aplicacion.notificar_escuelas',compact('anios'));
    }

    public function generarListado(Request $request){
        $aprobados = AspiranteAplicacion::
        join('aplicaciones_salones_horarios as ash','aplicacion_salon_horario_id','=','ash.id')
        ->join('aplicaciones as a','aplicacion_id','=','a.id')
        ->join('actas','acta_id','=','actas.id')
        ->join('formularios as f','aspirante_id','=','f.NOV')
        ->join('aspirantes','f.NOV','=','aspirantes.NOV')
        ->where('year',$request->anio)
        ->where('carrera',$request->escuela)
        ->where('acta_id','>','0')
        ->where('estado','aprobada')
        ->selectraw('f.NOV,f.nombre,f.apellido,email,carrera,jornada');
        //dd($aprobados->get());

        $excel = Excel::create($request->anio.' Listado - '.$request->escuela, function($excel) use($aprobados){
            $excel->sheet('Listado',function($sheet) use($aprobados){
                $sheet->fromModel($aprobados->get());
            });
        });

        $excel->store('xlsx',storage_path().'/listados_escuelas');
        $excel->download('xlsx');
        return back();
    }

    public function enviarEscuela(Request $request){
        return  "enviar".$request->escuela.$request->anio;
    }
}
