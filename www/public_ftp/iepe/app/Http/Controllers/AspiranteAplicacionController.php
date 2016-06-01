<?php

namespace App\Http\Controllers;

use App\Formulario;
use App\Mail;
use Illuminate\Http\Request;
use App\AspiranteAplicacion;
use App\AplicacionSalonHorario;
use App\Aplicacion;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AspiranteAplicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asignadas =AspiranteAplicacion::where('aspirante_id','=',Auth::user()->NOV)
            ->orderby("created_at","desc")
            ->get();

        $ids = [];
        foreach ($asignadas as $a){
            $ids[] = $a->getAplicacion()->id;
        }
        $proximas = Aplicacion::where("fecha_inicio_asignaciones","<=",date("Y-m-d"))
            ->where("fecha_fin_asignaciones",">=",date("Y-m-d"))
            ->whereNotIn('id',$ids)
            ->get();
        return view("aspirante.PruebaEspecifica")->with("proximas",$proximas)->with("asignadas",$asignadas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asignacion = new AspiranteAplicacion();
        if($asignacion->asignar(Auth::user()->NOV,$request->aplicacion_id)){//true si hay cupo, false ya no hay cupo
            $asignacion->save();

            $pdf=$this->generarConstanciaPDF($asignacion->id);

            $mail = new Mail();
            $request->session()->flash('mensaje_exito', 'Asignación realizada correctamente, puedes revisar tu salón y horario para la prueba');
            if($mail->send(Auth::user()->email,
                Auth::user()->getFormulario()->nombre." ".Auth::user()->getFormulario()->apellido,
                'Constancia de asignación',
                'Imprime esta constancia para resguardar tu asignación',
                $pdf->output(),
                'Constancia de asignación '.Auth::user()->NOV))
            {
                return back();
            }else
            {
                return back()->withErrors(['mail'=>$mail->getError()]);
            }
        }else{
            return back()->withErrors(['cupo'=>'No puede asignarse a esta aplicación porque el cupo está lleno. Abocarse a las oficinas de la facultad de arquitectura para solucionarlo']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pdf = $this->generarConstanciaPDF($id);
        return $pdf->stream();
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

    private function generarConstanciaPDF($id){
        $asignacion = AspiranteAplicacion::find($id);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Constancia de asignación</h1><h2>Prueba Especifica</h2>
        <p>'.$asignacion->getAplicacion()->nombre.' código:'.(20160000+$id).'</p>');
        return $pdf;
    }
}
