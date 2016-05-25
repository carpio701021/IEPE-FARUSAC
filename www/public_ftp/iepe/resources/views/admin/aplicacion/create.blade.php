@extends('layouts.admin-user')

@section('content')

    <div class="container">
        <h2>Nueva Aplicación</h2>

        @foreach ($errors as $error)
            <span class="help-block">
                    <strong>{{ $error }}</strong>
                </span>
        @endforeach

        <form class="form-horizontal" role="form" method="POST" action="{{ url('aplicacion') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-6">
                    <input
                            type="text" class="form-control"
                            name="nombre" id="nombre" value="{{ old('nombre') }}"
                            placeholder="Ejemplo: Primera aplicación 2016"
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
                    <input type="file" name="arte" value="{{ old('arte') }}">
                </div>

                <div class="col-md-2">

                    <a href="#" class="btn btn-primary"
                       title="Arte"
                       data-toggle="popover"
                       data-trigger="focus"
                       data-content="Imagen única que se imprime en la constancia de asignación del aspirante.">?</a>
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
                        <input type='text' class="form-control" id="fecha_inicio_asignaiones"
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
                        <input type='text' class="form-control" id="fecha_fin_asignaciones"
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
                        <input type='text' class="form-control" id="fecha_aplicacion" name="fecha_aplicacion"
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
                        <input type='text' class="form-control" id="fecha_publicacion_resultados"
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
                                            <input type="text" id="txtSalon" placeholder="Salón L-II 3, Edificio T1">
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
                <label class="col-md-4 control-label">Cupo por salon</label>
                <div class="col-md-6">
                    <input type='number' class="form-control" id="cupo"
                           name="cupo" value="{{ old('cupo') }}"
                           placeholder="40"/>

                </div>

            </div>


            <!--
            +nombre
            path_arte
            fecha_aplicacion
            hora_inicio
            hora_fin
            fecha_publicacion_resultados
            percentil_RA
            percentil_APE
            percentil_RV
            percentil_APN
            **salon** componer
            **fecha inicio asignaciones**
            **fecha fin asignaciones**
            -->

            <!--div class="form-group{{ $errors->has('percentil_RA') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Percentil RA</label>
                <div class="col-md-6">
                    <input type="number" min="0" max="99" class="form-control" name="percentil_RA" value="{{ old('percentil_RA') }}">
                </div>
            </div>


            <div class="form-group{{ $errors->has('percentil_APE') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Percentil APE</label>
                <div class="col-md-6">
                    <input type="number" min="0" max="99" class="form-control" name="percentil_APE" value="{{ old('percentil_APE') }}">
                </div>
            </div>


            <div class="form-group{{ $errors->has('percentil_RV') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Percentil RV</label>
                <div class="col-md-6">
                    <input type="number" min="0" max="99" class="form-control" name="percentil_RV" value="{{ old('percentil_RV') }}">
                </div>
            </div>


            <div class="form-group{{ $errors->has('percentil_APN') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Percentil APN</label>
                <div class="col-md-6">
                    <input type="number" min="0" max="99" class="form-control" name="percentil_APN" value="{{ old('percentil_APN') }}">
                </div>
            </div-->


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
                format: 'L'
            });

        });

        contHorarios = 0;

        $("#btnAddHorario").click(function () {
            hi = $('#hora_inicio').val();
            hf = $('#hora_fin').val();
            a =
                    '<button type="button" onclick="quitarHorario(this);" ' +
                    'class="list-group-item horario-item" ' +
                    '>' +
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

            a =
                    '<button type="button" onclick="quitarSalon(this);" ' +
                    'class="list-group-item salon-item" ' +
                    '>' + salon +
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