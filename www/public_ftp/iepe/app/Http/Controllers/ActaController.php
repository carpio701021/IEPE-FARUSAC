<?php

namespace App\Http\Controllers;

use App\Actas;
use App\Aplicacion;
use App\AspiranteAplicacion;
use Illuminate\Http\Request;
use App\Mail;
use App\Http\Requests;
use App\Admin;
use DOMPDF;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Psy\Util\Json;

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
        setlocale(LC_ALL,"es_ES");//para fechas en español
        $aplicacion=Aplicacion::find($request->aplicacion_id);
        $asignaciones = $aplicacion->getAsignaciones()
            ->where('resultado','aprobado')
            ->where('acta_id','0');
        $acta= Actas::create($request->all());//inserta aplicacion_id y estado='propuesta'

        $pdf = \App::make('dompdf.wrapper');
        $fecha=Carbon::parse($acta->created_at);

        $aspirantes=$asignaciones->join('aspirantes','aspirante_id','=','aspirantes.NOV')
            ->selectRaw('aa.*,aspirantes.nombre,aspirantes.apellido')
            ->get();
        $pdf->loadView('admin.pdf.acta',compact('acta','aspirantes','aplicacion','fecha'));

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
        $this->enviarNotificacion($request,$acta);
        return $acta->estado;
    }

    private function enviarNotificacion($request,$acta){

        $decano = Admin::where('rol','decano')->first();
        $secretario = Admin::where('rol','secretario')->first();
        $jefeBienestar =Admin::where('rol','jefe_bienestar')->first();
        $mail= new Mail();
        $mailArray=[];
        $subject='';
        $msg='';
        if($request->has('estado')) {
            if ($request->estado == 'enviada') {
                $mailArray[$decano->email]=$decano->nombre();
                $mailArray[$secretario->email]=$secretario->nombre();
                $subject = 'Propuesta ' . $acta->getName();
                $msg = 'El jefe de bienestar estudiantil, ' . $jefeBienestar->nombre() . ' ha mandado una propuesta de acta para su revisión con
                el listado de aspirantes aprobados en una prueba especifica. Para aprobarla o reprobarla acceder a http://iepe.dev/admin/acta.';
            }
        }
        if($request->has('aprobacion_decanato')) {
            $mailArray[$jefeBienestar->email]=$jefeBienestar->nombre();
            $mailArray[$secretario->email]=$secretario->nombre();
            if($request->aprobacion_decanato==1) { //aprobo
                $subject='Propuesta '.$acta->getName().' aprobada';
                $msg='La propuesta '.$acta->getName().' ha sido revisada y aprobada por decanatura, para revisar el proceso acceder a http://iepe.dev/admin/acta.';
            }else{ //reprobo
                $subject='Propuesta '.$acta->getName().' reprobada';
                $msg='La propuesta '.$acta->getName().' ha sido reprobada por decanatura, para revisar el proceso acceder a http://iepe.dev/admin/acta.';
            }
        }
        if($request->has('aprobacion_secretaria')) {
            $mailArray[$decano->email]=$decano->nombre();
            $mailArray[$jefeBienestar->email]=$jefeBienestar->nombre();
            if($request->aprobacion_secretaria==1) { //aprobo
                $subject='Propuesta '.$acta->getName().' aprobada';
                $msg='La propuesta '.$acta->getName().' ha sido revisada y aprobada por secretaría general, para revisar el proceso acceder a http://iepe.dev/admin/acta.';
            }else{ //reprobo
                $subject='Propuesta '.$acta->getName().' reprobada';
                $msg='La propuesta '.$acta->getName().' ha sido reprobada por secretaría general, para revisar el proceso acceder a http://iepe.dev/admin/acta.';
            }
        }

        $mail->send($mailArray, $subject, $msg, null,null);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Actas::destroy($id);
        AspiranteAplicacion::where('acta_id',$id)->update(['acta_id'=>0]);
        return 'true';
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

    public function getConstanciasSatisfactorias($acta_id){
        set_time_limit(120);
        $asignaciones= AspiranteAplicacion::where('acta_id',$acta_id)->limit(2)->get();
        $aplicacion = Aplicacion::find(Actas::find($acta_id)->aplicacion_id);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('letter', 'portrait');//740,570
        $pdf->loadView('admin.pdf.constanciasSatisfactorias',compact('asignaciones','aplicacion'));
        return $pdf->stream();
    }
    
    public function notificar($id){
        $asignaciones=AspiranteAplicacion::where('acta_id',$id)->get();
        $emailArray=[];
        foreach ($asignaciones as $asig){
            $aspirante = $asig->getAspirante();
            $emailArray[$aspirante->email]=$aspirante->getNombreCompleto();
        }
        (new Mail())->send($emailArray,'Resultado Satisfactorio',
            'Le informamos que ha obtenido resultado satisfactorio en la prueba específica de la facultad de Arquitectura
             de la Universidad de San Carlos de Guatemala. Puede rectificar el resultado con su usuario en http://iepe.dev/aspirante/PruebaEspecifica/create
             Debe confirmar su jornada y carerra para la futura asignación como estudiante universitario en http://iepe.dev/aspirante/ResultadosSatisfactorios',
            null,null);
        //return Json::encode($emailArray);
        return 'nitido';//$asignaciones->toJson();
    }

    
}
