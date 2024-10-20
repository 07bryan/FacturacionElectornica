<?php

use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;


Route::get('/usuarios', [UsuarioController::class, 'index']);

Route::get('/usuarios', [SectionsController::class, 'index'])
     ->name('usuarios.index');

Route::get('/usuarios/create', [UsuariosController::class, 'create'])
     ->name('usuarios.create');

Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'edit'])
     ->name('usuarios.edit');

Route::delete('/usuarios/delete/{id}', [UsuariosController::class, 'delete'])
     ->name('usuarios.delete');

Route::post('/usuarios/store', [UsuariosController::class, 'store'])
     ->name('usuarios.store');

Route::put('/usuarios/update', [UsuariosController::class, 'update'])
     ->name('usuarios.update');