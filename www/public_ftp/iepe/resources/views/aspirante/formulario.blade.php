@extends('layouts.formulario-layout')

@section('content')


    <form id="msform" class="form-horizontal" role="form" action="aspirante/formulario" method="POST">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Ińformación Personal</li>
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

                <div class="form-group{{ $errors->has('departamento') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Departamento: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="departamento">
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

                <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Genero: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="genero">
                            <option value="1">Masculino</option>
                            <option value="0">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Fecha de nacimiento: </label>
                    <div class="col-md-6">
                        <div class='input-group date fecha'>
                            <input class="form-control" type='text'  id="date_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" placeholder="día/mes/año"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
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
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/js/multistep.js" type="text/javascript"></script>
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
    </script>



@endsection
