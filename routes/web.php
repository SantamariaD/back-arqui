<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\generalController;

Route::get('/', function () {
    return view('welcome');
});

//INICIO DE RUTAS
Route::post('/contacto', 'generalController@guardarCotacto');
Route::post('/registro', 'generalController@registro');
Route::post('/login', 'generalController@login');
Route::get('/traer-contactos', 'generalController@traerContactos');
Route::get('/borrar-contactos/{id}', 'adminController@borrarContacto');
Route::post('/guardar-imagen', 'adminController@guardarImagen');
Route::get('/traer-imagen/{nombre}', 'adminController@traerImagen');
Route::post('/guardar-servicio', 'adminController@guardarServicio');
Route::get('/traer-servicios', 'adminController@traerServicio');
Route::get('/borrar-servicio/{id}', 'adminController@borrarServicio');
Route::get('/traer-cambios', 'adminController@cambiosGenerales');
Route::post('/actualizar-cambios', 'adminController@actualizarCambios');
Route::post('/guardar-proyecto', 'adminController@guardarProyecto');
Route::get('/traer-proyectos', 'adminController@traerProyectos');
Route::get('/borrar-proyecto/{id}', 'adminController@borrarProyecto');
//FIN DE RUTAS
