<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Excel;
use App\Datos_sun;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
            $resultados=$this->insertar_excel_enBD(storage_path().$destinationPath.'/datos_sun.'.$extension);
            $errores=$resultados['errors'];
            $request->session()->flash('mensaje_exito', 'Se procesaron '.$resultados['insertados'].' filas con exito');
            if(count($errores)==0) {
                return back();
            }else{
                //$errores
                foreach ($errores as $e)
                    foreach ($e->messages()->toarray() as $m)
                        $err[]=$m;
                return back()->withErrors($err);
            }
        }
        else{
            return back()->withErrors('archivo','Error al subir el archivo');
        }
    }


    private function insertar_excel_enBD($path){
        $reader = Excel::load($path);
        $errors=[];
        $results=$reader->get();
        $insertados=0;
        $conteo=1;
        foreach ($results as $row){
            $row['fecha_evaluacion']=Carbon::createFromFormat('d/m/Y', $row->fecha_evaluacion)->toDateString();
            $row['fecha_nacimiento']=Carbon::createFromFormat('d/m/Y', $row->fecha_nacimiento)->toDateString();
            $conteo=$conteo+1;
            $validator=$this->validar($row,$conteo);
            if($validator->fails()){
                array_push($errors,$validator);
            }elseif(!(Datos_sun::where('fecha_evaluacion',$row->fecha_evaluacion)->where('orientacion',$row->orientacion)->count()>0)){
                Datos_sun::create($row->toarray());
                $insertados=$insertados+1;
            }
        }
        return ['errors'=>$errors,'insertados'=>$insertados];

    }

    private function validar($row,$conteo){
        $rules = [
            'orientacion' => 'required|integer|digits:10',
            'primer_apellido' => 'required|max:35',
            'segundo_apellido' =>'required|max:35',
            'primer_nombre' => 'required|max:35',
            'segundo_nombre' => 'required|max:35',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:1,0',
            'id_materia' => 'required|integer',
            'aprobacion' => 'required|in:1,0,true,false',
            'fecha_evaluacion' => 'required|date',
            'anio_evaluacion' => 'required|integer',
        ];
        $messages=[
            'required'      => 'Fila '.$conteo.': El campo :attribute es obligatorio',
            'date'          => 'Fila '.$conteo.': La :attribute no tiene el formato correcto',
            'integer'       => 'Fila '.$conteo.': El campo :attribute debe ser un entero',
            'in'            => 'Fila '.$conteo.': El campo :attribute debe ser uno de los siguientes valores: :values',
            'max'           => 'Fila '.$conteo.': El campo :attribute no puede ser mayor a :max',
            'digits'           => 'Fila '.$conteo.': El campo :attribute debe tener :digits digitos',
        ];
        return Validator::make($row->toarray(), $rules,$messages);
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
