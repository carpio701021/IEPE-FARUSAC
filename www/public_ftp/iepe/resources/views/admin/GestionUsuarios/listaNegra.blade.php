@extends('layouts.admin-user')

@section('content')
    <div class="container">
        @include('layouts.mensajes')
        <h3>Casos Especiales</h3>
        <meta id="csrf_token" content="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de numeros de orientación bloqueados</div>
                <div class="panel-body">
                    <div class="form-horizontal" >
                        <div class="form-group">
                            <label class="control-label col-sm-3" >Buscar coincidencias en NOV:</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" name='NOV' id="NOV" min="100000000" max="9999999999" value="{{old('NOV')}}">
                            </div>
                            <div class="col-sm-2">
                                <a id='btn_buscar' class="btn btn-default">Buscar</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <ul class="list-group">
                        <?php $count = 1 ?>
                        @foreach($novs as $nov)
                                @if($count==1)
                                    <li class="list-group-item">
                                        <div class="row">
                                @endif      <div class="col-sm-3">
                                                <div class="col-md-5">
                                                    {{$nov->NOV}}
                                                </div>
                                                <div class="col-md-6">
                                                    <form action="/admin/aspirantes/{{$nov->id}}" method="POST">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" style="
                                                              border:none;
                                                              outline:none;
                                                              background:none;
                                                              cursor:pointer;
                                                              color:#0000EE;
                                                              padding:0;
                                                              text-decoration:underline;
                                                              font-family:inherit;
                                                              font-size:inherit;
                                                            " class="btn-link">
                                                            Rehabilitar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                @if($count==4)
                                        </div>
                                    </li>
                                    <?php $count=0?>
                                @endif
                                <?php $count++?>
                        @endforeach
                        </ul>
                    </div>
                    {{$novs->links()}}
                </div>
            </div>
    </div>
@stop

@section('scripts')
    <script src="/js/jquery.easing.1.3.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('#btn_buscar').click(function(){
            this.href='/admin/CasosEspeciales/'+NOV.value;
        })
    </script>
@stop