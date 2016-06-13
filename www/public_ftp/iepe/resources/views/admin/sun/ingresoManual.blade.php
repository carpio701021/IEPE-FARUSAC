@extends('layouts.admin-user')

@section('content')
    <div class="container">
        @include('layouts.mensajes')
        <h3>Ingresar manualmente resultados básicos</h3>
        <meta id="csrf_token" content="{{ csrf_token() }}">
        <div class="panel panel-default">
            <div class="panel-heading">Buscar por número de carné u orientación vocacional</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" >Número:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="carne" id="carne" min="100000000" max="9999999999" value="{{old('carne')}}">
                    </div>
                    <div class="col-sm-2">
                    <button type="button" onclick="search(carne.value)" class="btn btn-default">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-horizontal" role="form" action="/admin/datos/insert" method="Post" >
            {{csrf_field()}}
            <div class="panel panel-default">
                <div class="panel-heading">Resultados de búsqueda</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <select class="input-group-lg" name='dato_sun' id="resultados" size="5" style="width: 100%" onchange="able_relacionar()">

                        </select>
                    </ul>
                </div>
                <div class="panel-footer">
                    <button type="button"  id='btn_relacionar' disabled="true" class="btn btn-primary btn-md" data-toggle="modal" data-target="#ModalRelacionar">
                        Relacionar con número de orientación vocacional</button>

                    <!-- Modal -->
                    <div id="ModalRelacionar" class="modal fade" role="dialog" align="left">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 style="color:#EBC14D">Relacionar con numero de carne</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" >No. Orientación:</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="orientacion" min="1000000000" max="9999999999">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('scripts')
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/js/multistep.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.input-group.date.fecha').datetimepicker({
                locale: 'es',
                format: 'L',
                format: 'YYYY-MM-DD'
            });

            $('.input-group.date.year').datetimepicker({
                locale: 'es',
                format: "YYYY" // Notice the Extra space at the beginning
                //endDate: " " + new Date().getFullYear()
            });

        });
    </script>

    <script type="text/javascript">
        function search(carne) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var myArr = JSON.parse(xmlhttp.responseText);
                        var cad;
                        for(var a = 0; a < myArr.length ; a++){
                            cad= cad+"<option class='list-group-item' value='"+myArr[a].id+"'>"
                                    +myArr[a].orientacion
                                    +" materia: "+myArr[a].id_materia
                                    +" "+(myArr[a].aprobacion+"").replace('1','aprobado').replace('0','reprobado')
                                    +" evaluado el "+myArr[a].fecha_evaluacion
                                    +"</option>";
                        }
                        document.getElementById("resultados").innerHTML = cad;
                        //alert(xmlhttp.responseText);
                    }
                };
                xmlhttp.open("GET",
                        "/admin/datos/insert/search?carne="+carne+"&_token"
                        + document.getElementById('csrf_token').getAttribute("content"), true);
                xmlhttp.send();
        }

        function able_relacionar(){
            document.getElementById('btn_relacionar').disabled=false;
        }
    </script>
@stop