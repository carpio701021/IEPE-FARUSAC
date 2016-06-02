<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Excel;
use App\Datos_sun;
use Carbon\Carbon;

class DatosController extends Controller
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
        return view("admin.cargaDatos");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        if($request->file('datos_sun')->isValid()){
            $destinationPath = '/datos_sun'; // upload path
            $extension = $request->file('datos_sun')->getClientOriginalExtension(); // getting file extension
            $request->file('datos_sun')->move( storage_path().$destinationPath,'datos_sun.'.$extension);
            if($this->insertar_excel_enBD(storage_path().$destinationPath.'/datos_sun.'.$extension))
            $request->session()->flash('mensaje_exito','subido con exito '.$request->file);
            return back();
        }
        else{
            return back()->withErrors('archivo','Error al subir el archivo');
        }
    }

    private function insertar_excel_enBD($path){
        Excel::load($path, function($reader) {
            $results=$reader->get();
            //dd($reader->get());
            foreach ($results as $row){
                //dd($row->toarray());
                $row['fecha_nacimiento']=Carbon::createFromFormat('d/m/Y', $row->fecha_nacimiento)->toDateString();
                $row['fecha_evaluacion']=Carbon::createFromFormat('d/m/Y', $row->fecha_evaluacion)->toDateString();
                Datos_sun::create($row->toarray());
            }
            // reader methods

        });
        return true;
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
