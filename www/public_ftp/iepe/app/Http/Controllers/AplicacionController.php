<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AplicacionRequest;
use App\Http\Requests\PercentilRequest;
use App\Aplicacion;
use Carbon\Carbon ;
use File;
use Illuminate\Support\Facades\DB;

class AplicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aplicaciones = Aplicacion::orderBy('fecha_aplicacion', 'desc')->paginate(3);
        //return view('admin.aplicacion.index',['aplicacion'=> $aplicacion]);
        return view('admin.aplicacion.index',compact('aplicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$aplicacion = Aplicacion::first();
        $aplicacion = new Aplicacion();
        return view('admin.aplicacion.create',compact('aplicacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AplicacionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AplicacionRequest $request)
    {
        if(Aplicacion::where('year',$request->year)->where('naplicacion',$request->naplicacion)->first()){
            $errors = Array('La combinacion de año y número de aplicación ya existe');
            return redirect('/admin/aplicacion/create')->withErrors($errors)->withInput();
        }

        //Guarda una nueva aplicación
        $aplicacion = new Aplicacion( $request->all() );
        $aplicacion->percentil_RA	= 80;
        $aplicacion->percentil_APE	= 80;
        $aplicacion->percentil_RV	= 80;
        $aplicacion->percentil_APN	= 80;

        $aplicacion->save();
        $aplicacion->agregarSalonesHorarios($request->salones,$request->horarios);

        $request->session()->flash('mensaje_exito','Aplicación <i>'.$aplicacion->nombre().'</i> creada exitosamente.');
        return redirect('/admin/aplicacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $orden='desc';
        $ob=$_GET['orden'];
        //dd($orderby);
        if($ob==0) {
            $orderby = 'id';
            $orden='asc';
        }
        elseif ($ob==1) {
            $orderby = 'aspirante_id';
            $orden = 'asc';
        }
        elseif ($ob==2)
            $orderby='nota_RA';
        elseif ($ob==3)
            $orderby='nota_APE';
        elseif ($ob==4)
            $orderby='nota_RV';
        elseif ($ob==5)
            $orderby='nota_APN';


        $asignaciones=Aplicacion::find($id)->getAsignaciones()
            ->where('acta_id','=',0)
            ->where('resultado','=','aprobado')
            ->orwhere('resultado','=','irregular')
            //, (nota_RA+nota_RV+nota_APN+nota_APE) as suma')
            //->orderby('suma','desc')
            ->orderby($orderby,$orden)
            ->paginate(15);

        $aplicacion = Aplicacion::find($id);
        return view('admin.aplicacion.NotasAspirantes',
            compact('asignaciones','aplicacion','ob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $aplicacion = Aplicacion::findOrFail($id);
        //dd($aplicacion->fecha_inicio_asignaciones < date("Y-m-d"));
        if($aplicacion->fecha_inicio_asignaciones<date("Y-m-d") && date("Y-m-d h:i")<$aplicacion->fecha_fin_asignaciones){
            $errors = Array('No se puede editar la <i>'.$aplicacion->nombre().'</i> ya que está en tiempo de asignaciones');
            return redirect('/admin/aplicacion')->withErrors($errors)->withInput();
        }
        $titulo = 'Editar aplicación';
        $put = true;
        return view('admin.aplicacion.create',compact('aplicacion','titulo','put'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AplicacionRequest $request, $id)
    {
        if(Aplicacion::where('id','!=',$id)->where('year',$request->year)->where('naplicacion',$request->naplicacion)->first()){
            $errors = Array('La combinacion de año y número de aplicación ya existe');
            return redirect('/admin/aplicacion/'.$id.'/edit')->withErrors($errors)->withInput();
        }

        $aplicacion = Aplicacion::where('id',$id)->first();
        $aplicacion->update( $request->all() );
        if($request->hasFile('arte')){
            $destinationPath ='/arte_aplicaciones'; // upload path
            $extension = $request->file('arte')->getClientOriginalExtension(); // getting file extension
            $fileName = 'arte'. '['.Carbon::now().']'. rand(10000,99999).'.'.$extension; // rename file
            $request->file('arte')->move( storage_path().$destinationPath,$fileName);
            $aplicacion->path_arte = $destinationPath . '/' . $fileName;
        }

        $aplicacion->save();
        $aplicacion->agregarSalonesHorarios($request->salones,$request->horarios);

        $request->session()->flash('mensaje_exito','Cambios en aplicación <i>'.$aplicacion->nombre().'</i> guardados.');
        return redirect('/admin/aplicacion');
    }

    public function getArte($aplicacion_id){
        $aplicacion = Aplicacion::where('id',$aplicacion_id)->firstOrFail();
        //dd($aplicacion);
        if(isset($aplicacion->path_arte)){
            $file = File::get(storage_path().$aplicacion->path_arte);
        }else{
            abort(403, 'Imagen no encontrada.');
            dd("nanai");
        }

        $response = \Response::make($file, 200);
        // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
        $response->header('Content-Type', 'image/*');
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function actualizarPercentiles(PercentilRequest $request,$id){
        $aplicacion = Aplicacion::find($id);
        $aplicacion->percentil_RA=$request->percentil_RA;
        $aplicacion->percentil_APE=$request->percentil_APE;
        $aplicacion->percentil_RV=$request->percentil_RV;
        $aplicacion->percentil_APN=$request->percentil_APN;
        $aplicacion->save();
        $aplicacion->calificar();//actualizará la tabla aspirantes_aplicaciones
        //dd($aplicacion->getResumen_Areas());
        return back();//->with("resumen_areas",$aplicacion->getResumen_Areas());
    }
    
    public function getActas($id){
        $aplicacion=Aplicacion::find($id);
        $actas = $aplicacion->getActas();
        return view('admin.aplicacion.Actas',compact('actas','aplicacion'));
    }
    
    
    
}
