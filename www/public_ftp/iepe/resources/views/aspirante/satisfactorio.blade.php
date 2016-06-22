@extends('layouts.aspirante-layout')

@section('content')
	<h1>Resultados satisfactorios</h1>
	@if(Auth::user()->aprobo())

		<form class="form-horizontal" action="/aspirante/formulario/{{$formulario->id_formulario}}/confirmar" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Confirmar intereses universitarios</h4>
				</div>
				<div class="panel-body">
					<div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
						<label class="col-md-4 control-label" >Carrera: </label>
						<div class="col-md-6">
							<select class="form-control" id="select_carrera" name="carrera">
								<option value="arquitectura" @if($formulario->carrera=='arquitectura')selected @endif >Arquitectura</option>
								<option value="diseño" @if($formulario->carrera=='diseño')selected @endif >Diseño Gráfico</option>
							</select>
						</div>
					</div>
					<div class="form-group{{ $errors->has('jornada') ? ' has-error' : '' }}">
						<label class="col-md-4 control-label">Jornada: </label>
						<div class="col-md-6">
							<select class="form-control" id="select_jornada" name="jornada">
								<option value="matutina" @if($formulario->jornada=='matutina')selected @endif >Matutina</option>
								<option value="vespertina" @if($formulario->jornada=='vespertina')selected @endif >Vespertina</option>
							</select>
						</div>
					</div>
					<div class="col-sm-offset-4 col-sm-6">
						{{csrf_field()}}
						<div align="right">
							<input type="hidden" name="confirmacion_intereses" value="1">
						<button type="submit" class="btn btn-primary">Confirmar</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	@else
		<div class="alert alert-warning">
			<strong>Lo sentimos</strong>, tendras acceso a esta área cuando obtengas resultado satisfactorio en la prueba específica.
			Si ya obtuviste resultado satisfactorio y continuas viendo este mensaje, acude a la oficina de orientacion estudiantil de la Facultad de Arquitectura.
		</div>
	@endif
@stop