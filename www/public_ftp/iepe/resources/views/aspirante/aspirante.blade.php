@extends('aspirante.layout')

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
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6" align="right">Nombre:</div>
									<div class="col-sm-6" align="left">valor</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Género:</div>
									<div class="col-sm-6" align="left">valosdfr</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Residencia</div>
									<div class="col-sm-6" align="left">valoaaaaar</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Departamento:</div>
									<div class="col-sm-6" align="left">valor</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Edad:</div>
									<div class="col-sm-6" align="left">valosdfr</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Estado civil:</div>
									<div class="col-sm-6" align="left">valoaaaaar</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Situación laboral:</div>
									<div class="col-sm-6" align="left">valoaaaaar</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Dependientes:</div>
									<div class="col-sm-6" align="left">2</div>
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
									<div class="col-sm-6" align="left">valor</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Año de graduación:</div>
									<div class="col-sm-6" align="left">valosdfr</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Centro educativo:</div>
									<div class="col-sm-6" align="left">valoaaaaar</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Dirección:</div>
									<div class="col-sm-6" align="left">valor</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Sector:</div>
									<div class="col-sm-6" align="left">valosdfr</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right"> Aspirante a:</div>
									<div class="col-sm-6" align="left">valoaaaaar</div>
								</div>
								<div class="row">
									<div class="col-sm-6" align="right">Estado civil:</div>
									<div class="col-sm-6" align="left">valoaaaaar</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer" align="right">
					<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal">Actualizar</button>

					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog" align="left">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Actualizar datos</h4>
								</div>
								<div class="modal-body">
									<p>Aqui van a ir los campos de la actualizacion</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
		<li><a href="">Actualizar información</a></li>		
		<li><a href="">Cambiar contraseña</a></li>
	</ul>
@stop