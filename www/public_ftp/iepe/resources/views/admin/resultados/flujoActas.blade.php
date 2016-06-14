@extends('layouts.admin-user')

@section('content')
    <div class="container">
        <h2>Resultados</h2>
        <div align="center">
            <form role="form" class="form-horizontal" action="" method="get">
                <meta id="csrf_token" content="{{ csrf_token() }}">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Año:</label>
                        <div class="col-sm-3">
                            <select id='select_anio' class="form-control" onchange="onChange_anio(this.value)">
                                @foreach($anios as $anio)
                                    <option value="{{ $anio->year }}">{{ $anio->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Aplicación:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="select_aplicacion">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Propuestas de acta</h4></div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <select class="input-group-lg form-control" name='' id="" size="3" style="width: 100%">
                                    <option class="list-group-item">op1</option>
                            </select>
                        </ul>
                        <button type="button" class="btn btn-primary">Enviar a revisión</button>
                        <button type="button" class="btn btn-danger">Eliminar propuesta</button>
                    </div>
                </div>
            </div>
        </div>
        <div align="center">
            <span class="glyphicon glyphicon-arrow-down" style='font-size: 50px; color:steelblue' aria-hidden="true"></span>
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-info">
                    <div class="panel-heading"><h4>En espera de aprobación</h4> </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <select class="input-group-lg form-control" name='' id="" size="3" style="width: 100%">
                                    <option class="list-group-item">op1</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                area
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger">Reprobar</button>
                        <button type="button" class="btn btn-success">Aprobar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-2">
                <span class="glyphicon glyphicon-arrow-down" style='font-size: 50px; color:darkred' aria-hidden="true"></span>
            </div>
            <div class="col-sm-offset-5 col-sm-2">
                <span class="glyphicon glyphicon-arrow-down" style='font-size: 50px; color:forestgreen' aria-hidden="true"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="panel panel-danger">
                    <div class="panel-heading"><h4>Propuestas reprobadas</h4></div>
                    <div class="panel-body">
                        <select class="input-group-lg form-control" name='' id="" size="3" style="width: 100%">
                            <option class="list-group-item">op1</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-5">
                <div class="panel panel-success">
                    <div class="panel-heading"><h4>Actas aprobadas</h4></div>
                    <div class="panel-body">
                        <select class="input-group-lg form-control" name='' id="" size="3" style="width: 100%">
                            <option class="list-group-item">op1</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        function onChange_anio(anio){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var aplicaciones =JSON.parse(xhttp.responseText);
                    select_aplicacion.innerHTML="";
                    for(var i =0;i < aplicaciones.length;i++){
                        var option = document.createElement('option');
                        option.text=aplicaciones[i].naplicacion;
                        select_aplicacion.add(option);
                    }

                }
            };

            xhttp.open('GET','/admin/acta/getAplicacionesAnio/'
                    +anio+'?_token='+csrf_token.getAttribute("content"),true);
            xhttp.send();
        }
    </script>
@stop
