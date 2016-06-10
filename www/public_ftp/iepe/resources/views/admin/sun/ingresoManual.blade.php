@extends('layouts.admin-user')

@section('content')
    <div class="container">
        @include('layouts.mensajes')
        <h3>Ingresar manualmente resultados básicos</h3>
        <form class="form-horizontal" role="form" action="/admin/datos/insert" method="Post" >
            {{csrf_field()}}

            <div class="form-group">
                <label class="control-label col-sm-2" >No. Orientación:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="orientacion" min="1000000000" max="9999999999">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" >Primer nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="primer_nombre">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" >Segundo nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="segundo_nombre">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" >Primer apellido:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="primer_apellido">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" >Segundo apellido:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="segundo_apellido">
                </div>
            </div>
            <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Fecha de nacimiento: </label>
                <div class="col-sm-10">
                    <div class='input-group date fecha'>
                        <input class="form-control" type='text'  id="date_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" placeholder="día/mes/año"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Sexo: </label>
                <div class="col-sm-10">
                    <select class="form-control" name="sexo">
                        <option value="1">Masculino</option>
                        <option value="0">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" >Materia (id):</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="id_materia" min="0">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" >Aprobación:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="aprobacion" min="0" placeholder="esto se quita porque se supone esto es para aprobados">
                </div>
            </div>

            <div class="form-group{{ $errors->has('fecha_evaluacion') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Fecha de evaluación: </label>
                <div class="col-sm-10">
                    <div class='input-group date fecha'>
                        <input class="form-control" type='text'  id="date_evaluacion" name="fecha_evaluacion" value="{{ old('fecha_nacimiento') }}" placeholder="día/mes/año"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('anio_evaluacion') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" >Año de evaluación: </label>
                <div class="col-sm-10">
                    <div class="input-group date year">
                        <input class="form-control" id="date_evaluacion" name="anio_evaluacion">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>

                <div class="form-group" align="right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
@stop