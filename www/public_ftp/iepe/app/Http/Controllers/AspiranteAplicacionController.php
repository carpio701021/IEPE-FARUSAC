<?php

namespace App\Http\Controllers;

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
        $asignacion->asignar(Auth::user()->NOV,$request->aplicacion_id);
        $asignacion->save();
        return back()->withErrors(["calida"=>'calida']);
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
