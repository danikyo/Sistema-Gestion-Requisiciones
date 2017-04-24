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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('home', 'HomeController@index');

//Rutas para logeados
Route::group(['middleware' => 'auth', 'middleware' => 'aprobado', 'namespace' => 'Admin'], function () {
	Route::get('requisicion-nueva', 'RequisicionController@index');
	Route::post('requisicion-nueva', 'RequisicionController@store');
	Route::get('requisicion-mis-requisiciones', 'RequisicionController@read');
	Route::get('requisicion={id}', 'RequisicionController@view');
	Route::post('requisicion={id}', 'RequisicionController@auth');
	Route::get('perfil', 'UserController@index');
	Route::post('perfil', 'UserController@update');
});

//Rutas que solo pueden acceder Secretario Académico, Finanzas y Planeación
Route::group(['middleware' => 'administracion', 'namespace' => 'Admin'], function () {
	Route::get('requisicion-consultar', 'RequisicionController@all');
});

//Rutas que solo puede acceder Secretario Académico
Route::group(['middleware' => 'secretario', 'namespace' => 'Admin'], function () {
	Route::get('usuario-consultar', 'UserController@read');
	Route::post('usuario-consultar', 'UserController@auth');
	Route::get('usuario={id}', 'UserController@edit');
	Route::post('usuario={id}', 'UserController@delete');
});

//Rutas que solo puede acceder Planeación
Route::group(['middleware' => 'planeacion', 'namespace' => 'Admin'], function () {
	Route::get('nuevoProyecto', 'ProjectController@index');
	Route::post('nuevoProyecto', 'ProjectController@store');
	Route::get('consultarProyecto', 'ProjectController@read');
	Route::get('proyecto={id}', 'ProjectController@edit');
});