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
    
    public function postReglamento(Request $request){
        if($request->file('reglamento')->isValid()) {
            $path = public_path().'/files/pdf/reglamento'; // upload path
            $extension = $request->file('reglamento')->getClientOriginalExtension(); // getting file extension
            $request->file('reglamento')->move($path, 'reglamento.'.$extension);
            $request->session()->flash('mensaje_exito','Se ha actualizado el reglamento que descargan los aspirantes');
        }
        return back();
    }

    public function getReglamento(Request $request){
        return Response::make(file_get_contents(public_path().'/files/pdf/reglamento/reglamento.pdf'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Reglamento"'
        ]);
    }
}
