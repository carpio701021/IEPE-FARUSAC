<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Aspirante;
use App\ListaNegra;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;

class ListaNegraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aspirantes = Aspirante::take(29)->paginate(20);
        return view('admin.GestionUsuarios.listaAspirantes',compact('aspirantes'));
    }
    
    public function getListaNegra(){
        $novs = ListaNegra::paginate(10);
        return view('admin.GestionUsuarios.listaNegra',compact('novs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('NOV')){
            ListaNegra::create($request->all());
            $request->session()->flash('mensaje_exito','Se agregó '.$request->NOV.' a la lista negra');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($search)
    {
        $aspirantes = Aspirante::where('NOV', 'LIKE', '%'.$search.'%')->paginate(20);
        return view('admin.GestionUsuarios.listaAspirantes',compact('aspirantes'));
    }

    public function listaNegraShow($search)
    {
        $novs = ListaNegra::where('NOV', 'LIKE', '%'.$search.'%')->paginate(20);
        return view('admin.GestionUsuarios.listaNegra',compact('novs'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//update aspirantes
    {
        try{
            Aspirante::find($id)->update($request->all());
            $request->session()->flash('mensaje_exito','Correo actualizado');
            return back();
        }catch(\Illuminate\Database\QueryException $ex){
            $aspirante = Aspirante::where('email',$request->email)->first();
            return back()->withErrors(['email'=>'El correo '.$request->email.' ya está en uso por el aspirante '.$aspirante->NOV]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $nov = ListaNegra::find($id);
        $nov->delete();
        $request->session()->flash('mensaje_exito',$nov->NOV.' eliminado de la lista negra');
        return back();
    }
}
