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
        return view("aspirante.formulario");
    }
    public function actualizarCUI()
    {
        return view("aspirante.actualizarCUI");
    }

    public function storeCUI(Request $request)
    {
        $this->validate($request, [
            'CUI' => 'required|numeric|unique:aspirantes,CUI|digits:13|min:10000000',
        ], [
            'required'      => 'El CUI es obligatorio',
            'numeric'       => 'El CUI debe ser numérico',
            'unique'        => 'El CUI especificado ya existe, si el problema persiste presentarse a la oficina de Bienestar y Desarrollo Estudiantil de la Facultad de Arquitectura.',
            'digits'        => 'El CUI especificado no es válido',
            'min'        => 'El CUI especificado no es válido',
        ]);
        $usuario = Auth::user();
        $usuario->CUI = $request->CUI;
        $usuario->save();

        return redirect( action('AspiranteController@index') );
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
        
        $request["fecha_nacimiento"] = $request->fecha_nac[2].'-'.$request->fecha_nac[1].'-'.$request->fecha_nac[0];        
            
        $form = new Formulario($request->all());
        $form->NOV=Auth::user()->NOV;
        $form->save();
        //return view("aspirante.aspirante")->with('/aspirante',$form);
        return redirect( action('AspiranteController@index') );
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
        
    }
    
    public function getConfirmacion(){
        $formulario = Auth::user()->getFormulario();
        return view('aspirante.satisfactorio',compact('formulario'));
    }
    
    public function confirmarIntereses($id,Request $request){
        $cupo = Cupo::where('anio',(date('Y')))
            ->where('carrera',str_replace('diseño','disenio',$request->carrera))
            ->where('jornada',$request->jornada)->first();
        if($cupo){
            if($cupo->confirmados<$cupo->cantidad){ //aun hay cupo
                $formulario = Formulario::find($id);                
                if($formulario->confirmacion_intereses==1){//liberar un cupo                    
                    $cupoanterior = Cupo::where('anio',(date('Y')))
                        ->where('carrera',str_replace('diseño','disenio',$formulario->carrera))
                        ->where('jornada',$formulario->jornada)
                        ->first();                    
                    $cupoanterior->confirmados=$cupoanterior->confirmados-1;                    
                    $cupoanterior->save();                    
                }
                $cupo = Cupo::where('anio',(date('Y')))
                    ->where('carrera',str_replace('diseño','disenio',$request->carrera))
                    ->where('jornada',$request->jornada)->first();
                $cupo->confirmados=$cupo->confirmados+1;
                $cupo->save();
                $formulario->update($request->all());

                $request->session()->flash('mensaje_exito','Se han confirmado tus intereses universitarios para una futura asignación como estudiante.');
                return back()->withInput();
            }else{// ya no hay cupo
                if($cupo->cantidad>0){
                    $formulario = Formulario::find($id);                
                    if($formulario->confirmacion_intereses==1){//liberar un cupo  
                        //dd($formulario);
                        //dd($request);
                        if(strcmp($formulario->carrera,$request->carrera)==0 and 
                            strcmp($formulario->jornada,$request->jornada)==0){
                            $request->session()->flash('mensaje_exito','Ya estas confirmado en esta jornada y carrera');
                            return back()->withInput();
                        }
                    }
                    return back()->withInput()->withErrors(['cupo_lleno'=>'Lo sentimos, el cupo para la carrera y jornada seleccionada está lleno.']);
                }
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
        $request["fecha_nacimiento"] = $request->fecha_nac[2].'-'.$request->fecha_nac[1].'-'.$request->fecha_nac[0];
        $formulario=Formulario::find($id);
        if($formulario->NOV==Auth::user()->NOV){
            $formulario->update($request->all());
            return view("aspirante.aspirante",compact('formulario'));
        }else{
            //error
        }
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

    public function getMunicipios($departamento){
        $guatemala = json_decode(file_get_contents(storage_path()."/aspirante_public/json/guatemala.json"), true);
        return json_encode($guatemala[$departamento]);
    }
}
