<?php

use App\Http\Controllers\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/pegarUsuarios', [Usuarios::class, 'view']);
Route::post('/usuarios', [Usuarios::class, 'create']);
Route::get('/usuarioPerfil/{id}', [Usuarios::class, 'viewUsuario']);
Route::put('/usuarios/{usuario}', [Usuarios::class, 'update']);
Route::delete('/usuarios/{usuario}', [Usuarios::class, 'destroy']);