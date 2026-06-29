<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PagamentoController;
use App\Http\Controllers\Api\EntregaController;
use App\Http\Controllers\Api\VendaController;
//use App\Http\Controllers\CompraController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post(
'/pagamento/status',
[PagamentoController::class,'atualizar']
);


Route::post(
'/entrega/status',
[EntregaController::class,'atualizar']
)->name('entrega.status');



Route::get('/vendas', [VendaController::class, 'index']);
Route::get('/vendas/{id}', [VendaController::class, 'show']);