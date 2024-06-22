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
    public function destroy($id)
{
    try {
        // Verificar que se está recibiendo el ID correctamente
        dd($id); // O var_dump($id);

        // Intentar encontrar el agendamiento por su ID
        $agendamiento = Agendamiento::findOrFail($id);

        // Eliminar el agendamiento
        $agendamiento->delete();

        // Preparar la respuesta con el mensaje de eliminación y el estado HTTP
        $data = [
            'message' => 'Agendamiento eliminado',
            'status' => 200
        ];

        // Retornar la respuesta en formato JSON
        return response()->json($data, 200);
    } catch (\Exception $e) {
        // Si hay un error, retornar el error 404
        $data = [
            'message' => 'Agendamiento no encontrado',
            'status' => 404,
            'error' => $e->getMessage() // Agregar esto para ver el mensaje de error real
        ];
        return response()->json($data, 404);
    }
}
    };