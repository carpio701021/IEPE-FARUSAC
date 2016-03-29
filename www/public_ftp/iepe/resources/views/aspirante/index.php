<!DOCTYPE html>
<html lang="en">
<head>
    <title>SAPE - FARUSAC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/aspirante.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">
    <script src="/js/jquery-2.2.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>    
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>    
    <script src="/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FARUSAC</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--li class="active"><a href="#">Usuarios <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Notificaciones</a></li-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aspirante <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Consultar numero de orientacion</a></li>
                        <li><a href="#">otro</a></li>
                        <!--li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li-->
                    </ul>
                </li>                
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">-Nombre de usuario- <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <!-- multistep form -->
    <div>
<form id="msform">
	<!-- progressbar -->
	<ul id="progressbar">
        <li class="active">Ińformación Personal</li>
        <li>Información de formación académica</li>
        <li>Intereses universitarios</li>
    </ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Información Personal</h2>
		<h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_nombre" >Nombres: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_nombre" id="txt_nombre" placeholder="Nombres" />
            </div>
        </div>		
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_apellido" >Apellidos: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_apellido" id="txt_apellido" placeholder="Apellidos" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "combo_genero" >Genero: </label>                
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                 <select class="form-control" id="sel1">
                    <option>Masculino</option>
                    <option>Femenino</option>                    
                  </select>
              </div>
            </div>            
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "combo_genero" >Fecha de nacimiento: </label>                
            </div>            
            <div class="col-sm-9">                    
            <div class="well">
                  <div id="datetimepicker1" class="input-append date">
                    <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                  </div>
            </div>
                <script type="text/javascript">
                  $(function() {
                    $('#datetimepicker1').datetimepicker({
                      language: 'pt-BR'
                    });
                  });
                </script>            
            </div>            
        </div>      		
		<input type="button" name="next" class="next action-button" value="Siguiente" />
	</fieldset>
	<fieldset>
        <h2 class="fs-title">Información de formación académica</h2>
        <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_nombre" >Nombres: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_nombre" id="txt_nombre" placeholder="Nombres" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_apellido" >Apellidos: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_apellido" id="txt_apellido" placeholder="Apellidos" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "combo_genero" >Genero: </label>                
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                 <select class="form-control" id="sel1">
                    <option>Masculino</option>
                    <option>Femenino</option>                    
                  </select>
              </div>
            </div>            
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "combo_genero" >Fecha de nacimiento: </label>                
            </div>            
            <div class="col-sm-9">                    
            <div class="well">
                  <div id="datetimepicker1" class="input-append date">
                    <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                  </div>
            </div>
                <script type="text/javascript">
                  $(function() {
                    $('#datetimepicker1').datetimepicker({
                      language: 'pt-BR'
                    });
                  });
                </script>            
            </div>            
        </div>              
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Siguiente" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Intereses universitarios</h2>
        <h3 class="fs-subtitle">Requisito para asignación de prueba especifica</h3>
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_nombre" >Nombres: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_nombre" id="txt_nombre" placeholder="Nombres" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
              <label for "txt_apellido" >Apellidos: </label>
            </div>
            <div class="col-sm-9" >
              <input type="text" name="txt_apellido" id="txt_apellido" placeholder="Apellidos" />
            </div>
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "combo_genero" >Genero: </label>                
            </div>            
            <div class="col-sm-4">                    
            <div class="form-group">
                 <select class="form-control" id="sel1">
                    <option>Masculino</option>
                    <option>Femenino</option>                    
                  </select>
              </div>
            </div>            
        </div>      
        <div class="row">
            <div class="col-sm-3">
                <label for "combo_genero" >Fecha de nacimiento: </label>                
            </div>            
            <div class="col-sm-9">                    
            <div class="well">
                  <div id="datetimepicker1" class="input-append date">
                    <input data-format="dd/MM/yyyy hh:mm:ss" type="text"></input>
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                  </div>
            </div>
                <script type="text/javascript">
                  $(function() {
                    $('#datetimepicker1').datetimepicker({
                      language: 'pt-BR'
                    });
                  });
                </script>            
            </div>            
        </div>              
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Siguiente" />
    </fieldset>
</form>



    </div>       
</div>

</body>
<script src="/js/multistep.js" type="text/javascript"></script>
</html>

