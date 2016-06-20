<?php

namespace App\Http\Controllers;

use App\Aspirante;
use App\Formulario;
use App\Mail;
use Illuminate\Http\Request;
use App\AspiranteAplicacion;
use App\AplicacionSalonHorario;
use App\Aplicacion;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Excel;
use Illuminate\Support\Facades\DB;

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
            if($mail->send([Auth::user()->email =>
                Auth::user()->getFormulario()->nombre." ".Auth::user()->getFormulario()->apellido],
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
        $aplicacion=Aplicacion::find($id);
        return view('admin.aplicacion.subirResultados')->with(['aplicacion'=>$aplicacion,
        'resumen_areas'=>$aplicacion->getResumen_Areas()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//actualiza las notas de cada asignación con un excel
    {   $aplicacion = Aplicacion::find($id);
        if($request->file('file')->isValid()){
            $destinationPath = storage_path().'/Resultados'; // upload path
            $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
            $request->file('file')->move($destinationPath,$id.'-'.$aplicacion->nombre().'.'.$extension);
            $path=$destinationPath.'/'.$id.'-'.$aplicacion->nombre().'.'.$extension;
            //$error=$this->insertarNotas($path,$id);
            $error=$this->insertarNotas($path,$id);
            if($error){
                return back()->withErrors($error);
            }
            $request->session()->flash('mensaje_exito', 'Se procesó todo el archivo con exito');
            return back();
        }
        else{
            return back()->withErrors('archivo','Error al subir el archivo');
        }
    }


    private function insertarNotas($path,$idAplicacion){
        $this->borrar_notas_anteriores($idAplicacion);
        $reader = Excel::load($path);
        $reader->ignoreEmpty();//ignorar las celdas vacias
        $conteo=0; $insertados=0;
        $salonesHorarios = Aplicacion::find($idAplicacion)->getSalonesHorarios();
        foreach($reader->get() as $row){
            $conteo=$conteo+1;
            $validator=$this->validar_fila_excel($row,$conteo);
            if($validator->fails()){
                return $validator;
            }
            foreach($salonesHorarios as $sa){
                $asignacion = $sa->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')->where('aspirante_id',$row->orientacion)->first();;
                if($asignacion){
                    $asignacion['nota_RA'] = $row->ra;
                    $asignacion['nota_APE'] = $row->ape;
                    $asignacion['nota_RV'] = $row->rv;
                    $asignacion['nota_APN'] = $row->apn;
                    $asignacion->save();
                    $insertados++;
                    break;
                }
            }
        }
        //dd($insertados);
        return null;
    }

    function borrar_notas_anteriores($idAplicacion){
        $asignaciones=Db::table('aspirantes_aplicaciones as aa')
            ->join('aplicaciones_salones_horarios as ash','ash.id','=','aa.aplicacion_salon_horario_id')
            ->where('ash.aplicacion_id','=',$idAplicacion);
        $asignaciones->update(['nota_RA'=>0,
                'nota_APE'=>0,
                'nota_RV'=>0,
                'nota_APN'=>0]);
    }

    function validar_fila_excel($row,$conteo){
        $rules=['ra'=>'required|integer|max:100|min:0',
            'ape'=>'required|integer|max:100|min:0',
            'rv'=>'required|integer|max:100|min:0',
            'apn'=>'required|integer|max:100|min:0',
            'orientacion'=>'required'
        ];
        $messages=[
            'required'      => 'Fila '.$conteo.': El campo :attribute es obligatorio',
            'integer'       => 'Fila '.$conteo.': El campo :attribute debe ser un entero',
            'max'           => 'Fila '.$conteo.': El campo :attribute no puede ser mayor a :max',
            'min'           => 'Fila '.$conteo.': El campo :attribute no puede ser menor a :min',
        ];
        return Validator::make($row->toarray(), $rules,$messages);

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
        $pdf->setPaper(array(0, 0, 740, 570), 'portrait');
        $aspirante = Auth::user();
        $pdf->loadView('aspirante.pdf.constanciaAsignacion',compact('asignacion','id','aspirante'));
        return $pdf;
    }

    public function cambiarIrregularAprobado(Request $request, $id){
        $a=AspiranteAplicacion::find($id);
        $a->update($request->all());
        return back();
    }
}
