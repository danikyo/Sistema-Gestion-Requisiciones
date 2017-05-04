<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/project/{id}/user', 'Admin\ProjectController@byUser');

Route::get('/requisicion/{id}/{user}/project', 'Admin\RequisicionController@byProject');
Route::get('/requisicion/{id}/activity', 'Admin\RequisicionController@byActivity');
Route::get('/requisicion/{id}/resource', 'Admin\RequisicionController@byResource');
Route::get('/requisicion/{id}/product', 'Admin\RequisicionController@byProduct');