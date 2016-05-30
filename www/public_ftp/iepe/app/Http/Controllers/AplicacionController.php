<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AplicacionRequest;
use App\Aplicacion;
use Carbon\Carbon ;
use File;

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
        //Guarda una nueva aplicación
        $aplicacion = new Aplicacion( $request->all() );
        $aplicacion->percentil_RA	= 80;
        $aplicacion->percentil_APE	= 80;
        $aplicacion->percentil_RV	= 80;
        $aplicacion->percentil_APN	= 80;

        if($request->hasFile('arte')){
            $destinationPath ='/arte_aplicaciones'; // upload path
            $extension = $request->file('arte')->getClientOriginalExtension(); // getting file extension
            $fileName = 'arte'. '['.Carbon::now().']'. rand(10000,99999).'.'.$extension; // rename file
            $request->file('arte')->move( storage_path().$destinationPath,$fileName);
            $aplicacion->path_arte = $destinationPath . '/' . $fileName;
        }

        $aplicacion->save();
        $aplicacion->agregarSalonesHorarios($request->salones,$request->horarios);

        $request->session()->flash('mensaje_exito','Aplicación <i>'+$aplicacion->nombre+'</i> creada exitosamente.');
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
        //
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
        //
        $aplicacion = Aplicacion::where('id',$id)->first();
        //dd($aplicacion);
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

        $request->session()->flash('mensaje_exito','Cambios en aplicación <i>'+$aplicacion->nombre+'</i> guardados.');
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
}
