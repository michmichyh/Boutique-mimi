<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();

        if ($empleados->isEmpty()) {
            $data = [
                'message' => 'No hay empleados',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($empleados, 200);
    }
}
