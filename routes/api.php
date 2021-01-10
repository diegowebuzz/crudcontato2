<?php

use App\Http\Controllers\ContatosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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



Route::post("contatos",  [ContatosController::class, 'adicionarContato']);


Route::get("contatos",  [ContatosController::class, 'recuperarContatos']);

Route::get("contatos/{id}",   [ContatosController::class, 'recuperarContato']);



Route::post("contatos/{id}", [ContatosController::class, 'atualizarContato']);

Route::delete("contatos/{id}", [ContatosController::class, 'removerContato']);
