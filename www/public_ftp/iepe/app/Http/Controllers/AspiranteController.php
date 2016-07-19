<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AspiranteRequest;
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
        $formulario=Auth::user()->getFormulario();
        return view("aspirante.aspirante",compact("formulario"));
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

    public function actualizarCuenta(AspiranteRequest $request){
        $credenciales=["email"=>Auth::user()->email,"password"=>$request->password];
        if(Auth::guard("aspirante_web")->attempt($credenciales)){
            $u=Aspirante::find(Auth::user()->NOV);
            if($request->email){
                try{
                    $u->email=$request->email;
                    $u->save();
                    $request->session()->flash('mensaje_exito','Correo actualizado');
                    return back();
                }catch(\Illuminate\Database\QueryException $ex){
                    $aspirante = Aspirante::where('email',$request->email)->first();
                    return back()->withErrors(['email'=>'El correo '.$request->email.' ya está en uso por el aspirante '.$aspirante->NOV]);
                }
            }else{
                $u->password= bcrypt($request->newPassword);
                $u->save();
                $request->session()->flash('mensaje_exito', 'Contraseña actualizada');
                return back();
            }
        }else
            return back()->withErrors(["password"=>"Contraseña incorrecta"]);
    }
}
