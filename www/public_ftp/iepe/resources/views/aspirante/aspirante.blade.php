@extends('layouts.aspirante-layout')

@section('content')	
	<h1>Aspirante</h1>
	<ul>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Información Personal</strong>
							</div>
							<!--
							//todo:
								agregar datos de cuenta (correo, NOV)
                    		-->
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="row">
										<label class="control-label col-xs-6">Nombres:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->nombre}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Apellidos:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->apellido}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Género:</label>
										<div class="col-xs-6">
											<p class="form-control-static">@if($formulario->genero==1) Masculino
												@else Femenino @endif</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Residencia:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->residencia}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Departamento:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->departamento}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Edad:</label>
										<div class="col-xs-6">
											<p class="form-control-static">
												{{\Carbon\Carbon::createFromFormat('Y-m-d',$formulario->fecha_nacimiento)->age}}
											</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Estado civil:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->estado_civil}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Situación laboral:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->estado_laboral}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6" >Dependientes:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->dependientes}}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Información Académica</strong>
							</div>
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="row">
										<label class="control-label col-xs-6">Título:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->titulo}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6">Año de graduación:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->anio_titulo}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6">Centro educativo:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->centro_educativo}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6">Dirección:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->direccion_centro_educativo}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6">Sector:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->sector}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6">Aspirante a:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->carrera}}</p>
										</div>
									</div>
									<div class="row">
										<label class="control-label col-xs-6">Jornada:</label>
										<div class="col-xs-6">
											<p class="form-control-static">{{$formulario->jornada}}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="panel-footer" align="right" style="padding-right: 3%">
					<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#ModalActualizar">Actualizar</button>

					<!-- Modal -->
					<div id="ModalActualizar" class="modal fade" role="dialog" align="left">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 style="color:#EBC14D">Actualizar Datos</h3>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" role="form" action="/aspirante/formulario/{{$formulario->id_formulario}}" method="post">
										<input type="hidden" name="_method" value="PUT">
										<div class="form-group">
											<label class="control-label col-sm-2" for="nombre">Nombre:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="nombre" name="nombre" value="{{$formulario->nombre}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="apellido">Apellido:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="apellido" name="apellido" value="{{$formulario->apellido}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="genero">Género:</label>
											<div class="col-sm-10">
												<select class="form-control" name="genero" id="genero" >
													<option value="1" @if($formulario->genero==1) selected @endif>Masculino</option>
													<option value="0" @if($formulario->genero==0) selected @endif>Femenino</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="residencia">Residencia:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="residencia" name="residencia" value="{{$formulario->residencia}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="departamento">Departamento:</label>
											<div class="col-sm-10">
												<select class="form-control" name="departamento" id="departamento" >
													<option selected>{{$formulario->departamento}}</option>
													<option>Alta Verapaz</option><option>Baja Verapaz</option>
													<option>Chimaltenango</option><option>Chiquimula</option>
													<option>Petén</option><option>El Progreso</option>
													<option>Quiché</option><option>Escuintla</option>
													<option>Guatemala</option><option>Huehuetenango</option>
													<option>Izabal</option><option>Jalapa</option>
													<option>Jutiapa</option><option>Quetzaltenango</option>
													<option>Retalhuleu</option><option>Sacatepéquez</option>
													<option>San Marcos</option><option>Santa Rosa</option>
													<option>Sololá</option><option>Suchitepéquez</option>
													<option>Totonicapán</option><option>Zacapa</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="fecha_nacimiento">Fecha de Nacimiento:</label>
											<div class="col-sm-10">
												<div class='input-group date'>
													<input type='text' class="form-control"  id="fecha_nacimiento" value="{{$formulario->fecha_nacimiento}}" name="fecha_nacimiento"/>
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-calendar"></span>
													</span>
												</div>

											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="estado_civil">Estado Civil:</label>
											<div class="col-sm-10">
												<select class="form-control" name="estado_civil" id="estado_civil">
													<option value="soltero" @if($formulario->estado_civil=="soltero") selected @endif>Soltero</option>
													<option value="casado" @if($formulario->estado_civil=="casado") selected @endif>Casado</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="estado_laboral">Estado laboral:</label>
											<div class="col-sm-10">
												<select class="form-control" name="estado_laboral" id="estado_laboral">
													<option value="trabaja" @if($formulario->estado_laboral=="trabaja") selected @endif>Trabaja</option>
													<option value="no_trabaja" @if($formulario->estado_laboral=="no_trabaja") selected @endif>No Trabaja</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="dependientes">Dependientes:</label>
											<div class="col-sm-10">
												<input type="number" class="form-control" min="0" id="dependientes" name="dependientes" value="{{$formulario->dependientes}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="titulo">Titulo:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="titulo" value="{{$formulario->titulo}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="anio_titulo">Año de Graduación:</label>
											<div class="col-sm-10">
												<input type="number" class="form-control" id="anio_titulo" name="anio_titulo" value="{{$formulario->anio_titulo}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="centro_educativo">Centro Educativo:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="centro_educativo" value="{{$formulario->centro_educativo}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="direccion_centro_educativo">Dirección:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="direccion_centro_educativo" value="{{$formulario->direccion_centro_educativo}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="sector">Sector:</label>
											<div class="col-sm-10">
												<select class="form-control" name="sector" id="sector">
													<option value="privado" @if($formulario->sector=="privado") selected @endif>Privado</option>
													<option value="publico" @if($formulario->sector=="publico") selected @endif>Público</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="carrera">Carrera:</label>
											<div class="col-sm-10">
												<select class="form-control" name="carrera" id="carrera">
													<option value="arquitectura" @if($formulario->carrera=="arquitectura") selected @endif>Arquitectura</option>
													<option value="diseño" @if($formulario->carrera=="diseño") selected @endif>Diseño</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="jornada">Jornada:</label>
											<div class="col-sm-10">
												<select class="form-control" name="jornada" id="jornada">
													<option value="matutina" @if($formulario->jornada=="matutina") selected @endif>Matutina</option>
													<option value="vespertina" @if($formulario->jornada=="vespertina") selected @endif>Vespertina</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<button type="submit" class="btn btn-default">Guardar</button>
											</div>
										</div>
										<input type="hidden" name="_token" value="{!! csrf_token() !!}">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
					<strong>Información de cuenta</strong>
				</div>
				<div class="panel-body">
					<div class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-xs-6" for="NOV">No. Orientación Vocacional:</label>
							<p class="form-control-static col-xs-6" id="NOV">{{Auth::user()->NOV}}</p>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-6">Correo:</label>
							<p class="form-control-static col-xs-6" id="email">{{Auth::user()->email}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</ul>
@stop

@section('scripts')

	<script type="text/javascript">
		$(function () {
			$('.input-group.date').datetimepicker({
				locale: 'es',
				format: 'L',
				format: 'YYYY-MM-DD'
			});

		});
	</script>



@endsection