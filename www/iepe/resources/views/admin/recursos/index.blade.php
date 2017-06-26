@extends('layouts.admin-user')

@section('styles')
    <link rel='stylesheet' href="{{ url('aspirante_public/css/quill.snow.css') }}">
@stop

@section('content')
    <div class="container">
        @include('layouts.mensajes')
        <h3>Administrar recursos para aspirantes</h3>
        <br/>

        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#inicio" aria-controls="inicio" role="tab" data-toggle="tab">Inicio</a></li>
                <li role="presentation"><a href="#info_disenio" aria-controls="info_disenio" role="tab" data-toggle="tab">Información de Diseño</a></li>
                <li role="presentation"><a href="#info_arqui" aria-controls="info_arqui" role="tab" data-toggle="tab">Información de Arquitectura</a></li>
                <li role="presentation"><a href="#calendario" aria-controls="calendario" role="tab" data-toggle="tab">Calendario</a></li>
                <li role="presentation"><a href="#reglamento" aria-controls="reglamento" role="tab" data-toggle="tab">Reglamento</a></li>
                <li role="presentation"><a href="#guia_asignacion" aria-controls="guia_asignacion" role="tab" data-toggle="tab">Guía de Asignación</a></li>
                <li role="presentation"><a href="#guia_aplicacion" aria-controls="guia_aplicacion" role="tab" data-toggle="tab">Guía de Aplicación</a></li>
            </ul>

            <br/>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="inicio">
                    <h3>Imagen de boton a información de Diseño Gráfico</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="btn btn-default btn-file" onclick="cancelarFile('ImgInfoDisenio')">
                                                Seleccionar archivo...
                                                {!! Form::file('ImgInfoDisenio' , array(
                                                'style'     =>  'display:none',
                                                'onchange'  =>  "input_file_b64(this,'ImgInfoDisenio_b64','ImgInfoDisenio')",
                                                'id'        =>  'fileImgInfoDisenio',
                                                'accept'    =>  'image/*'
                                                )) !!}

                                            </label>
                                            <label class="control-label" id="labelfileImgInfoDisenio">No se ha seleccionado ningun
                                                archivo</label>

                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <form class="" role="form"
                                              action="{{ action('RecursosController@postImgInfoDisenio') }}" method="Post"
                                              accept-charset="UTF-8" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="submit" class="btn btn-primary" value="Subir imagen">
                                            <input type="hidden" name="ImgInfoDisenio_b64" id="ImgInfoDisenio_b64">
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <h3>Imagen de boton a información de Arquitectura</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="btn btn-default btn-file" onclick="cancelarFile('ImgInfoArqui')">
                                                Seleccionar archivo...
                                                {!! Form::file('ImgInfoArqui' , array(
                                                'style'     =>  'display:none',
                                                'onchange'  =>  "input_file_b64(this,'ImgInfoArqui_b64','ImgInfoArqui')",
                                                'id'        =>  'fileImgInfoArqui',
                                                'accept'    =>  'image/*'
                                                )) !!}

                                            </label>
                                            <label class="control-label" id="labelfileImgInfoArqui">No se ha seleccionado ningun
                                                archivo</label>

                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <form class="" role="form"
                                              action="{{ action('RecursosController@postImgInfoArqui') }}" method="Post"
                                              accept-charset="UTF-8" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="submit" class="btn btn-primary" value="Subir imagen">
                                            <input type="hidden" name="ImgInfoArqui_b64" id="ImgInfoArqui_b64">
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <p>Información de la pagína de inicio.</p>
                    <br/>
                    <h3>Imagenes del carousel:</h3>
                    <div class="row">
                        <div class="col-md-12">

                            <p>Cargar nueva:</p>
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="btn btn-default btn-file" onclick="cancelarFile('Carousel')">
                                                Seleccionar archivo...
                                                {!! Form::file('imgCarousel' , array(
                                                'style'     =>  'display:none',
                                                'onchange'  =>  "input_file_b64(this,'imgCarousel_b64','Carousel')",
                                                'id'        =>  'fileCarousel',
                                                'accept'    =>  'image/*'
                                                )) !!}

                                            </label>
                                            <label class="control-label" id="labelfileCarousel">No se ha seleccionado ningun archivo</label>

                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <form class="" role="form"
                                              action="{{ action('RecursosController@postAddToCarousel') }}" method="Post"
                                              accept-charset="UTF-8" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="submit" class="btn btn-primary" value="Agregar a Carousel">
                                            <input type="hidden" name="imgCarousel_b64" id="imgCarousel_b64">
                                        </form>
                                    </td>
                                </tr>
                            </table>



                        </div>
                        <?php $iterador = 0; ?>
                        @foreach(json_decode(file_get_contents(storage_path().'/recursos.json'),TRUE)['inicio']['carousel'] as $imgCarousel)
                            <div class="col-md-3">
                                <div class="thumbnail">
                                    <a target="_blank" href="{{$imgCarousel}}">
                                        <img id="img" src="{{$imgCarousel}}" alt="Lights" style="width:100%">
                                    </a>
                                    <div class="caption">
                                        <p>Imagen #{{$iterador+1}} <a href="{{ action('RecursosController@BorImgCarrousel',$iterador) }}" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></a></p>
                                    </div>
                                </div>
                                <?php $iterador += 1; ?>
                            </div>
                        @endforeach
                    </div>
                    <br/>

                    {{--
                    Ésto aparecerá en la bienvenida y se pueden poner videos, imagenes y textos al gusto. *Si insertar video no funciona, dejar lineas debajo de donde se quiere incertar.
                    <form class="form-horizontal" role="form"
                          action="{{ action('RecursosController@postBienvenida') }}" method="Post"
                          accept-charset="UTF-8" enctype="multipart/form-data"
                          onsubmit="javascript: return postFormBienvenida();">
                        <div class="form-group">
                            {{csrf_field()}}
                            <div id="standalone-container">
                                <input type="hidden" name="postBienvenida" id="postBienvenida">
                                <div id="editor-postBienvenida">{!! json_decode((file_get_contents(storage_path().'/recursos.json')),TRUE)['bienvenida'] !!}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>--}}
                </div>
                <div role="tabpanel" class="tab-pane" id="info_disenio">info_disenio</div>
                <div role="tabpanel" class="tab-pane" id="info_arqui">info_arqui</div>
                <div role="tabpanel" class="tab-pane" id="calendario">
                    <div class="row">
                        <div class="col-sm-4">
                            Esta imagen mostrará un afiche con información relevante a las próximas aplicaciones.
                        </div>
                        <div class="col-sm-5">
                            <form class="form-horizontal" role="form"
                                  action="{{ action('RecursosController@postImagenInformativa') }}" method="Post"
                                  accept-charset="UTF-8" enctype="multipart/form-data">
                                <div class="form-group">
                                    {{csrf_field()}}
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(2)">
                                        Seleccionar archivo...
                                        {!! Form::file('imagenInformativa' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(2)",
                                        'id' => 'file2',
                                        'accept' => 'image/*'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile2">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-5">
                                        <button type="submit" class="btn btn-primary">Cargar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ action('RecursosController@viewImagenInformativa') }}" class="btn btn-default"
                               target="_blank">Ver afiche actual</a>
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="reglamento">
                    <div class="row">
                        <div class="col-sm-4">
                            Éste reglamento es accesible por cualquier persona que visite el sitio web.
                        </div>
                        <div class="col-sm-5">
                            <form class="form-horizontal" role="form"
                                  action="{{ action('RecursosController@postReglamento') }}" method="Post"
                                  accept-charset="UTF-8" enctype="multipart/form-data">
                                <div class="form-group">
                                    {{csrf_field()}}
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(1)">
                                        Seleccionar archivo...
                                        {!! Form::file('reglamento' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(1)",
                                        'id' => 'file1',
                                        'accept' => '.pdf'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile1">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-5">
                                        <button type="submit" class="btn btn-primary">Cargar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ action('RecursosController@getReglamento') }}" class="btn btn-default"
                               target="_blank">Ver reglamento actual</a>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="guia_asignacion">
                    <div class="row">
                        <div class="col-sm-4">
                            Este video estará disponible para que los aspirantes aprendan la forma correcta de asignarce
                            su examen específico.
                        </div>
                        <div class="col-sm-5">
                            <form class="form-horizontal" role="form"
                                  action="{{ action('RecursosController@postGuiaAsignacion') }}" method="Post"
                                  accept-charset="UTF-8" enctype="multipart/form-data">
                                <div class="form-group">
                                    {{csrf_field()}}
                                    <label>Enlace de youtube:</label>
                                    <input type="text" name="video_url" placeholder="URL del video" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-5">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ action('RecursosController@viewGuiaAsignacion') }}" class="btn btn-default"
                               target="_blank">Ver video actual</a>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="guia_aplicacion">
                    <form class="form-horizontal" role="form"
                          action="{{ action('RecursosController@postGuiaAplicacion') }}" method="Post"
                          accept-charset="UTF-8" enctype="multipart/form-data"
                          onsubmit="javascript: return postFormGuiaAplicacion();">
                        <div class="row">
                            <div class="col-sm-6">
                                Por cada aptitud que el estudiante debe aprobar se dará una breve explicación en un
                                video.
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ action('RecursosController@viewGuiaAplicacion') }}" class="btn btn-default"
                                   target="_blank">Ver guía actual</a>
                            </div>
                            {{csrf_field()}}
                            <div class="col-sm-12">
                                <h4>Imagen principal</h4>
                                <div class="form-group">
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(7)">
                                        Seleccionar archivo...
                                        {!! Form::file('imginfo' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(7)",
                                        'id' => 'file7',
                                        'accept' => 'image/*'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile7">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                            </div>
                        </div>
                        <h4>Razonamiento abstracto</h4>
                        <div class="row">

                            <div class="col-sm-6">
                                <label>Boton:</label>
                                <div class="form-group">
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(3)">
                                        Seleccionar archivo...
                                        {!! Form::file('imgbtn1' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(3)",
                                        'id' => 'file3',
                                        'accept' => 'image/*'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile3">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enlace de youtube:</label><br/>
                                    <input type="text" name="enlace1" placeholder="URL del video" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h4>Aptitud espacial</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Boton:</label>
                                <div class="form-group">
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(4)">
                                        Seleccionar archivo...
                                        {!! Form::file('imgbtn2' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(4)",
                                        'id' => 'file4',
                                        'accept' => 'image/*'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile4">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enlace de youtube:</label><br/>
                                    <input type="text" name="enlace2" placeholder="URL del video" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h4>Razonamiento verbal</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Boton:</label>
                                <div class="form-group">
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(5)">
                                        Seleccionar archivo...
                                        {!! Form::file('imgbtn3' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(5)",
                                        'id' => 'file5',
                                        'accept' => 'image/*'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile5">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enlace de youtube:</label><br/>
                                    <input type="text" name="enlace3" placeholder="URL del video" class="form-control">
                                </div>
                            </div>
                        </div>
                        <h4>Aptitud numérica</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Boton:</label>
                                <div class="form-group">
                                    <label class="btn btn-default btn-file" onclick="cancelarFile(6)">
                                        Seleccionar archivo...
                                        {!! Form::file('imgbtn4' , array(
                                        'style' =>'display:none',
                                        'onchange'=> "cambiar_archivo(6)",
                                        'id' => 'file6',
                                        'accept' => 'image/*'
                                        )) !!}

                                    </label>
                                    <label class="control-label" id="labelfile6">No se ha seleccionado ningun
                                        archivo</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enlace de youtube:</label><br/>
                                    <input type="text" name="enlace4" placeholder="URL del video" class="form-control">
                                </div>
                            </div>
                        </div>

                        <h4>Enlaces de ayuda</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Ingrese el texto que desea que los aspirantes vean como ayuda:</label>
                                <div class="form-group">
                                    <div id="standalone-container">
                                        <input name="enlaces_ayuda"  id="enlaces_ayuda" type="hidden">
                                        <div id="editor-GuiaAplicacion">{!! json_decode((file_get_contents(storage_path().'/recursos.json')),TRUE)['guia_aplicacion']['enlaces_ayuda'] !!}</div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="col-xs-5">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>














    </div>
@stop

@section('scripts')
    <script src="{{ url('aspirante_public/js/quill.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">


        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            //['blockquote', 'code-block'],

            //[{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            //[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            //[{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['image', 'video'],

            ['clean']                                         // remove formatting button

        ];
        var quill1 = new Quill('#editor-GuiaAplicacion', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Escribe y edita aqui tu texto...',
            theme: 'snow'
        });
         /*
        var quillBienvenida = new Quill('#editor-postBienvenida', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Escribe y edita aqui tu texto...',
            theme: 'snow'
        });
        */

        function postFormGuiaAplicacion() {
            enviar = document.getElementById('editor-GuiaAplicacion').firstElementChild.innerHTML;
            document.getElementById("enlaces_ayuda").value = enviar;
            return true;
        }

        function postFormBienvenida() {
            enviar = document.getElementById('editor-postBienvenida').firstElementChild.innerHTML;
            //alert(enviar);
            document.getElementById("postBienvenida").value = enviar;
            return true;
        }

        function cancelarFile(id) {
            document.getElementById('file' + id).value = null;
        }
        function cambiar_archivo(id) {
            document.getElementById('labelfile' + id).innerHTML = document.getElementById('file' + id).value;
        }

        function input_file_b64(input,input_name,name) {
            cambiar_archivo(name+'');

            if (input.files && input.files[0]) {
            //if (this.files && this.files[0]) {

                var FR= new FileReader();

                FR.addEventListener("load", function(e) {
                    //document.getElementById("img").src       = e.target.result;
                    document.getElementById(input_name+'').value = e.target.result;
                });

                FR.readAsDataURL( input.files[0] );
            }
        }



        //document.getElementById("fileCarousel").addEventListener("change", readFile);

    </script>
@stop