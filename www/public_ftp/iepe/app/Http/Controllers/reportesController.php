<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aspirante;

use App\Http\Requests;

class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.reportes.index');
    }

    public function reporteGeneral(){
        $aspirantes = Aspirante::all();
        dd($aspirantes);
    }
}
