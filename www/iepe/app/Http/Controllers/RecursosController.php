<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class RecursosController extends Controller
{

    public function index(){
        $this->verificarRecursosJSON();
        return view('admin.recursos.index');
    }

    public function verificarRecursosJSON(){
        $filejson = storage_path().'/recursos.json' ;
        $json = '';
        if(file_exists($filejson)) {
            $json = json_decode(file_get_contents($filejson),TRUE);
        }else{
            $json = [];
        }

        if(!isset($json['guia_aplicacion']))
            $json['guia_aplicacion'] = '';

        $filesBtn = ['imgbtn1','imgbtn2','imgbtn3','imgbtn4','imginfo'];
        foreach($filesBtn as $img)
            if(!isset($json['guia_aplicacion'][$img] ))
                $json['guia_aplicacion'][$img] = '';

        $videos = ['enlace1','enlace2','enlace3','enlace4'];
        foreach($videos as $url)
            if(!isset($json['guia_aplicacion'][$url]))
                $json['guia_aplicacion'][$url] = '';

        if(!isset($json['guia_aplicacion']['enlaces_ayuda']))
            $json['guia_aplicacion']['enlaces_ayuda'] = '';


        if(!isset($json['bienvenida']))
            $json['bienvenida'] = '';


        if(!isset($json['imagen_informativa']))
            $json['imagen_informativa'] = '';

        if(!isset($json['video_guia_asignacion']))
            $json['video_guia_asignacion'] = '';





        file_put_contents($filejson, json_encode($json,TRUE));

        return;
    }

    public function postImagenInformativa(Request $request){
        if(isset($request['imagenInformativa']) && $request->file('imagenInformativa')->isValid()) {
            $path = public_path().'/aspirante_public/img/'; // upload path
            $filename = 'imagenInformativa.'.$request->file('imagenInformativa')->getClientOriginalExtension();
            $request->file('imagenInformativa')->move($path, $filename);

            $filejson = storage_path().'/recursos.json' ;
            if(file_exists($filejson)) {
                $json = json_decode(file_get_contents($filejson),TRUE);
            }
            $json['imagen_informativa'] = $filename;
            file_put_contents($filejson, json_encode($json,TRUE));

            $request->session()->flash('mensaje_exito','Se ha actualizado la imagen informativa');
        }
        return back();
    }

    public function postReglamento(Request $request){
        if(isset($request['reglamento']) && $request->file('reglamento')->isValid()) {
            $path = public_path().'/aspirante_public/files/pdf/reglamento'; // upload path
            $extension = $request->file('reglamento')->getClientOriginalExtension(); // getting file extension
            $request->file('reglamento')->move($path, 'reglamento.'.$extension);
            $request->session()->flash('mensaje_exito','Se ha actualizado el reglamento que descargan los aspirantes');
        }
        return back();
    }

    function getYoutubeIdFromUrl($url) {
        $parts = parse_url($url);
        if(isset($parts['query'])){
            parse_str($parts['query'], $qs);
            if(isset($qs['v'])){
                return $qs['v'];
            }else if(isset($qs['vi'])){
                return $qs['vi'];
            }
        }
        if(isset($parts['path'])){
            $path = explode('/', trim($parts['path'], '/'));
            return $path[count($path)-1];
        }
        return false;
    }

    public function postBienvenida(Request $request){
        $postBienvenida = $request->postBienvenida;

        $filejson = storage_path().'/recursos.json' ;
        if(file_exists($filejson)) {
            $json = json_decode(file_get_contents($filejson),TRUE);
        }
        $json['bienvenida'] = $postBienvenida;
        file_put_contents($filejson, json_encode($json,TRUE));

        $request->session()->flash('mensaje_exito','Se ha actualizado el post de bienvenida');
        return back();
    }



    public function postGuiaAsignacion(Request $request){
        $videoUrl = $request->video_url;
        $vid = $this->getYoutubeIdFromUrl($videoUrl);

        $filejson = storage_path().'/recursos.json' ;
        if(file_exists($filejson)) {
            $json = json_decode(file_get_contents($filejson),TRUE);
        }
        $json['video_guia_asignacion'] = $vid;
        file_put_contents($filejson, json_encode($json,TRUE));

        $request->session()->flash('mensaje_exito','Se ha actualizado el video de guía de asignación');
        return back();
    }



    public function postGuiaAplicacion(Request $request){
        //dd($request->all());
        $filejson = storage_path().'/recursos.json' ;
        if(file_exists($filejson)) {
            $json = json_decode(file_get_contents($filejson),TRUE);
        }else{
            $json = [];
        }
        //$json['guia_aplicacion'] = [] ;
        //dd($json);
        //dd($request->all());

        $filesBtn = ['imgbtn1','imgbtn2','imgbtn3','imgbtn4','imginfo'];
        foreach($filesBtn as $img){
            //dd($filesBtn);
            if(isset($request[$img]) && $request->file($img)->isValid()) {
                $path = public_path().'/aspirante_public/img/guia-aplicacion'; // upload path
                $extension = $request->file($img)->getClientOriginalExtension(); // getting file extension
                $request->file($img)->move($path, $img.'.'.$extension);
                $json['guia_aplicacion'][$img.''] = $img.'.'.$extension;
            }
        }

        $videos = ['enlace1','enlace2','enlace3','enlace4'];
        foreach($videos as $url){
            if(isset($request[$url]) && $request[$url]!="") {
                $vid = $this->getYoutubeIdFromUrl($request[$url]);
                $json['guia_aplicacion'][$url] = $vid;
            }
        }

        if(isset($request->enlaces_ayuda) && $request->enlaces_ayuda!=""){
            $json['guia_aplicacion']['enlaces_ayuda'] = $request->enlaces_ayuda;
        }


        file_put_contents($filejson, json_encode($json,TRUE));
        $request->session()->flash('mensaje_exito','Se ha actualizado la guía de aplicación.');
        return back();
    }





    public function getReglamento(Request $request){

        return view("aspirante.recursos.reglamento");
    }

    public function viewImagenInformativa(){
        return view("aspirante.recursos.imagenInformativa");
    }


    public function viewGuiaAsignacion(){
        return view("aspirante.recursos.guia-asignacion");
    }

    public function viewGuiaAplicacion(){
        return view("aspirante.recursos.guia-aplicacion");
    }
}
