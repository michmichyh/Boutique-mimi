<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendamientoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;

//Route::get('/Cliente', [ClienteController::class , 'index'] );

//Route::post('/Cliente', [ClienteController::class , 'store'] );

Route::get('/Agendamiento', [AgendamientoController::class , 'index'] );

Route::post('/Agendamiento', [AgendamientoController::class, 'store']);
 
Route::get('/Empleados', [EmpleadoController::class , 'index']);
