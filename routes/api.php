<?php

use App\Http\Controllers\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/pegarUsuarios', [Usuarios::class, 'view'])->name('usuarios');
Route::post('/usuarios', [Usuarios::class, 'create'])->name('usuarios.create');
Route::put('/usuarios/{usuario}', [Usuarios::class, 'update'])->name('usuarios.create');
Route::delete('/usuarios/{usuario}', [Usuarios::class, 'destroy'])->name('usuarios.create');