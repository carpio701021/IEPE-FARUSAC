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
								<div class="row">
									<div class="col-sm-6" align="right">Nombres:</div>
									<div class="col-sm-6" align="left">{{$formulario->nombre}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Apellidos:</div>
									<div class="col-sm-6" align="left">{{$formulario->apellido}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Género:</div>
									<div class="col-sm-6" align="left">@if($formulario->genero==1) Masculino
																		@else Femenino @endif</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Residencia</div>
									<div class="col-sm-6" align="left">{{$formulario->residencia}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Departamento:</div>
									<div class="col-sm-6" align="left">{{$formulario->departamento}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Edad:</div>
									<div class="col-sm-6" align="left">
										{{\Carbon\Carbon::createFromFormat('Y-m-d',$formulario->fecha_nacimiento)->age}}
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Estado civil:</div>
									<div class="col-sm-6" align="left">{{$formulario->estado_civil}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Situación laboral:</div>
									<div class="col-sm-6" align="left">{{$formulario->estado_laboral}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Dependientes:</div>
									<div class="col-sm-6" align="left">{{$formulario->dependientes}}</div>
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
								<div class="row">
									<div class="col-sm-6" align="right">Título:</div>
									<div class="col-sm-6" align="left">{{$formulario->titulo}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Año de graduación:</div>
									<div class="col-sm-6" align="left">{{$formulario->anio_titulo}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Centro educativo:</div>
									<div class="col-sm-6" align="left">{{$formulario->centro_educativo}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Dirección:</div>
									<div class="col-sm-6" align="left">{{$formulario->direccion_centro_educativo}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Sector:</div>
									<div class="col-sm-6" align="left">{{$formulario->sector}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Aspirante a:</div>
									<div class="col-sm-6" align="left">{{$formulario->carrera}}</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Jornada:</div>
									<div class="col-sm-6" align="left">{{$formulario->jornada}}</div>
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
													<input type='text' class="form-control"  id="fecha_nacimiento" name="fecha_nacimiento" value="{{$formulario->fecha_nacimiento}}" placeholder="año/mes/día"/>
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
												<input type="number" class="form-control" id="dependientes" name="dependientes" value="{{$formulario->dependientes}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="titulo">Titulo:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="titulo" value="{{$formulario->titulo}}">
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
												<input type="text" class="form-control" id="centro_educativo" value="{{$formulario->centro_educativo}}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-2" for="direccion_centro_educativo">Dirección:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="direccion_centro_educativo" value="{{$formulario->direccion_centro_educativo}}">
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
		</div>
	</ul>
@stop

@section('scripts')

	<script type="text/javascript">
		$(function () {
			$('.input-group.date').datetimepicker({
				locale: 'es',
				format: 'L'
			});

		});
	</script>



@endsection