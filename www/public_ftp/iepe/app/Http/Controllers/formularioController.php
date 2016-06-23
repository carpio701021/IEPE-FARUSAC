<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormularioRequest;
use App\Formulario;
use Auth;
use Symfony\Component\DomCrawler\Form;

class formularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormularioRequest $request)
    {
        $form = new Formulario($request->all());
        $form->NOV=Auth::user()->NOV;
        $form->save();
        return view("aspirante.aspirante")->with('formulario',$form);
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
        $formulario = Formulario::find($id);
        return view('aspirante.satisfactorio',compact('formulario'));
    }
    
    public function confirmarIntereses($id,Request $request){
        Formulario::find($id)->update($request->all());
        $request->session()->flash('mensaje_exito','Se han confirmado tus intereses universitarios para una futura asignación como estudiante.');
        return back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormularioRequest $request, $id)
    {
        Formulario::find($id)->update($request->all());
        $form=Formulario::find($id);
        return view("aspirante.aspirante")->with('formulario',$form);
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
