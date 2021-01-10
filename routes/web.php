<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('contatos');
});
Route::get('/detalhes-contato', function () {
    return view('contato');
});

Route::get('/contatos', function () {
    return view('contatos');
});

Route::get('/criar-contato', function () {
    return view('criaContato');
});


Route::get('/editar-contato', function () {
    return view('editarContato');
});

Route::get('/lista-contatos', function () {
    return view('contato');
});


Route::get('/teste', function () {
    return view('teste');
});
