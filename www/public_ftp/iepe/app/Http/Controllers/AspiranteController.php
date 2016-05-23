<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Aspirante;
use Auth;

class AspiranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u=Auth::user();
        //dd($u->NOV);
        $aspirante = Aspirante::where('NOV',$u->NOV)->first();
        $form=$aspirante->getFormulario();
        if($form)
            return view("aspirante.aspirante")->with("formulario",$form);
        else            
            return view("aspirante.formulario");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function actualizarCuenta(Request $request){
        $credenciales=["email"=>Auth::user()->email,"password"=>$request->password];
        if(Auth::guard("aspirante_web")->attempt($credenciales)){
            $u=Aspirante::find(Auth::user()->NOV);
            if($request->email){
                $u->email=$request->email;
                $u->save();
                $request->session()->flash('mensaje_exito', 'Correo Actualizado');
                return back();
            }else{
                if($request->newPassword==$request->newPassword2){
                       $u->password= bcrypt($request->newPassword);
                        $u->save();
                        $request->session()->flash('mensaje_exito', 'Contraseña actualizada');
                        return back();
                }else{
                    return back()->withErrors(["newPassword"=>"No coinciden"]);
                }
            }
        }else
            return back()->withErrors(["password"=>"Contraseña incorrecta"]);
    }
}
