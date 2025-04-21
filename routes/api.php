<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioControlador;
use App\Http\Controllers\ReservaControlador;
use App\Http\Controllers\LineaControlador;
use App\Http\Controllers\IngredienteControlador;
use App\Http\Controllers\OrdenCompraControlador;
use App\Http\Controllers\OrdenIngredienteControlador;
use App\Http\Controllers\SaborControlador;
use App\Http\Controllers\SaborIngredienteControlador;
use App\Http\Controllers\SaborIngredienteControlador2;

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
Route::post('/login',[usuarioControlador::class,'login']);
Route::post('/pizzapaisa',[usuarioControlador::class, 'store']);
Route::group(['middleware' => ['jwt.auth']], function () {
    
    Route::get('/pizzapaisa',[usuarioControlador::class,'index']);
    Route::get('/pizzapaisa/{UsuarioDocumento}',[usuarioControlador::class, 'show']);
    Route::put('/pizzapaisa/{UsuarioDocumento}',[usuarioControlador::class, 'update']);
    Route::delete('/pizzapaisa/{UsuarioDocumento}',[usuarioControlador::class,'destroy']);
    Route::post('/reserva', [ReservaControlador::class, 'store']);
    Route::get('/reserva', [ReservaControlador::class, 'index']);
    Route::put('/reserva', [ReservaControlador::class,'updeit']);
    Route::delete('/reserva', [ReservaControlador::class,'dilit']);
    Route::get('/linea', [LineaControlador::class, 'index']);
    Route::post('/linea', [LineaControlador::class, 'store']);
    Route::get('/lineas/{idPedido}', [LineaControlador::class, 'getByPedido']);
    Route::get('/ingredientes', [IngredienteControlador::class, 'index']);
    Route::post('/ingredientes', [IngredienteControlador::class, 'store']);
    Route::post('/orden-compra', [OrdenCompraControlador::class, 'store']);
    Route::post('/orden-ingrediente', [OrdenIngredienteControlador::class, 'store']);
    Route::post('/sabor', [SaborControlador::class, 'store']);
    Route::post('/sabor-ingrediente', [SaborIngredienteControlador::class, 'store']);
    Route::post('/sabor-ingredientes', [SaborIngredienteControlador2::class, 'store']);
    Route::get('/sabores', [SaborControlador::class, 'index']);
});

