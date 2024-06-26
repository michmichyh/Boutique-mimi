<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendamientoController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\EmpleadoController;

Route::get('/Cliente', [ClienteController::class , 'index'] );

Route::post('/Cliente', [ClienteController::class, 'store']);

Route::get('/Agendamiento', [AgendamientoController::class , 'index'] );

Route::post('/Agendamiento', [AgendamientoController::class, 'store']);

Route::delete('/agendamiento/{id}', [AgendamientoController::class, 'destroy']);
 
Route::get('/Empleado', [EmpleadoController::class , 'index']);
Route::post('/Empleado', [EmpleadoController::class , 'index']);
