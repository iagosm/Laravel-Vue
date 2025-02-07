<?php

use App\Http\Controllers\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/usuarios', [Usuarios::class, 'view'])->name('usuarios');
Route::post('/usuarios', [Usuarios::class, 'create'])->name('usuarios.create');