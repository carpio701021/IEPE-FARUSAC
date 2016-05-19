<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Formulario;
use Auth;

class formularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $u=$request->user();
        dd($u);
        echo $request;
        $form = new Formulario;
        $form->nombre=$request->txt_nombre;
        $form->apellido=$request->txt_apellido;
        $form->residencia=$request->txt_ubicacion;
        $form->departamento=$request->select_departamento;
        $form->genero=$request->select_genero;
        $form->fecha_nacimiento=$request->date_nacimiento;
        $form->estado_civil=$request->select_estadoCivil;
        $form->estado_laboral=$request->select_laboral;
        $form->dependientes=$request->txt_dependientes;
        $form->titulo=$request->txt_titulo;
        $form->anio_titulo=$request->date_titulo;
        $form->centro_educativo=$request->txt_centroEducativo;
        $form->direccion_centro_educativo=$request->txt_direccion;
        $form->sector=$request->select_sectorEducativo;
        $form->carrera=$request->select_carrera;
        $form->jornada=$request->select_jornada;
        $form->NOV=$u->NOV;
        $form->save();
        return view("aspirante.aspirante");
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
