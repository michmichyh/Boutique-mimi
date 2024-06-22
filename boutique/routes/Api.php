<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendamientoController;
use App\Http\Controllers\EmpleadoController;

///Route::get('/Clientes', function () {
    ///return 'clientes';
///});


///Route::post('/Clientes', function () {
    ///return 'clientes';
///});


Route::get('/Agendamientos', [AgendamientoController::class , 'index'] );

Route::post('/Agendamientos', [AgendamientoController::class, 'store']);

Route::delete('/agendamientos/{id}', [AgendamientoController::class, 'destroy']);
 
Route::get('/Empleados', [EmpleadoController::class , 'index']);
