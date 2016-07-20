<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class RecursosController extends Controller
{
    public function index(){
        return view('admin.recursos.index');
    }

    public function postImagenInformativa(Request $request){
        if($request->file('imagenInformativa')->isValid()) {
            $path = public_path().'/aspirante_public/img/'; // upload path
            $filename = 'imagenInformativa.'.$request->file('imagenInformativa')->getClientOriginalExtension();
            $request->file('imagenInformativa')->move($path, $filename);

            $filejson = storage_path().'/recursos.json' ;
            if(file_exists($filejson)) {
                $json = json_decode(file_get_contents($filejson),TRUE);
            }
            $json['imagen_informativa'] = '/aspirante_public/img/'.$filename;
            file_put_contents($filejson, json_encode($json,TRUE));

            $request->session()->flash('mensaje_exito','Se ha actualizado la imagen informativa');
        }
        return back();
    }

    public function postReglamento(Request $request){
        if($request->file('reglamento')->isValid()) {
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

    public function postVideoBienvenida(Request $request){
        $videoUrl = $request->video_url;
        $vid = $this->getYoutubeIdFromUrl($videoUrl);

        $filejson = storage_path().'/recursos.json' ;
        if(file_exists($filejson)) {
            $json = json_decode(file_get_contents($filejson),TRUE);
        }
        $json['video_bienvenida'] = 'https://www.youtube.com/embed/'.$vid
            .'?version=3&autoplay=1&loop=1&controls=0&playlist='.$vid.'&showinfo=0&theme=light';
        file_put_contents($filejson, json_encode($json,TRUE));

        $request->session()->flash('mensaje_exito','Se ha actualizado el video de bienvenida');
        return back();
    }



    public function postGuiaAsignacion(Request $request){
        $videoUrl = $request->video_url;
        $vid = $this->getYoutubeIdFromUrl($videoUrl);

        $filejson = storage_path().'/recursos.json' ;
        if(file_exists($filejson)) {
            $json = json_decode(file_get_contents($filejson),TRUE);
        }
        $json['video_guia_asignacion'] = 'https://www.youtube.com/embed/'.$vid
            .'?version=3&autoplay=1&loop=1&controls=0&playlist='.$vid.'&showinfo=0&theme=light';
        file_put_contents($filejson, json_encode($json,TRUE));

        $request->session()->flash('mensaje_exito','Se ha actualizado el video de guía de asignación');
        return back();
    }



    public function postGuiaAplicacion(Request $request){
        //TODO terminar
        $files = ['imgbtn1','imgbtn2','imgbtn3','imgbtn4','imginfo'];
        if($request->file('imgbtn1')->isValid()) {
            $path = public_path().'/aspirante/img/guia-aplicacion'; // upload path
            $extension = $request->file('reglamento')->getClientOriginalExtension(); // getting file extension
            $request->file('imgbtn1')->move($path, 'imgbtn1.'.$extension);
            $request->session()->flash('mensaje_exito','Se ha actualizado el reglamento que descargan los aspirantes');
        }
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
