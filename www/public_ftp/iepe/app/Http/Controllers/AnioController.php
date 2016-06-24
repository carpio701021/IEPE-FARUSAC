<?php

namespace App\Http\Controllers;

use App\AspiranteAplicacion;
use App\Cupo;
use App\Mail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Aplicacion;
use Maatwebsite\Excel\Facades\Excel;
use App\Admin;
use Symfony\Component\Routing\Tests\Fixtures\RedirectableUrlMatcher;

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
        ->selectraw('f.NOV,aspirantes.nombre,aspirantes.apellido,email,carrera,jornada,confirmacion_intereses as confirmacion');
        //dd($aprobados->first());

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
        $request->session()->flash('mensaje_exito','Se ha enviado el listado a la siguiente dirección de correo electronico: '.$admin->email);
        return  back();
    }
    
    public function indexPrimerIngreso(){
        $anios = Cupo::selectraw('anio')->groupby('anio')->orderby('anio','desc')->paginate(3);
        return view('admin.escuela.cupos',compact('anios'));

    }
    
    public function guardarCupo(Request $request){
        $cupo =Cupo::where('carrera',$request->carrera)->where('jornada',$request->jornada)
            ->where('anio',$request->anio)->first();
        if($cupo){
            $cupo->update($request->all());
        }else{
            $cupo= new Cupo($request->all());
            $cupo->save();
        }
        $request->session()->flash('mensaje_exito','El cupo se ha actualizado para la jornada '.$request->jornada.
    ' del año '.$request->anio);
        return back();
    }

    public function nuevoAnio(Request $request){
        if(count(Cupo::all())==0){
            $ultimoAnio=date('Y');
        }else{
            $ultimoAnio = Cupo::groupby('anio')->orderby('anio','desc')->first()->anio;
        }
        Cupo::create(['anio'=>$ultimoAnio+1,'jornada'=>'matutina','carrera'=>'arquitectura']);
        Cupo::create(['anio'=>$ultimoAnio+1,'jornada'=>'vespertina','carrera'=>'arquitectura']);
        Cupo::create(['anio'=>$ultimoAnio+1,'jornada'=>'matutina','carrera'=>'disenio']);
        Cupo::create(['anio'=>$ultimoAnio+1,'jornada'=>'vespertina','carrera'=>'disenio']);
        return back();
    }

    public function getListado(Request $request){
        $path =storage_path().'/listados_escuelas/'.$request->anio.'_Listado-'.$request->carrera.'.xlsx';
        if(!file_exists($path)){
            return back()->withErrors(['file'=>'El listado aún no se ha generado por el administrador del sistema']);
        }
        Excel::load($path)->download();
        return back();
    }

}
