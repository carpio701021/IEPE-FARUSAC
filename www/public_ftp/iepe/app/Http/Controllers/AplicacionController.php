<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AplicacionRequest;
use App\Http\Requests\PercentilRequest;
use App\Aplicacion;
use Carbon\Carbon ;
use File;
use Illuminate\Support\Facades\DB;
use App\AspiranteAplicacion;
use Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Style_Alignment;

class AplicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aplicaciones = Aplicacion::orderBy('fecha_aplicacion', 'desc')->paginate(3);
        //return view('admin.aplicacion.index',['aplicacion'=> $aplicacion]);
        return view('admin.aplicacion.index',compact('aplicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$aplicacion = Aplicacion::first();
        $aplicacion = new Aplicacion();
        return view('admin.aplicacion.create',compact('aplicacion'));
    }

    public function getCrearEspecial($id)
    {
        $aplicacion = new Aplicacion();
        $titulo = 'Crear aplicación especial';
        $especial =$id;
        return view('admin.aplicacion.create',compact('aplicacion','titulo','put','especial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AplicacionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AplicacionRequest $request)
    {

        //$this->asignarIrregulares($request->_especial,Aplicacion::find(5));
        if(Aplicacion::where('year',$request->year)->where('naplicacion',$request->naplicacion)->first()){
            $errors = Array('La combinacion de año y número de aplicación ya existe');
            return redirect('/admin/aplicacion/create')->withErrors($errors)->withInput();
        }

        //Guarda una nueva aplicación
        $aplicacion = new Aplicacion( $request->all() );
        $aplicacion->percentil_RA	= 80;
        $aplicacion->percentil_APE	= 80;
        $aplicacion->percentil_RV	= 80;
        $aplicacion->percentil_APN	= 80;

        /*
        if($request->hasFile('arte')){
            $destinationPath ='/arte_aplicaciones'; // upload path
            $extension = $request->file('arte')->getClientOriginalExtension(); // getting file extension
            $fileName = 'arte'. '['.Carbon::now().']'. rand(10000,99999).'.'.$extension; // rename file
            $request->file('arte')->move( storage_path().$destinationPath,$fileName);
            $aplicacion->path_arte = $destinationPath . '/' . $fileName;
        }
        */

        $aplicacion->save();
        $aplicacion->agregarSalonesHorarios($request->salones,$request->horarios);
        if($request->_especial){
            if($this->asignarIrregulares($request->_especial,$aplicacion)){//se asignan automaticamente
                $request->session()->flash('mensaje_exito','Aplicación <i>'.$aplicacion->nombre().'</i> creada exitosamente. Se asignaron los estudiantes irregulares');
            }else{
                $request->session()->flash('mensaje_exito','ocurrió un error');
            }
        }else{
            $request->session()->flash('mensaje_exito','Aplicación <i>'.$aplicacion->nombre().'</i> creada exitosamente.');
        }
        return redirect('/admin/aplicacion');
    }

    function asignarIrregulares($id,$aplicacionEspecial){
        $aplicacion=Aplicacion::find($id);
        $irregulares = $aplicacion->getAsignaciones()
        ->where('resultado','irregular')
        ->select('aspirante_id')->get();
        //dd($aplicacionEspecial->getSalonesHorarios());
        foreach($irregulares as $irregular){
            $asignacion = new AspiranteAplicacion();
            if($asignacion->asignar($irregular->aspirante_id,$aplicacionEspecial->id)){//true si hay cupo, false ya no hay cupo
                $asignacion->save();
                //$pdf=$this->generarConstanciaPDF($asignacion->id);
                //$mail = new Mail();
                //$request->session()->flash('mensaje_exito', 'Asignación realizada correctamente, puedes revisar tu salón y horario para la prueba');
                /*if($mail->send(Auth::user()->email,
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
                }*/
            }else{
                return false;// back()->withErrors(['cupo'=>'No puede asignarse a esta aplicación porque el cupo está lleno. Abocarse a las oficinas de la facultad de arquitectura para solucionarlo']);
            }
        }
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
        $orden='desc';
        $ob=$_GET['orden'];
        //dd($orderby);
        if($ob==0) {
            $orderby = 'id';
            $orden='asc';
        }
        elseif ($ob==1) {
            $orderby = 'aspirante_id';
            $orden = 'asc';
        }
        elseif ($ob==2)
            $orderby='nota_RA';
        elseif ($ob==3)
            $orderby='nota_APE';
        elseif ($ob==4)
            $orderby='nota_RV';
        elseif ($ob==5)
            $orderby='nota_APN';

        $aplicacion=Aplicacion::find($id);
        $asignaciones=$aplicacion->getAsignaciones()
            ->where('acta_id',0)
            ->whereIn('resultado',['aprobado','irregular'])
            ->orderby($orderby,$orden)
            ->paginate(15);
        //dd($asignaciones);///esta onda me está trayendo todo de todo
        return view('admin.aplicacion.NotasAspirantes',
            compact('asignaciones','aplicacion','ob'));
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
        $aplicacion = Aplicacion::findOrFail($id);
        //dd($aplicacion->fecha_inicio_asignaciones < date("Y-m-d"));
        if($aplicacion->fecha_inicio_asignaciones<date("Y-m-d") && date("Y-m-d h:i")<$aplicacion->fecha_fin_asignaciones){
            $errors = Array('No se puede editar la <i>'.$aplicacion->nombre().'</i> ya que está en tiempo de asignaciones');
            return redirect('/admin/aplicacion')->withErrors($errors)->withInput();
        }
        $titulo = 'Editar aplicación';
        $put = true;
        return view('admin.aplicacion.create',compact('aplicacion','titulo','put'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AplicacionRequest $request, $id)
    {

        if(Aplicacion::where('id','!=',$id)->where('year',$request->year)->where('naplicacion',$request->naplicacion)->first()){
            $errors = Array('La combinacion de año y número de aplicación ya existe');
            return redirect('/admin/aplicacion/'.$id.'/edit')->withErrors($errors)->withInput();
        }

        $aplicacion = Aplicacion::where('id',$id)->first();
        $aplicacion->update( $request->all() );
        if($request->hasFile('arte')){
            $destinationPath ='/arte_aplicaciones'; // upload path
            $extension = $request->file('arte')->getClientOriginalExtension(); // getting file extension
            $fileName = 'arte'. '['.Carbon::now().']'. rand(10000,99999).'.'.$extension; // rename file
            $request->file('arte')->move( storage_path().$destinationPath,$fileName);
            $aplicacion->path_arte = $destinationPath . '/' . $fileName;
        }

        $aplicacion->save();
        $aplicacion->agregarSalonesHorarios($request->salones,$request->horarios);

        $request->session()->flash('mensaje_exito','Cambios en aplicación <i>'.$aplicacion->nombre().'</i> guardados.');
        return redirect('/admin/aplicacion');
    }

    public function getArte($aplicacion_id){
        $aplicacion = Aplicacion::where('id',$aplicacion_id)->firstOrFail();
        //dd($aplicacion);
        if(isset($aplicacion->path_arte)){
            $file = File::get(storage_path().$aplicacion->path_arte);
        }else{
            abort(403, 'Imagen no encontrada.');
            dd("nanai");
        }

        $response = \Response::make($file, 200);
        // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
        $response->header('Content-Type', 'image/*');
        return $response;
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

    public function actualizarPercentiles(PercentilRequest $request,$id){
        $aplicacion = Aplicacion::find($id);
        $aplicacion->percentil_RA=$request->percentil_RA;
        $aplicacion->percentil_APE=$request->percentil_APE;
        $aplicacion->percentil_RV=$request->percentil_RV;
        $aplicacion->percentil_APN=$request->percentil_APN;
        $aplicacion->save();
        $aplicacion->calificar();//actualizará la tabla aspirantes_aplicaciones
        //dd($aplicacion->getResumen_Areas());
        return back();//->with("resumen_areas",$aplicacion->getResumen_Areas());
    }
    
    public function getActas($id){
        $aplicacion=Aplicacion::find($id);
        $actas = $aplicacion->getActas();
        return view('admin.aplicacion.Actas',compact('actas','aplicacion'));
    }
    
    public function getAplicacionesAnio($anio){
        return Aplicacion::where('year',$anio)->get()->toJson();
    }

    public function getConstanciasSatisfactorias($id){
        set_time_limit(120);
        $asignaciones=Db::table('aspirantes_aplicaciones as aa')
            ->join('aplicaciones_salones_horarios as ash','ash.id','=','aa.aplicacion_salon_horario_id')
            ->where('ash.aplicacion_id','=',$id)
            ->where('acta_id','>',0)
            //->where('aspirante_id',1000000311)
            ->join('aspirantes','aspirante_id','=','aspirantes.NOV')
            ->get();
        /*$asignaciones=Aplicacion::find($id)
            ->getAsignaciones()
            ->where('acta_id','>',4)
            //->where('aspirante_id',1000000311)
            ->join('aspirantes','aspirante_id','=','aspirantes.NOV')
            ->get();*/
        //dd($asignaciones);
        $aplicacion = Aplicacion::find($id);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper(array(0,0,740,570), 'portrait');//740,570
        $pdf->loadView('admin.pdf.constanciasSatisfactorias',compact('asignaciones','aplicacion'));
        return $pdf->stream();

    }


    public function getListados($id){
        //Excel::load(storage_path().'/Formatos/formato_listado_salon_horario.xlsx', function($file) use ($id){

            Excel::create('Listados_'.Aplicacion::find($id)->nombre(),function($excel) use ($id){
                $aplicacion=Aplicacion::find($id);
                $salones_horarios = $aplicacion->getSalonesHorarios();
                foreach ($salones_horarios as $sh){

                    //obtener data
                    $excel->sheet($sh->printNombre(), function($sheet) use ($sh,$aplicacion) {
                        $asignaciones=$sh->hasMany('App\AspiranteAplicacion','aplicacion_salon_horario_id')
                            ->join('aspirantes','aspirante_id','=','aspirantes.NOV')
                            ->selectRaw('NOV,nombre,apellido')
                            ->get();

                        //agregar data a la hoja
                        $sheet->fromModel($asignaciones,null,'B9',false);

                        //agregar imagen usac
                        $objDrawing = new PHPExcel_Worksheet_Drawing();
                        $objDrawing->setName('logo_usac');
                        $objDrawing->setDescription('Logo');
                        $logo = 'img/logo_usac.png'; // Provide path to your logo file
                        $objDrawing->setPath($logo);
                        $objDrawing->setCoordinates('B3');
                        $objDrawing->setHeight(60); // logo height
                        $objDrawing->setWorksheet($sheet);

                        //agregar imagen farusac
                        $objDrawing = new PHPExcel_Worksheet_Drawing();
                        $objDrawing->setName('logo_farusac');
                        $objDrawing->setDescription('Logo');
                        $logo = 'img/logotipoFARUSAC_Amarillo.png'; // Provide path to your logo file
                        $objDrawing->setPath($logo);
                        $objDrawing->setCoordinates('E3');
                        $objDrawing->setHeight(65); // logo height
                        $objDrawing->setWorksheet($sheet);

                        //encabezado de la pagina donde se indica la info de la aplicacion salon hora
                        $c_ini='C';
                        $c_fin='D';
                        $sheet->mergeCells($c_ini.'1:'.$c_fin.'1');$sheet->mergeCells($c_ini.'2:'.$c_fin.'2');
                        $sheet->mergeCells($c_ini.'3:'.$c_fin.'3');$sheet->mergeCells($c_ini.'4:'.$c_fin.'4');
                        $sheet->mergeCells($c_ini.'5:'.$c_fin.'5');$sheet->mergeCells($c_ini.'6:'.$c_fin.'6');
                        $sheet->mergeCells($c_ini.'7:'.$c_fin.'7');$sheet->mergeCells($c_ini.'8:'.$c_fin.'8');
                        $sheet->setCellValue($c_ini.'1','UNIVERSIDAD SAN CARLOS DE GUATEMALA');
                        $sheet->setCellValue($c_ini.'2','Facultad de Arquitectura');
                        $sheet->setCellValue($c_ini.'3','Unidad de Orientación Estudiantil');
                        $sheet->setCellValue($c_ini.'5', $aplicacion->nombre());
                        $sheet->setCellValue($c_ini.'6',$aplicacion->fecha_aplicacion);
                        $sheet->setCellValue($c_ini.'7',$sh->getSalon()->printNombre());
                        $sheet->setCellValue($c_ini.'8',$sh->getHorario()->printHorario());

                        $sheet->setFreeze('A10');
                        for ($i = 1;$i<=count($asignaciones);$i++){
                            $sheet->setCellValue('A'.(9+$i),$i);
                        }

                    //formato de celdas
                        //titulo de cada columna pintado de gris
                        $sheet->row(9,array('No.','No. Orientación','Apellido','Nombre','Firma'));
                        $sheet->cells('A9:E9', function($cells) { //manipular celdas de encabezado data
                            $cells->setBackground('#BDBDBD');
                        });

                        //encabezado de la hoja
                        $sheet->cells('A1:F8', function($cells) { //manipular celdas
                            $cells->setBackground('#FFFFFF');
                            $cells->setAlignment('center');
                        });

                        //ancho de columnas
                        $sheet->setWidth('A', 4);
                        $sheet->setWidth('B', 15);
                        $sheet->setWidth('C', 25);
                        $sheet->setWidth('D', 25);
                        $sheet->setWidth('E', 15);

                    //formato de columnas
                        $sheet->getStyle('B1:B256')
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                    });
                }
            })->download('xlsx');

        //});
    }
    
    
    

}
