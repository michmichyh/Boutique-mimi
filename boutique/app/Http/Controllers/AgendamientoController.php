<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Agendamiento;
use Illuminate\Http\Request;

class AgendamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamientos = Agendamiento::all();

        $data = [
            'agendamientos' => $agendamientos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_hora' => 'required|date',
        ]);

        // Si la validación falla, retorna los errores en formato JSON
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Creación del agendamiento
        $agendamiento = Agendamiento::create([
            'cliente_id' => $request->cliente_id,
            'empleado_id' => $request->empleado_id,
            'fecha_hora' => $request->fecha_hora,
        ]);

        // Verificar si se creó correctamente el agendamiento
        if (!$agendamiento) {
            $data = [
                'message' => 'Error al crear el agendamiento',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'agendamiento' => $agendamiento,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
};