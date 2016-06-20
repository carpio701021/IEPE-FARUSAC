<?php

namespace App\Http\Controllers;

use App\AspiranteAplicacion;
use App\Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Aplicacion;
use Maatwebsite\Excel\Facades\Excel;
use App\Admin;

class AnioController extends Controller
{
    public function index(){
        $anios = Aplicacion::selectraw('year')->groupby('year')->orderby('year','desc')->paginate(3);
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

        $excel = Excel::create($request->anio.'_Listado-'.$request->escuela, function($excel) use($aprobados){
            $excel->sheet('Listado',function($sheet) use($aprobados){
                $sheet->fromModel($aprobados->get());
            });
        });

        $excel->store('xlsx',storage_path().'/listados_escuelas');
        $excel->download('xlsx');
        return back();
    }

    public function enviarEscuela(Request $request){
        if($request->escuela=='arquitectura')
            $rol = 'director_arquitectura';
        else
            $rol = 'director_disenio_gráfico';

        $admin = Admin::where('rol',$rol)->first();
        $filename=$request->anio.'_Listado-'.$request->escuela.'.xlsx';
        if(!file_exists(storage_path().'/listados_escuelas/'.$filename))
            return back()->withErrors(['file'=>'Por favor generar y revisar el listado antes de notificar a escuela']);
        (new Mail())->sendExcel($admin->email,
            $admin->nombre(),
            'Listado de aspirantes aprobados '.$request->escuela,
            'Saludos cordiales '.$admin->nombre().'.<br>El listado adjunto contiene los aspirantes aprobados en las pruebas específicas realizadas en el año '.$request->anio.'.',
            storage_path().'/listados_escuelas/'.$filename,
            $filename
            );

        return  back();
    }

}
