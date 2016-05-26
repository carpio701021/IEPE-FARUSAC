@extends('layouts.admin-user')

@section('content')

    <div class="container">
        <h2>Nueva Aplicación</h2>

        @include('layouts.mensajes')

        {!! Form::model($aplicacion, array('route' => array('admin.aplicacion.update', $aplicacion->id), 'files' => true , 'class' => 'form-horizontal', 'role' => 'form') ) !!}
        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
            {!! Form::label('nombre', 'Nombre*', array('class' => 'col-md-4 control-label')) !!}
            <div class="col-md-6">
                {!! Form::text('nombre' , null , array(
                'class' => 'form-control',
                'placeholder' => 'Ejemplo: Primera aplicación 2016',
                'required' => 'true',
                'title' => 'Nombre',
                'data-placement' => 'left',
                'data-toggle' => 'popover',
                'data-trigger' => 'focus',
                'data-content' => 'Nombre de la aplicación que le aparecerá al aspirante',
                )) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <br><br>

        <form id="form_create" class="form-horizontal" role="form" method="POST"
              action="{{ url('/admin/aplicacion') }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-6">
                    <input
                            type="text" class="form-control"
                            name="nombre" id="nombre" value="{{ old('nombre') }}"
                            placeholder="Ejemplo: Primera aplicación 2016" required
                            title="Nombre"
                            data-placement="left"
                            data-toggle="popover"
                            data-trigger="focus"
                            data-content="Nombre de la aplicación que le aparecerá al aspirante"
                    >
                </div>
            </div>
            <div class="form-group{{ $errors->has('arte') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Arte</label>
                <div class="col-md-6">
                    <input type="file" name="arte" accept="image/*" value="{{ old('arte') }}" required>
                </div>

                <div class="col-md-2">

                    <button type="button" class="btn btn-primary"
                       title="Arte"
                       data-toggle="popover"
                       data-trigger="focus"
                       data-content="Imagen única que se imprime en la constancia de asignación del aspirante.">?</button>
                </div>
            </div>


            <div class="form-group{{ $errors->has('fecha_inicio_asignaiones') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Fecha de inicio de asignaciones</label>
                <div class="col-md-6">
                    <div class='input-group date fecha' id='datetimepicker_fecha_inicio_asignaiones'
                         title="Fecha de inicio de asignaciones"
                         data-toggle="popover"
                         data-placement="left"
                         data-trigger="focus"
                         data-content="Día en el que al usuario aspirante le aparecerá ésta aplicación para asignarse.">
                        <input type='text' class="form-control" id="fecha_inicio_asignaiones" required
                               name="fecha_inicio_asignaiones" value="{{ old('fecha_inicio_asignaiones') }}"
                               placeholder="día/mes/año"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('fecha_fin_asignaciones') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Fecha de cierre de asignaciones</label>
                <div class="col-md-6">
                    <div class='input-group date fecha' id='datetimepicker_fecha_fin_asignaciones'
                         title="Fecha de cierre de asignaciones"
                         data-toggle="popover"
                         data-placement="left"
                         data-trigger="focus"
                         data-content="Día en el que se deshabilitará la opción de asignarce a ésta aplicación.">
                        <input type='text' class="form-control" id="fecha_fin_asignaciones" required
                               name="fecha_fin_asignaciones" value="{{ old('fecha_fin_asignaciones') }}"
                               placeholder="día/mes/año"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>


            <div class="form-group{{ $errors->has('fecha_aplicacion') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Fecha de la aplicación</label>
                <div class="col-md-6">
                    <div class='input-group date fecha' id='datetimepicker_fecha_aplicacion'
                         title="Fecha de la aplicación"
                         data-toggle="popover"
                         data-placement="left"
                         data-trigger="focus"
                         data-content="Día en el que los aspirantes deben presentarse a la evaluación en el horario y salón establecido.">
                        <input type='text' class="form-control" id="fecha_aplicacion" name="fecha_aplicacion" required
                               value="{{ old('fecha_aplicacion') }}" placeholder="día/mes/año"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('fecha_publicacion_resultados') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Fecha de publicación de resultados</label>
                <div class="col-md-6">
                    <div class='input-group date fecha' id='datetimepicker_fecha_publicacion_resultados'
                         title="Fecha de publicación de resultados"
                         data-toggle="popover"
                         data-placement="left"
                         data-trigger="focus"
                         data-content="Día en el que los aspirantes podrán ver sus resultados. Las notas ya deben estar ingresadas.">
                        <input type='text' class="form-control" id="fecha_publicacion_resultados" required
                               name="fecha_publicacion_resultados" value="{{ old('fecha_publicacion_resultados') }}"
                               placeholder="día/mes/año"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                </div>

            </div>

            <div class="form-group{{ $errors->has('horarios') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Horarios</label>
                <div class="list-group col-md-6" id="divHorarios">


                    <a href="" id="btnAH" data-toggle="modal" data-target="#modal_horarios"
                       class="list-group-item {{ $errors->has('horarios') ? '  list-group-item-danger' : ' active' }}">
                        <span class="glyphicon glyphicon-plus"></span> Agregar horario
                    </a>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="horarios_popover"
                       title="Horarios"
                       data-toggle="popover"
                       data-trigger="focus"
                       data-content="Presione el boton para agregar horarios. En estos horarios se citarán a los aspirantes, los cuales serán repartidos en horarios y salones al momento de la asignación.">?</button>
                </div>

                <!-- Modal agregar horario -->
                <div class="modal fade" id="modal_horarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Nuevo horario</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <p align="center">*Usar sistema horario de 24hrs*</p>
                                        <label class="col-md-4 control-label">Hora de inicio</label>
                                        <div class="col-md-6">
                                            <div class='input-group date hora' id='datetimepicker_hora_inicio'>
                                                <input type='text' class="form-control" id="hora_inicio"
                                                       placeholder="23:59"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <label class="col-md-4 control-label">Hora de finalización</label>
                                        <div class="col-md-6">
                                            <div class='input-group date hora' id='datetimepicker_hora_fin'>
                                                <input type='text' class="form-control" id="hora_fin"
                                                       placeholder="23:59"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="btnAddHorario">Agregar horario
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group{{ $errors->has('salones') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Salones</label>
                <div class="list-group col-md-6">

                    <a href="" id="btnAS" data-toggle="modal" data-target="#modal_salon"
                       class="list-group-item {{ $errors->has('salones') ? '  list-group-item-danger' : ' active' }}">
                        <span class="glyphicon glyphicon-plus"></span> Agregar salón
                    </a>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="salones_popover"
                       title="Salones"
                       data-toggle="popover"
                       data-trigger="focus"
                       data-content="Presione el boton para agregar salones. Los aspirantes serán repartidos en los diferentes horarios y salones disponibles de forma automatica.">?</button>
                </div>

                <!-- Modal agregar salon -->
                <div class="modal fade" id="modal_salon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Nuevo horario</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Descripción del salón</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="txtSalon" placeholder="Salón L-II 3, Edificio T1">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="btnAddSalon">Agregar salón</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="form-group{{ $errors->has('cupo') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Cupo por salón</label>
                <div class="col-md-6">
                    <input type='number' class="form-control" id="cupo" required
                           name="cupo" value="{{ old('cupo') }}"
                           placeholder="40"
                           title="Cupo por salon"
                           data-toggle="popover"
                           data-placement="left"
                           data-trigger="focus"
                           data-content="Conforme los aspirantes se vallan asignando, el sistema irá llenando salones automáticamente."/>

                </div>

            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </form>


    </div>

@endsection

@section('scripts')

    <script type="text/javascript">


        $(function () {
            $('[data-toggle="popover"]').popover()

            $('.input-group.date.hora').datetimepicker({
                locale: 'es',
                format: 'LT'
            });

            $('.input-group.date.fecha').datetimepicker({
                locale: 'es',
                format: 'YYYY/MM/DD'
            });



        });

        $("form").bind("keypress", function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        });

        $( "#form_create" ).submit(function( event ) {

            //alert( "horarios -> " + $( ".horario-item").length );
            if($( ".horario-item").length > 0 && $( ".salon-item").length > 0){
                return;
            }else{
                if( $( ".horario-item").length <=0 ){
                    alert( "Aún no ha ingresado horarios para la aplicación" );
                    $("#horarios_popover").focus();
                }else if( $( ".salon-item").length <=0 ){
                    alert( "Aún no ha ingresado salones para la aplicación" );
                    $("#salones_popover").focus();
                }
                event.preventDefault();
            }
            //$( "#form_create" ).submit();
        });

        contHorarios = 0;

        $("#btnAddHorario").click(function () {
            hi = $('#hora_inicio').val();
            hf = $('#hora_fin').val();
            if(hi=="" || hf==""){
                $('#modal_horarios').modal('hide');
                return;
            }

            a =
                    '<button type="button" onclick="quitarHorario(this);" ' +
                    'class="list-group-item horario-item" ' +
                    '><span class="glyphicon glyphicon-minus"></span> ' +
                    'De ' + hi + ' a ' + hf + ' hrs' +
                    '<input type="text" style="display:none"' +
                    'name="horarios[]" ' +
                    'value="' + hi + '-' + hf + '">' +
                    '</button>';
            $("#btnAH").before(a);

            $('#modal_horarios').modal('hide');
        });

        function quitarHorario(boton) {
            $(boton).remove();
        }


        $("#btnAddSalon").click(function () {
            salon = $('#txtSalon').val();
            if(salon=="") {
                $('#modal_salon').modal('hide');
                return;
            }

            a =
                    '<button type="button" onclick="quitarSalon(this);" ' +
                    'class="list-group-item salon-item" ' +
                    '><span class="glyphicon glyphicon-minus"></span> ' + salon +
                    '<input type="text" style="display:none"' +
                    'name="salones[]" ' +
                    'value="' + salon + '">' +
                    '</button>';
            $("#btnAS").before(a);

            $('#modal_salon').modal('hide');
        });

        function quitarSalon(boton) {
            $(boton).remove();
        }


        /**
         * $("#nombre").tooltip({
            placement: "right",
            trigger: "focus",
            title: "Nombre de la aplicacion. Ejemplo: Segunda aplicacion 2016"
        });
         $("#arte").tooltip({
            placement: "right",
            trigger: "focus",
            title: "Esta imagen es única por aplicación, lleva parámetros que impiden su falsificación, dentro de los cuales esta generar uno por fecha de aplicación "
        });
         **/
    </script>
@endsection