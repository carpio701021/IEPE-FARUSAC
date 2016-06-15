@extends('layouts.admin-user')

@section('content')
    <div class="container">
        <h2>Resultados</h2>
        <div align="center">
            <div class="form-horizontal">
                <meta id="csrf_token" content=" {{ csrf_token() }} ">
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Año:</label>
                        <div class="col-sm-3">
                            <select id='select_anio' name="anio" class="form-control" onchange="onChange_anio(this.value)">
                                <option> Selecciona un año</option>
                                @foreach($anios as $anio)
                                    <option value="{{ $anio->year }}" @if(old('anio')==$anio->year) selected="true" @endif>{{ $anio->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Aplicación:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="select_aplicacion" name="aplicacion_id" selected="{{old('aplicacion_id')}}">>
                                @if(session()->has('aplicacion'))
                                    <option value="{{old('aplicacion_id')}}" selected="true">{{session('aplicacion')}}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="button" onclick="btn_buscar(select_anio.value,select_aplicacion.value)" class="btn btn-default">Buscar</button>
                            <form action="/admin/acta/1" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"> probador </button>
                            </form>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Propuestas de acta</h4></div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <select class="input-group-lg form-control" name='' id="select_propuestas" size="3" style="width: 100%">

                            </select>
                        </ul>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalConfirmRevision">Enviar a revisión</button>

                        <!-- Modal -->
                        <div id="modalConfirmRevision" class="modal fade" role="dialog">
                            <div class="modal-dialog ">
                                <!-- Modal content-->
                                <div class="modal-content panel-primary">
                                    <div class="modal-header panel-heading">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Enviar a revisión</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p style="font-size: 20px">Esta acción no se puede deshacer. ¿Desea enviarla a secretaria y decanatura para su aprobación?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn_cambio_estado_acta" id="btn_enviar_revision_confirm" data-dismiss="modal">Enviar</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button type="button" id='btn_eliminar_propuesta' class="btn btn-danger">Eliminar propuesta</button>
                        <a class="btn btn-default btn-verPDF" name='aprobada_pdf' target="_blank">Ver PDF</a>
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
                        <div class="row form-group">
                            <div class="col-sm-8">
                                <select class="input-group-lg form-control" name='' id="select_espera" size="3" style="width: 100%">
                                        <option class="list-group-item enviada_item" value="4">Opcion de prueba</option>
                                </select>
                            </div>
                            <div class="col-sm-4" id="enviada_info">

                            </div>
                        </div>
                        <div class="form-group">

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirmReprobar">Reprobar</button>
                            <!-- Modal -->
                            <div id="modalConfirmReprobar" class="modal fade" role="dialog">
                                <div class="modal-dialog ">
                                    <!-- Modal content-->
                                    <div class="modal-content panel-danger">
                                        <div class="modal-header panel-heading">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Reprobar propuesta de acta</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p style="font-size: 20px">¿Desea reprobar el acta seleccionada?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn_cambio_estado_acta" id="btn_reprobar_confirm" data-dismiss="modal">Reprobar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalConfirmAprobar">Aprobar</button>
                            <!-- Modal -->
                            <div id="modalConfirmAprobar" class="modal fade" role="dialog">
                                <div class="modal-dialog ">
                                    <!-- Modal content-->
                                    <div class="modal-content panel-success">
                                        <div class="modal-header panel-heading">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Aprobar propuesta de acta</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p style="font-size: 20px">Para que un acta se considere completamente aprobada debe
                                                ser aprobada por decanatura y secretaria general. ¿Desea aprobar el acta seleccionada?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success btn_cambio_estado_acta" id="btn_aprobar_confirm" data-dismiss="modal">Aprobar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="btn btn-default btn-verPDF" name='enviada_pdf' target="_blank">Ver PDF</a>
                        </div>
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
                        <select class="input-group-lg form-control" name='' id="select_reprobadas" size="3" style="width: 100%">
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-5">
                <div class="panel panel-success">
                    <div class="panel-heading"><h4>Actas aprobadas</h4></div>
                    <div class="panel-body">
                        <select class="input-group-lg form-control" name='' id="select_aprobadas" size="3" style="width: 100%">
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
                        option.value=aplicaciones[i].id;
                        select_aplicacion.add(option);
                    }
                }
            };
            xhttp.open('GET','/admin/acta/getAplicacionesAnio/'
                    +anio+'?_token='+csrf_token.getAttribute("content"),true);
            xhttp.send();
        }

    </script>

    <script type="text/javascript">
        function btn_buscar(anio, aplicacion_id){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var actas =JSON.parse(xhttp.responseText);
                    select_propuestas.innerHTML="";
                    select_espera.innerHTML="";
                    select_aprobadas.innerHTML="";
                    select_reprobadas.innerHTML="";
                    for(var i =0; i<actas.length ; i++){
                        var nombre = actas[i]['path_pdf'].replace(/^.*[\\\/]/, '');
                        var option = document.createElement('option');
                        option.value=actas[i]['id'];
                        option.text=nombre;
                        option.className='list-group-item';
                        if(actas[i]['estado']=='propuesta')
                            select_propuestas.add(option);
                        if(actas[i]['estado']=='enviada') {
                            option.className='list-group-item enviada_item';
                            select_espera.add(option);
                        }
                        if(actas[i]['estado']=='aprobada') {
                            select_aprobadas.add(option);
                        }
                        if(actas[i]['estado']=='reprobada') {
                            select_reprobadas.add(option);
                        }
                    }
                }
            };
            var parametros='&_token='+csrf_token.getAttribute("content");
            var url='/admin/acta/search/'+aplicacion_id;
            xhttp.open('GET',url+'?'+parametros,true);
            xhttp.send();
        }

        $(document).ready(function() {

            $(".btn-verPDF").click(function() {//agregar acta id para mostrar pdf
                var href = '/admin/acta/';
                if(this.name=='aprobada_pdf')
                    href += select_propuestas.value;
                else
                    if(this.name=='enviada_pdf')
                            href += select_espera.value;
                this.href=href;
            });

            $('#btn_eliminar_propuesta').click(function(){
                $.post("/admin/acta/"+select_propuestas.value,
                        {_method: "DELETE",
                         _token:"{{csrf_token()}}"},
                        function(data){
                            alert(data);
                        });
            });

            $(".btn_cambio_estado_acta").click(function(){
                var data={
                    _method: "PUT",
                    _token:"{{csrf_token()}}"
                };
                var id ='';
                if(this.id=='btn_enviar_revision_confirm') {
                    data.estado = 'enviada';
                    id=select_propuestas.value;
                }
                else
                    id=select_espera.value;
                    if(this.id=='btn_reprobar_confirm'){
                        alert("{{Auth::guard('admin')->user()->getRolName()}}");
                        if("{{Auth::guard('admin')->user()->getRolName()}}"=='decano') data.aprobacion_decanato='-1';
                        if("{{Auth::guard('admin')->user()->getRolName()}}"=='secretario') data.aprobacion_secretaria='-1';
                    }
                    else
                        if(this.id=='btn_aprobar_confirm') {
                            if("{{Auth::guard('admin')->user()->getRolName()}}"=='decano') data.aprobacion_decanato='1';
                            if("{{Auth::guard('admin')->user()->getRolName()}}"=='secretario') data.aprobacion_secretaria='1';
                        }

                $.post("/admin/acta/"+id,
                        data,
                        function(data){
                            if(data=='enviada')
                                $('.input-group-lg option[value="'+id+'"]').remove().appendTo('#select_espera');
                            else
                                if(data=='reprobada')
                                    $('.input-group-lg option[value="'+id+'"]').remove().appendTo('#select_reprobadas');
                                else
                                    if(data=='aprobada')
                                        $('.input-group-lg option[value="'+id+'"]').remove().appendTo('#select_aprobadas');
                        }
                );
            });

        });
        $("#select_espera").on('click','option.enviada_item',function () {
            $.get('/admin/acta/info/'+select_espera.value,
                    function(data){
                        var acta = jQuery.parseJSON(data);
                        var decanato = (acta['aprobacion_decanato']+"").replace('1','aprobado').replace('0','pendiente');
                        var secretaria = (acta['aprobacion_secretaria']+"").replace('1','aprobado').replace('0','pendiente');
                        enviada_info.innerHTML='<h4>Estado de aprobación</h4>' +
                                '<p>Decanatura: '+decanato +'<br>'+
                                'Secretaría: '+secretaria+ '</p>';
                    }
            );
        });
    </script>

@stop
