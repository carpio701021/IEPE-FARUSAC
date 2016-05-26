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
        //$aplicacion = new Aplicacion;
        //return view('admin.aplicacion.index',['aplicacion'=> $aplicacion]);
        return view('admin.aplicacion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.aplicacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param aplicacionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(aplicacionRequest $request)
    {
        //Guarda una nueva aplicación
        //dd($request->all());

        $aplicacion = new Aplicacion( $request->all() );
        $aplicacion->percentil_RA	= 80;
        $aplicacion->percentil_APE	= 80;
        $aplicacion->percentil_RV	= 80;
        $aplicacion->percentil_APN	= 80;

        $destinationPath ='/arte_aplicaciones'; // upload path
        $extension = $request->file('arte')->getClientOriginalExtension(); // getting file extension
        $fileName = 'arte'. '['.Carbon::now().']'. rand(10000,99999).'.'.$extension; // rename file
        $request->file('arte')->move( storage_path().$destinationPath,$fileName);
        //$aplicacion->arte = $request->file('arte')->getClientOriginalName();
        $aplicacion->path_arte = $destinationPath . '/' . $fileName;

        $aplicacion->save();





        //meter salones
        $rsalones = $request->salones;
        foreach($rsalones as $salon){
            $aplicacion->addSalon($salon,$request->cupo);
        }
        //meter horarios
        $rhorarios = $request->horarios;
        foreach($rhorarios as $horario){
            $hs =  explode("-", $horario,2);
            $aplicacion->addHorario($hs[0],$hs[1]);
        }

        $request->session()->flash('mensaje_exito','Aplicación creada exitosamente.');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
