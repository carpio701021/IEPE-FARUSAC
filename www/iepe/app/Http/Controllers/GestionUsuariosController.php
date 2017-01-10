<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin;
use App\Http\Requests\GestionUsuariosRequest;

class GestionUsuariosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        extract(get_object_vars($this));
        return view('admin.GestionUsuarios.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $admin = new Admin();        
        extract(get_object_vars($this));        
        //dd($admin);
        return view('admin.GestionUsuarios.model',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GestionUsuariosRequest $request)
    {
        //
        $request['password'] = bcrypt($request->password);
        $admin = new Admin($request->all());
        $admin->save();
        $request->session()->flash('mensaje_exito','Usuario <i>'.$request->registro_personal.'</i> creado.');
        return redirect(action('GestionUsuariosController@index'));
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
        //
        $titulo = 'Editar usuario administrativo';
        $admin = Admin::findOrFail($id);
        $put = true;
        extract(get_object_vars($this));
        return view('admin.GestionUsuarios.model',compact('admin','titulo','put'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GestionUsuariosRequest $request, $id)
    {

        if($request->registro_personal != $id){
            $admin = Admin::where('registro_personal',$request->registro_personal)->first();
            if($admin != null) {
                $errors = Array('El registro de personal <i>'.$request->registro_personal.'</i> ya está registrado con otro usuario.');
                return back()->withErrors($errors)->withInput();
            }
        }

        if(isset($request['password'])) $request['password'] = bcrypt($request->password);
        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        $request->session()->flash('mensaje_exito','Cambios en usuario <i>'.$admin->registro_personal.'</i> guardados.');
        return redirect(action('GestionUsuariosController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        Admin::destroy($id);

        return 'Usuario <i>'.$id.'</i> eliminado.';
    }
}
