@extends('layouts.admin-user')

@section('content')
    <div id="msgExito" class="container" style="display:none">
        <div class="alert alert-success fade in" id="msgExitoAlert">
            <div id="txtMsgExito"></div>
        </div>
    </div>
    @include('layouts.mensajes')
<div class="container">
    <ul class="list-group">
        <li class="list-group-item active clearfix">
            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Administración de usuarios</h2>
            <div class="btn-group pull-right">
                <a href="{{ action('GestionUsuariosController@create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo usuario administrativo</a>
            </div>
        </li>
        @foreach($admins as $admin)
                <li id="li{{ $admin->registro_personal }}" class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Registro personal:</b> {{ $admin->registro_personal }} <br>
                            <b>Nombre:</b> {{ $admin->apellido }}, {{ $admin->nombre }} <br>
                            <b>Correo:</b> {{ $admin->email }} <br>
                            <b>Rol:</b> {{ $admin->getRolName() }}
                        </div>

                        <div class="col-md-4">
                            <a href="{{ action('GestionUsuariosController@edit',['usuarios'=>$admin->registro_personal]) }}"><span class="glyphicon glyphicon-pencil"></span> Editar datos</a><br>
                            <a href="javascript:void(0)" onclick="borrarAdmin({{ $admin->registro_personal }})"><span class="glyphicon glyphicon-trash"></span> Borrar</a><br>
                        </div>
                    </div>

                </li>
        @endforeach
    </ul>


    <!-- Modal Confirmar eliminar -->
    <div id="modalConfirmar" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmar operación</h4>
                </div>
                <div class="modal-body">
                    <p id="txtConfirmar"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a href="javascript:sendBorrarAdmin()" class="btn btn-danger btn">Eliminar</a>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal Cambiar pass -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar contraseña</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


</div>

@endsection

@section('scripts')
<script>
    function editarDatos(registro_personal){
        alert('Editar: '+registro_personal);
    }

    function cambiarPass(registro_personal){
        alert('Pass: '+registro_personal);
    }

    registro_personal_g = '';

    function borrarAdmin(registro_personal){
        registro_personal_g = registro_personal;
        $('#modalConfirmar').modal('show');
        txtConfirmar.innerHTML = '¿Desea eliminar al usuario ' + registro_personal + '?';

    }

    function sendBorrarAdmin(){
        $('#modalConfirmar').modal('hide');
        $.ajax({
            url: '{{ action('GestionUsuariosController@destroy',['usuarios'=>'']) }}/' + registro_personal_g,
            type: 'POST',  // user.destroy
            data: {
                '_token': "{{ csrf_token() }}",
                '_method': 'DELETE'
            },
            success: function(data) {
                document.getElementById('li'+registro_personal_g).style.display = 'none';
                document.getElementById('msgExitoAlert').className = 'alert alert-success fade in';
                document.getElementById('txtMsgExito').innerHTML = '<strong>Hecho: </strong> El usuario ' + registro_personal_g + ' ha sido eliminado.';
                document.getElementById('msgExito').style.display = 'block';
                window.setTimeout(function () { // hide alert message
                    document.getElementById('msgExito').style.display = 'none';
                }, 7000);//milisegundos
            },
            error: function(){
                document.getElementById('msgExitoAlert').className = 'alert alert-succes fade in';
                document.getElementById('txtMsgExito').innerHTML = '<strong>Error: </strong> no se pudo eliminar al usuario ' + registro_personal_g ;
                document.getElementById('msgExito').style.display = 'block';
            }
        });
    }
</script>
@endsection