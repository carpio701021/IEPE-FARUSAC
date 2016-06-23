@extends('layouts.admin-user')

@section('content')
    <div class="container">
        @include('layouts.mensajes')
        <h3>Administrar Aspirantes</h3>
        <meta id="csrf_token" content="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de aspirantes con usuario</div>
                <div class="panel-body">
                    <div class="form-horizontal" >
                        <div class="form-group">
                            <label class="control-label col-sm-3" >Buscar coincidencias en NOV:</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" name='NOV' id="NOV" min="100000000" max="9999999999" value="{{old('NOV')}}">
                            </div>
                            <div class="col-sm-2">
                                <a id='btn_buscar' class="btn btn-default">Buscar</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php $count = 0 ?>
                        @foreach($aspirantes as $aspirante)
                                @if($count%2==0)
                                <li id="li{{ $aspirante->registro_personal }}" class="list-group-item">
                                    <div class="row">
                                @endif
                                        <div class="col-md-3">
                                            <b>No. Orientación:</b> {{ $aspirante->NOV }} <br>
                                            {{ $aspirante->getNombreCompleto() }}<br>
                                            {{ $aspirante->email }} <br>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#modalCorreo{{$aspirante->NOV}}" data-toggle="modal"><span class="glyphicon glyphicon-pencil"></span> Cambiar correo</a><br>
                                            <div class="modal fade" role="dialog" id="modalCorreo{{$aspirante->NOV}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content panel-primary">
                                                        <div class="modal-header panel-heading">
                                                            <h4>{{$aspirante->NOV.' - '.$aspirante->getNombreCompleto()}}</h4>
                                                        </div>
                                                        <div class="modal-body" style="padding-top: 35px">
                                                            <form class="form-horizontal" role="form" action="/admin/aspirantes/{{$aspirante->NOV}}"  method="post">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="_method" value="PUT" >
                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-3" for="email">Nuevo correo:</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="email" class="form-control" id="email" name="email">
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                            <button class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <form action="/admin/aspirantes" method="POST">
                                                {{csrf_field()}}
                                                <a href="#modalBlack{{$aspirante->NOV}}" data-toggle="modal"><span class="glyphicon glyphicon-ban-circle"></span> Agregar a lista negra</a><br>
                                                <div class="modal fade" role="dialog" id="modalBlack{{$aspirante->NOV}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content panel-danger">
                                                            <div class="modal-header panel-heading">
                                                                <h4>Agregar a lista negra</h4>
                                                            </div>
                                                            <div class="modal-body" style="padding-top: 35px">
                                                                <p>¿Desea agregar {{$aspirante->NOV}} a la lista negra? Esto evitara que pueda ingresar a la plataforma y asignarse pruebas específicas</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="NOV" value="{{$aspirante->NOV}}">
                                                                <button type="submit" class="btn btn-danger">Agregar a lista negra</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                @if($count%2!=0)
                                    </div>
                                </li>
                                @endif
                                    <?php $count++?>
                        @endforeach
                    </div>
                    {{$aspirantes->links()}}
                </div>
            </div>
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

        $('#btn_buscar').click(function(){
            this.href='/admin/aspirantes/'+NOV.value;
        })
    </script>
@stop