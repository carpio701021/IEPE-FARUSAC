@extends('layouts.admin-user')

@section('content')

    <div class="container">
        <h2>{{ $titulo or 'Nueva aplicación' }}</h2>

        @include('layouts.mensajes')

        {!! Form::model(
            $aplicacion,
            array('action' => array('AplicacionController@update', $aplicacion->id),
            'files' => true , 'class' => 'form-horizontal', 'role' => 'form'
        ) ) !!}
        @if( isset($put))
            <input type="hidden" name="_method" value="PUT">
        @endif
        @if( isset($especial))
            <div class="form-group">
                <input type="hidden" name="_id_base" value="{{$aplicacionBase->id}}">
                <input type="hidden" name="irregular" value="{{$aplicacion->irregular}}">
                <input type="hidden" name="year" value="{{$aplicacion->year}}">
                <input type="hidden" name="naplicacion" value="{{$aplicacion->naplicacion}}">
                <input type="hidden" name="fecha_inicio_asignaciones" value="{{$aplicacion->fecha_inicio_asignaciones}}">
                <input type="hidden" name="fecha_fin_asignaciones" value="{{$aplicacion->fecha_fin_asignaciones}}">
                @foreach( $aplicacionBase->getFechasA() as $fechaA )
                    <input name="fechasA[]" value="{{ $fechaA }}" type="hidden">
                @endforeach
                @foreach( $aplicacionBase->getHorarios() as $horario )
                    <input name="horarios[]" value="{{ $horario->hora_inicio.'-'.$horario->hora_fin  }}" type="hidden">
                @endforeach
                @foreach( $aplicacionBase->getSalones() as $salon )
                    <input name="salones[]" value="{{ $salon->edificio }}:==:{{ $salon->nombre }}:==:{{ $salon->capacidad }}" type="hidden">
                @endforeach
            </div>
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Nombre:</label>
                <div class="col-md-6">{{$aplicacion->nombre()}}</div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-4">
                * Esta aplicación es para aquellos aspirantes con resultados que deben ser reevaluados.
                </div>
            </div>
        @else
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                {!! Form::label('year', 'Año*', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::number('year' , null , array(
                    'class' => 'form-control',
                    'placeholder' => '2016',
                    'required' => 'true',
                    'title' => 'Año',
                    'data-placement' => 'left',
                    'data-toggle' => 'popover',
                    'data-trigger' => 'focus',
                    'data-content' => 'Año en que se llevará a cabo la aplicación',
                    )) !!}
                </div>
            </div>

            <div class="form-group{{ $errors->has('naplicacion') ? ' has-error' : '' }}">
                {!! Form::label('naplicacion', 'Número de aplicación*', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                {!! Form::select('naplicacion' , [1=>'Primera',2=>'Segunda',3=>'Tercera',4=>'Cuarta',5=>'Quinta'] ,null, array(
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione el número de aplicación',
                    'required' => 'true',
                    )) !!}
                </div>
            </div>

            <div class="form-group{{  $errors->has('arte') ? ' has-error' : '' }}">
                {!! Form::label('arte', 'Arte', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                    {!! Form::file('arte' , array(
                    'accept' =>'image/*'
                    )) !!}
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary"
                            title="Arte"
                            data-toggle="popover"
                            data-trigger="focus"
                            data-content="Imagen que se imprime y se troquela como comprobante de que aprobó el específico.">?</button>
                </div>
            </div>

            <div class="form-group{{ $errors->has('fecha_inicio_asignaciones') ? ' has-error' : '' }}">
                {!! Form::label('fecha_inicio_asignaciones', 'Fecha de inicio de asignaciones*', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                    <div class='input-group date fecha'
                         data-toggle="popover"
                         data-placement="left"
                         data-trigger="focus"
                         title="Fecha de inicio de asignaciones"
                         data-content="Día en el que al usuario aspirante le aparecerá ésta aplicación para asignarse.">
                        {!! Form::text('fecha_inicio_asignaciones' , null , array(
                        'class' => 'form-control',
                        'placeholder' => 'año/mes/día',
                        'required' => 'true',
                        )) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('fecha_fin_asignaciones') ? ' has-error' : '' }}">
                {!! Form::label('fecha_fin_asignaciones', 'Fecha de cierre de asignaciones*', array('class' => 'col-md-4 control-label')) !!}
                <div class="col-md-6">
                    <div class='input-group date fechayhora'
                         data-toggle="popover"
                         data-placement="left"
                         data-trigger="focus"
                         title="Fecha de cierre de asignaciones"
                         data-content="Día en el que se deshabilitará la opción de asignarce a ésta aplicación.">
                        {!! Form::text('fecha_fin_asignaciones' , null , array(
                        'class' => 'form-control',
                        'placeholder' => 'año/mes/día',
                        'required' => 'true',
                        )) !!}
                        <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('fechas_aplicacion') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Fechas de aplicación*</label>
                <div class="list-group col-md-6" id="divFechasA">
                    @if(old('fechasA'))
                        @foreach( old('fechasA') as $fechaA )
                            <button type="button" onclick="quitarFechaA(this);" class="list-group-item{{ $errors->has('fecha_aplicacion') ? ' has-error' : '' }} fechaA-item">
                                <span class="glyphicon glyphicon-minus"></span> {{ $fechaA }}
                                <input style="display:none" name="fechasA[]" value="{{ $fechaA }}" type="text">
                            </button>
                        @endforeach
                    @elseif(isset($aplicacion))
                        @foreach( $aplicacion->getFechasA() as $fechaA )
                            <button type="button" onclick="quitarFechaA(this);" class="list-group-item{{ $errors->has('fecha_aplicacion') ? ' has-error' : '' }} fechaA-item">
                                <span class="glyphicon glyphicon-minus"></span> {{ $fechaA }}
                                <input style="display:none" name="fechasA[]" value="{{ $fechaA }}" type="text">
                            </button>
                        @endforeach
                    @endif

                    <a href="" id="btnFA" data-toggle="modal" data-target="#modal_fechasA"
                       class="list-group-item {{ $errors->has('fecha_aplicacion') ? '  list-group-item-danger' : ' active' }}">
                        <span class="glyphicon glyphicon-plus"></span> Agregar Fecha
                    </a>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="fechasA_popover"
                            title="Fecha de Aplicación"
                            data-toggle="popover"
                            data-trigger="focus"
                            data-content="Presione el boton para agregar una fecha de aplicación. En estas fechas serán asignados los aspirantes.">?</button>
                </div>

                <!-- Modal agregar horario -->
                <div class="modal fade" id="modal_fechasA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Nueva fecha de aplicación</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Fecha</label>
                                        <div class="col-md-6">
                                            <div class='input-group date fecha' id='datetimepicker_fechaA'>
                                                <input type='text' class="form-control" id="fecha_aplicacion"
                                                       placeholder="Año/mes/día"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="btnAddFechaA">Agregar fecha
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="form-group{{ $errors->has('horarios') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Horarios*</label>
                <div class="list-group col-md-6" id="divHorarios">
                    @if(old('horarios'))
                        @foreach( old('horarios') as $horario )
                            <button type="button" onclick="quitarHorario(this);" class="list-group-item{{ $errors->has('fecha_inicio_asignaciones') ? ' has-error' : '' }} horario-item">
                                <span class="glyphicon glyphicon-minus"></span> De {{ str_replace('-',' a ',$horario) }} hrs
                                <input style="display:none" name="horarios[]" value="{{ $horario }}" type="text">
                            </button>
                        @endforeach
                    @elseif(isset($aplicacion))
                        @foreach( $aplicacion->getHorarios() as $horario )
                            <button type="button" onclick="quitarHorario(this);" class="list-group-item{{ $errors->has('fecha_inicio_asignaciones') ? ' has-error' : '' }} horario-item">
                                <span class="glyphicon glyphicon-minus"></span> De {{ substr($horario->hora_inicio, 0, 6)  }} a {{ substr($horario->hora_fin, 0, 6) }} hrs
                                <input style="display:none" name="horarios[]" value="{{ $horario->hora_inicio.'-'.$horario->hora_fin  }}" type="text">
                            </button>
                        @endforeach
                    @endif

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
                <label class="col-md-4 control-label">Salones*</label>
                <div class="list-group col-md-6">
                    @if(old('salones'))
                        @foreach( old('salones') as $salon )
                            <button type="button" onclick="quitarSalon(this);" class="list-group-item salon-item">
                                <span class="glyphicon glyphicon-minus"></span> Edificio: {{ str_replace([':==:',':==:'],[', salón: ' ,', para '] , $salon )}} aspirantes
                                <input style="display:none" name="salones[]" value="{{ $salon }}" type="text">
                            </button>
                        @endforeach
                    @elseif(isset($aplicacion))
                        @foreach( $aplicacion->getSalones() as $salon )
                            <button type="button" onclick="quitarSalon(this);" class="list-group-item salon-item">
                                <span class="glyphicon glyphicon-minus"></span> Edificio: {{ $salon->edificio }}, salón: {{ $salon->nombre }}, para {{ $salon->capacidad }} aspirantes
                                <input style="display:none" name="salones[]" value="{{ $salon->edificio }}:==:{{ $salon->nombre }}:==:{{ $salon->capacidad }}" type="text">
                            </button>
                        @endforeach
                    @endif

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
                                        <label class="col-md-4 control-label">Edificio</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="txtEdificio" placeholder="T1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Salón</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="txtSalon" placeholder="L-II 3">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Cupo del salón</label>
                                        <div class="col-md-6">
                                            <input type='number' class="form-control" id="cupo"
                                                   name="cupo"
                                                   placeholder="40"
                                                   title="Cupo por salón"
                                                   data-toggle="popover"
                                                   data-placement="left"
                                                   data-trigger="focus"
                                                   data-content="Conforme los aspirantes se asignanen, el sistema llenará salones automáticamente."/>
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

        @endif


        <div class="form-group">
            <div class="col-md-2 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
                </button>
            </div>
            <div class="col-md-2">
                <a href="javascript:history.go(-1);" class="btn btn-danger">
                    <i class="glyphicon glyphicon-floppy-remove"></i> Cancelar
                </a>
            </div>
        </div>

        {!! Form::close() !!}

        <br><br>



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
            $('.input-group.date.fechayhora').datetimepicker({
                locale: 'es',
                format: 'YYYY/MM/DD H:mm'
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
                }else if( $( ".fechaA-item").length <=0 ){
                    alert( "Aún no ha ingresado fechas para la aplicación para la aplicación" );
                    $("#fechasA_popover").focus();
                }
                event.preventDefault();
            }
            //$( "#form_create" ).submit();
        });

        contHorarios = 0;

        $("#btnAddFechaA").click(function () {
            fa = $('#fecha_aplicacion').val();
            if(fa==""){
                $('#modal_fechasA').modal('hide');
                return;
            }

            a =
                    '<button type="button" onclick="quitarFechaA(this);" ' +
                    'class="list-group-item fechaA-item" ' +
                    '><span class="glyphicon glyphicon-minus"></span> ' +
                    fa +
                    '<input type="text" style="display:none"' +
                    'name="fechasA[]" ' +
                    'value="' + fa + '">' +
                    '</button>';
            $("#btnFA").before(a);

            $('#modal_fechasA').modal('hide');
        });

        function quitarFechaA(boton) {
            $(boton).remove();
        }


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
            edificio = $('#txtEdificio').val();
            salon = $('#txtSalon').val();
            cupo = $('#cupo').val();
            if(cupo=="") cupo =40;
            if(salon=="" || edificio=="") {
                $('#modal_salon').modal('hide');
                return;
            }

            a =
                    '<button type="button" onclick="quitarSalon(this);" ' +
                    'class="list-group-item salon-item">' +
                    '<span class="glyphicon glyphicon-minus"></span> Edificio: ' + edificio + ', salón: ' + salon + ', para ' + cupo + ' aspirantes' +
                    '<input type="text" style="display:none"' +
                    'name="salones[]" ' +
                    'value="' + edificio + ':==:' + salon + ':==:' + cupo + '">' +
                    '</button>';
            $("#btnAS").before(a);

            $('#modal_salon').modal('hide');
        });

        function quitarSalon(boton) {
            $(boton).remove();
        }

    </script>
@endsection