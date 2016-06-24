<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormularioRequest;
use App\Formulario;
use Auth;
use App\Cupo;
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
        $form->fecha_nacimiento = date('Y-m-d',strtotime($form->fecha_nacimiento));
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
        $cupo = Cupo::where('anio',(date('Y')+1))
            ->where('carrera',str_replace('diseño','disenio',$request->carrera))
            ->where('jornada',$request->jornada)->first();
        if($cupo){
            if($cupo->confirmados<$cupo->cantidad){ //aun hay cupo
                $formulario = Formulario::find($id);
                if($formulario->confirmacion_intereses==1){//liberar un cupo
                    $cupoanterior = Cupo::where('anio',(date('Y')+1))
                        ->where('carrera',str_replace('diseño','disenio',$formulario->carrera))
                        ->where('jornada',$formulario->jornada)
                        ->first();
                    $cupoanterior->confirmados=$cupoanterior->confirmados-1;
                    $cupoanterior->save();
                }
                $cupo->confirmados=$cupo->confirmados+1;
                $cupo->save();
                $formulario->update($request->all());

                $request->session()->flash('mensaje_exito','Se han confirmado tus intereses universitarios para una futura asignación como estudiante.');
                return back()->withInput();
            }else{// ya no hay cupo
                if($cupo->cantidad>0)
                    return back()->withInput()->withErrors(['cupo_lleno'=>'Lo sentimos, el cupo para la carrera y jornada seleccionada está lleno.']);
                else
                    return back()->withInput()->withErrors(['cupo_indefinido'=>'Aún no se ha establecido el cupo, por favor intente mas tarde.']);

            }
        }else{
            return back()->withInput()->withErrors(['cupo_indefinido'=>'Aún no se ha establecido el cupo, por favor intente mas tarde.']);
        }

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
