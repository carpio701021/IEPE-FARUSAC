@extends('layouts.formulario-layout')



@section('content')


    <form id="msform" class="form-horizontal" role="form" action="{{ action('formularioController@store') }}" method="POST">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Información Personal</li>
            <li>Formación académica</li>
            <li>Intereses universitarios</li>
        </ul>
        <!-- fieldsets -->
        <fieldset class="form-horizontal">
            <h2 class="fs-title">Información Personal</h2>
            <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
                <div class="fs-title">{{Auth::user()->getNombreCompleto()}}</div>
                <div class="form-group{{ $errors->has('residencia') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Residencia:</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="residencia" value="{{old('residencia')}}"
                               placeholder="Dirección de vivienda actual"/>
                    </div>
                </div>
            <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Fecha de nacimiento*</label>

                <div class="col-md-6" align="left">
                    <select name="fecha_nac[]">
                        <option disabled selected>día</option>
                        @for($i=1;$i<=31;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>/
                    <select name="fecha_nac[]" >
                        <option disabled selected>mes</option>
                        <option value="1">enero</option>
                        <option value="2">febrero</option>
                        <option value="3">marzo</option>
                        <option value="4">abril</option>
                        <option value="5">mayo</option>
                        <option value="6">junio</option>
                        <option value="7">julio</option>
                        <option value="8">agosto</option>
                        <option value="9">septiembre</option>
                        <option value="10">octubre</option>
                        <option value="11">noviembre</option>
                        <option value="12">diciembre</option>
                    </select>/
                    <input type="number" min="{{ date('Y') - 70 }}" max="{{ date('Y') - 10 }}" name="fecha_nac[]" placeholder="año">

                    @if ($errors->has('email_confirmation'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('email_confirmation') }}</strong>
                                        </span>
                    @endif
                </div>
            </div>



            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Teléfono de casa:</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="telefono" value="{{old('telefono')}}"
                               placeholder="8 dígitos"/>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Teléfono celular:</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="celular" value="{{old('celular')}}"
                               placeholder="8 dígitos"/>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('departamento') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Departamento: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="departamento" id="departamento" onchange="changeDepartamento()">
                            <option selected disabled>Seleccione un departamento</option>
                            <option>Alta Verapaz</option>
                            <option>Baja Verapaz</option>
                            <option>Chimaltenango</option>
                            <option>Chiquimula</option>
                            <option>Petén</option>
                            <option>El Progreso</option>
                            <option>Quiché</option>
                            <option>Escuintla</option>
                            <option>Guatemala</option>
                            <option>Huehuetenango</option>
                            <option>Izabal</option>
                            <option>Jalapa</option>
                            <option>Jutiapa</option>
                            <option>Quetzaltenango</option>
                            <option>Retalhuleu</option>
                            <option>Sacatepéquez</option>
                            <option>San Marcos</option>
                            <option>Santa Rosa</option>
                            <option>Sololá</option>
                            <option>Suchitepéquez</option>
                            <option>Totonicapán</option>
                            <option>Zacapa</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="municipio">Municipio:</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="municipio" id="municipio" >
                        </select>
                    </div>
                </div>



                <div class="form-group{{ $errors->has('estado_civil') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Estado civil: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="estado_civil">
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Género: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="genero">
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('estado_laboral') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Situación laboral: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="estado_laboral">
                            <option value="trabaja">Trabajo</option>
                            <option value="no_trabaja">No trabajo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('dependientes') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Cuantos dependen de usted: </label>
                    <div class="col-md-6">
                        <input class="form-control" type="number" min="0" name="dependientes" value="{{old('dependientes')}}"
                               placeholder="Cantidad de personas que dependen de usted"/>
                    </div>
                </div>

                <input type="button" name="next" class="next action-button" value="Siguiente"/>
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Formación académica</h2>
            <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>

            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Titulo de nivel medio: </label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="titulo" value="{{old('titulo')}}" placeholder="Titulo"/>
                </div>
            </div>
            <div class="form-group{{ $errors->has('anio_titulo') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" >Año de graduación: </label>
                <div class="col-md-6">
                    <div class="input-group date year">
                        <input class="form-control" id="date_titulo" value="{{old('anio_titulo')}}" name="anio_titulo">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('centro_educativo') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Centro Educativo: </label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="centro_educativo" value="{{old('centro_educativo')}}"
                           placeholder="Nombre completo del centro educativo"/>
                </div>
            </div>
            <div class="form-group{{ $errors->has('direccion_centro_educativo') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Dirección centro educativo: </label>
                <div class="col-md-6">
                    <input class="form-control" type="text" name="direccion_centro_educativo" value="{{old('direccion_centro_educativo')}}"
                           placeholder="Dirección del centro educativo"/>
                </div>
            </div>
            <div class="form-group{{ $errors->has('sector') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" >Sector: </label>
                <div class="col-md-6">
                        <select class="form-control" id="select_sectorEducativo" name="sector">
                            <option value="publico">Público</option>
                            <option value="privado">Privado</option>
                        </select>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Anterior"/>
            <input type="button" name="next" class="next action-button" value="Siguiente"/>
        </fieldset>

        <fieldset>
            <h2 class="fs-title">Intereses universitarios</h2>
            <h3 class="fs-subtitle">Los siguientes datos son para conocer su preferencia actual de carrera y jornada. <br>Si obtiene resultados satisfactorios, será considerada su preferencia para una futura asignación.</h3>
            <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label" >Carrera: </label>
                <div class="col-md-6">
                    <select class="form-control" id="select_carrera" name="carrera">
                        <option value="arquitectura">Arquitectura</option>
                        <option value="diseño">Diseño Gráfico</option>
                    </select>
                </div>
            </div>
            <div class="form-group{{ $errors->has('jornada') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Jornada: </label>
                <div class="col-md-6">
                    <select class="form-control" id="select_jornada" name="jornada">
                        <option value="matutina">Matutina</option>
                        <option value="vespertina">Vespertina</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <input type="button" class="previous action-button" value="Anterior"/>
            <input type="submit" class="next action-button" value="Finalizar"/>
        </fieldset>
    </form>

@stop




@section('scripts')
    <script src="{{ url('aspirante_public/js/jquery.easing.1.3.js') }}" type="text/javascript"></script>
    <script src="{{ url('aspirante_public/js/multistep.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.input-group.date.fecha').datetimepicker({
                locale: 'es',
                format: 'L',
                format: 'DD/MM/YYYY',
                //startDate: '1990/01/01/',
            });

            $('.input-group.date.year').datetimepicker({
                locale: 'es',
                format: "YYYY" // Notice the Extra space at the beginning
                //endDate: " " + new Date().getFullYear()
            });

        });

        function changeDepartamento(){
            var dept = document.getElementById('departamento').value;
            $.get( "/aspirante_public/json/guatemala.json", function( data ) {
                var municipios=data[dept];
                municipio.innerHTML="";
                for(var i =0; i<municipios.length; i++){
                    var option = document.createElement("option");
                    option.text = municipios[i];
                    document.getElementById('municipio').add(option);
                }
            });
        }
    </script>


@endsection
