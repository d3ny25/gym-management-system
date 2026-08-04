<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PagoController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('membresias', MembresiaController::class);
Route::resource('inscripciones', InscripcionController::class);
Route::resource('pagos', PagoController::class);

