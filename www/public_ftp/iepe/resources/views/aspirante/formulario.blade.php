@extends('layouts.aspirante-layout')

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
                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Nombres: </label>
                    <div class="col-md-6">
                        <input type="text" name="txt_nombre" id="txt_nombre" placeholder="Nombres"/>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Apellidos:</label>
                    <div class="col-md-6">
                        <input type="text" name="txt_apellido" id="txt_apellido" placeholder="Apellidos"/>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Residencia:</label>
                    <div class="col-md-6">
                        <input type="text" name="txt_ubicacion" id="txt_ubicacion"
                               placeholder="Dirección de vivienda actual"/>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Departamento: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="select_departamento" id="select_departamento">

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

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Genero: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="select_genero">
                            <option value="1">Masculino</option>
                            <option value="0">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Fecha de nacimiento: </label>
                    <div class="col-md-6">
                        <div class='input-group date'>
                            <input type='text'  id="date_nacimiento" name="date_nacimiento" value="{{ old('fecha_inicio_asignaiones') }}" placeholder="día/mes/año"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Estado civil: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="select_estadoCivil">
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Situación laboral: </label>
                    <div class="col-md-6">
                        <select class="form-control" name="select_laboral">
                            <option value="trabaja">Trabajo</option>
                            <option value="no_trabaja">No trabajo</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Cuantos dependen de usted: </label>
                    <div class="col-md-6">
                        <input type="number" name="txt_dependientes" id="txt_dependientes"
                               placeholder="Cantidad de personas que dependen de usted"/>
                    </div>
                </div>

                <input type="button" name="next" class="next action-button" value="Siguiente"/>
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Formación académica</h2>
            <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
            <div class="row">
                <div class="col-sm-3">
                    <label>Titulo de nivel medio: </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" name="txt_titulo" id="txt_titulo" placeholder="Titulo"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Año de graduación: </label>
                </div>
                <div class="col-sm-3">
                    <div class="input-group date year">
                        <input id="date_titulo" name="date_titulo">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th"></i>
                </span>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label>Centro Educativo: </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" name="txt_centroEducativo" id="txt_centroEducativo"
                           placeholder="Nombre completo del centro educativo"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="txt_direccion" >Dirección: </label>
                </div>
                <div class="col-sm-9">
                    <input type="text" name="txt_direccion" id="txt_direccion"
                           placeholder="Dirección del centro educativo"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="select_sectorEducativo" >Sector: </label>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="form-control" id="select_sectorEducativo" name="select_sectorEducativo">
                            <option>Público</option>
                            <option>Privado</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Anterior"/>
            <input type="button" name="next" class="next action-button" value="Siguiente"/>
        </fieldset>

        <fieldset>
            <h2 class="fs-title">Intereses universitarios</h2>
            <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
            <div class="row">
                <div class="col-sm-3">
                    <label for="select_carrera" >Carrera: </label>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="form-control" id="select_carrera" name="select_carrera">
                            <option>Arquitectura</option>
                            <option>Diseño Gráfico</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="select_jornada" >Jornada: </label>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="form-control" id="select_jornada" name="select_jornada">
                            <option>Matutina</option>
                            <option>Vespertina</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <input type="button" name="previous" class="previous action-button" value="Anterior"/>
            <input type="submit" name="finalizar" class="next action-button" value="Finalizar"/>
        </fieldset>
    </form>

@stop




@section('scripts')
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="/js/multistep.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.input-group.date').datetimepicker({
                locale: 'es',
                format: 'L'
            });

            $('.input-group.date.year').datetimepicker({
                locale: 'es',
                format: "yyyy", // Notice the Extra space at the beginning
                viewMode: "years",
                minViewMode: "years",
                endDate: " " + new Date().getFullYear()
            });

        });
    </script>



@endsection
