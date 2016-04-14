<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
    return view('admin.index');
});


Route::get('/admin/usuarios', function () {
    return view('admin.usuarios');
});

Route::get('/admin/oportunidades', function () {
    return view('admin.oportunidades');
});


Route::get('/aspirante/PruebaEspecifica', function () {
    return View::make('aspirante.PruebaEspecifica');
});

Route::get('/aspirante/ResultadosSatisfactorios', function () {
    return View::make('aspirante.satisfactorio');
});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/aspirante', function () {
        return view('aspirante.index');
    });

});
// RA APE RV APN Percentiles que ingresan
// aplicación -> oportunidad
// subir archivo de notas
// registro de personal
