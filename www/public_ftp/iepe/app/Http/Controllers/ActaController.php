<?php

namespace App\Http\Controllers;

use App\Actas;
use App\Aplicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use DOMPDF;
use Illuminate\Support\Facades\Response;

class ActaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anios= Aplicacion::select('year')->distinct()->get();
        return view('admin.resultados.flujoActas',compact('anios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aplicacion=Aplicacion::find($request->aplicacion_id);
        $asignaciones = $aplicacion->getAsignaciones()
            ->where('resultado','aprobado')
            ->where('acta_id','0');
        $acta= Actas::create($request->all());//inserta aplicacion_id y estado='propuesta'

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('admin.pdf.acta',compact('acta','asignaciones','aplicacion'));
        
        $asignaciones->update(['acta_id'=>$acta->id]);
        $path=storage_path().'/actas/Acta'.$acta->id.'-'.$aplicacion->nombre();
        $pdf->save($path);
        $acta->path_pdf=$path;//pdf de propuesta
        $acta->save();
        $request->session()->flash('mensaje_exito','El acta se generó correctamente, puede revisarla en la seccion de actas');
        return back();
        //return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acta=Actas::find($id);
        return Response::make(file_get_contents($acta->path_pdf), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Acta'.$acta->id.'"'
        ]);
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
        $acta=Actas::find($id);
        $acta->update($request->all());
        $acta->evaluarEstado();
        return $acta->estado;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'hola aun no porque que hueva volver a generar actas';
    }
    
    public function getReporteIrregular($id){ //id de aplicación
        $aplicacion=Aplicacion::find($id);
        $asignaciones = $aplicacion->getAsignaciones()
            ->where('resultado','irregular');
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('admin.pdf.reporteIrregular',compact('asignaciones','aplicacion'));

        return $pdf->stream();
    }
    
    public function getQueryActas($aplicacion_id){
        $actas = Actas:://where('estado','propuesta')
        where('aplicacion_id',$aplicacion_id)->get();
        return $actas->toJson();
        
    }

    public function getInfoActa($acta_id){
        return Actas::find($acta_id)->toJson();
    }
}
