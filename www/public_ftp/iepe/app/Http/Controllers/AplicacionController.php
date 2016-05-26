<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\aplicacionRequest;
use App\Aplicacion;
use Carbon\Carbon ;

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
     * @param aplicacionRequest $request
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
