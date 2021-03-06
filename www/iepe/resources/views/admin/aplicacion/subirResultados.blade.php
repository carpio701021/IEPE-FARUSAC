@extends('layouts.admin-user')

@section('content')
    @include('layouts.mensajes')
    <div class="container">
        <h3>Subir Resultados - {{$aplicacion->nombre()}}</h3>
        <div class="col-sm-6">
            <form class="form-horizontal" role="form" action="{{ action('AspiranteAplicacionController@update',['subirResultados'=>$aplicacion->id]) }}" method="Post" accept-charset="UTF-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="panel panel-default">
                <div class="panel-heading">Cargar archivo con resultados</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="container">
                            <label class="btn btn-default btn-file" onclick="cancelarFile()">
                                Seleccionar archivo...
                                {!! Form::file('file' , array(
                                'style' =>'display:none',
                                'onchange'=> "cambiar_archivo()",
                                'id' => 'file'
                                )) !!}

                            </label>
                            <label class="control-label" id="labelfile">No se ha seleccionado ningun archivo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary">Cargar</button>
                            <a href="{{ action('AspiranteAplicacionController@descargarPlantillaResultados') }}" class="btn btn-default">Descargar plantilla</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="col-sm-6">
            <form class="form-horizontal" role="form" action="{{ action('AplicacionController@actualizarPercentiles',['aplicacion_id'=>$aplicacion->id]) }}" method="Post">
                {{csrf_field()}}
                <div class="panel panel-default">
                    <div class="panel-heading">Ajustar percentiles</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-xs-2">Carrera</label>
                            <div class="col-xs-10">
                                <select class="form-control" name="selectCarrera" id="selectCarrera">
                                    <option value="arquitectura">Arquitectura</option>
                                    <option value="disenio">Diseño Gráfico</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-2">RA</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="number" id="percentil_RA" name="percentil_RA" value='{{ $aplicacion->percentil_RA }}'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2">APE</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="number" id="percentil_APE" name="percentil_APE" value='{{$aplicacion->percentil_APE}}'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2">RV</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="number" id="percentil_RV" name="percentil_RV" value='{{$aplicacion->percentil_RV}}'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2">APN</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="number" id="percentil_APN" name="percentil_APN" value='{{$aplicacion->percentil_APN}}'/>
                            </div>
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-primary">Guardar y calificar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="container">
        <h3>Resumen de calificación</h3>
        <p>Esta calificación se realiza utilizando los percentiles definidos para cada area</p>
        <div class="col-sm-6">
            <h4>Arquitectura</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Area</th>
                    <th>Percentil Utilizado</th>
                    <th>Aprobados</th>
                    <th>Reprobados</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>RA</td>
                    <td>{{$aplicacion->percentil_RA}}</td>
                    <td>{{$resumen_areas['aRA']}}</td>
                    <td>{{$resumen_areas['rRA']}}</td>

                </tr>
                <tr>
                    <td>APE</td>
                    <td>{{$aplicacion->percentil_APE}}</td>
                    <td>{{$resumen_areas['aAPE']}}</td>
                    <td>{{$resumen_areas['rAPE']}}</td>
                </tr>
                <tr>
                    <td>RV</td>
                    <td>{{$aplicacion->percentil_RV}}</td>
                    <td>{{$resumen_areas['aRV']}}</td>
                    <td>{{$resumen_areas['rRV']}}</td>
                </tr>
                <tr>
                    <td>APN</td>
                    <td>{{$aplicacion->percentil_APN}}</td>
                    <td>{{$resumen_areas['aAPN']}}</td>
                    <td>{{$resumen_areas['rAPN']}}</td>
                </tr>
                </tbody>
            </table>    
            <div class="row">
                <label>Aprobados: {{ $resumen_areas['aprobados_arquitectura'] }}</label><br/>
                <label>Reprobados: {{ $resumen_areas['reprobados_arquitectura'] }}</label><br/>
                <label>Total: {{ $resumen_areas['reprobados_arquitectura'] + $resumen_areas['aprobados_arquitectura'] }}</label>
            </div>        
        </div>
        <div class="col-sm-6">
            <h4>Diseño Gráfico</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Area</th>
                    <th>Percentil Utilizado</th>
                    <th>Aprobados</th>
                    <th>Reprobados</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>RA</td>
                    <td>{{$aplicacion->percentil_RA_disenio}}</td>
                    <td>{{$resumen_areas['aRA_disenio']}}</td>
                    <td>{{$resumen_areas['rRA_disenio']}}</td>

                </tr>
                <tr>
                    <td>APE</td>
                    <td>{{$aplicacion->percentil_APE_disenio}}</td>
                    <td>{{$resumen_areas['aAPE_disenio']}}</td>
                    <td>{{$resumen_areas['rAPE_disenio']}}</td>
                </tr>
                <tr>
                    <td>RV</td>
                    <td>{{$aplicacion->percentil_RV_disenio}}</td>
                    <td>{{$resumen_areas['aRV_disenio']}}</td>
                    <td>{{$resumen_areas['rRV_disenio']}}</td>
                </tr>
                <tr>
                    <td>APN</td>
                    <td>{{$aplicacion->percentil_APN_disenio}}</td>
                    <td>{{$resumen_areas['aAPN_disenio']}}</td>
                    <td>{{$resumen_areas['rAPN_disenio']}}</td>
                </tr>
                </tbody>
            </table>            
            <div class="row">
                <label>Aprobados: {{ $resumen_areas['aprobados_disenio'] }}</label><br/>
                <label>Reprobados: {{ $resumen_areas['reprobados_disenio'] }}</label><br/>
                <label>Total: {{ $resumen_areas['reprobados_disenio'] + $resumen_areas['aprobados_disenio'] }}</label>
            </div>
        </div>
        <form role="form" style="padding-top:15%;padding-bottom:5%" method="get" action="{{ action('AplicacionController@show',['aplicacion'=>$aplicacion->id]) }}">
                {{csrf_field()}}
                <input type="hidden" name="orden" value="0">
                <button class="btn btn-primary" type="submit">Ver notas aspirantes aprobados</button>
            </form>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">

        function cancelarFile(){
            file.value=null;
        }
        function cambiar_archivo() {
            labelfile.innerHTML=file.value;
        }

        $("#selectCarrera").change(function(){
            
            if ($(this).val() == 'arquitectura'){
                $("#percentil_RA").val( {{ $aplicacion->percentil_RA }});
                $("#percentil_RV").val( {{ $aplicacion->percentil_RV }});
                $("#percentil_APN").val( {{ $aplicacion->percentil_APN }});
                $("#percentil_APE").val( {{ $aplicacion->percentil_APE }});
            }else{
                $("#percentil_RA").val( {{ $aplicacion->percentil_RA_disenio }});
                $("#percentil_RV").val( {{ $aplicacion->percentil_RV_disenio }});
                $("#percentil_APN").val( {{ $aplicacion->percentil_APN_disenio }});
                $("#percentil_APE").val( {{ $aplicacion->percentil_APE_disenio }});
            }
            
        }); 

    </script>

@stop


