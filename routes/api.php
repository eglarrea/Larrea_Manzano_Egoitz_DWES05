<?php

use App\Models\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Obtiene la lista de todos los cines
Route::get('/cines','App\Http\Controllers\CineController@index');

// Obtiene los datos de un cine por id
Route::get('/cines/{cine}','App\Http\Controllers\CineController@show');

// Crea un nuevo cine
Route::post('/cines','App\Http\Controllers\CineController@store');

// Actualiza los datos de un cine
Route::put('/cines/{cine}','App\Http\Controllers\CineController@update');

// Elimina un cine
Route::delete('/cines/{cine}','App\Http\Controllers\CineController@destroy');

// Actualiza los datos de una sala de un cine
Route::put('/cines/{cine}/sala/{sala}','App\Http\Controllers\SalaController@update');

// Si no encuentra el recurso sale por fallback
Route::fallback(function() {
    $respuesta=new Respuesta();
    $respuesta->setStatusCode(404);
    $respuesta->setError(true);
    $respuesta->setMensajeError("El recurso solicitado no se ha encontrado");
    return response()->json($respuesta);
});
