<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $clientes = Cliente::where('email', $request->email)->first();

        if (!$clientes || !Hash::check($request->password, $clientes->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas. Por favor, verifica tu email y contraseña.',
                'status' => 401
            ], 401);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'Cliente' => $clientes,
            'status' => 200
        ], 200);
    }
    public function index() 
    { 
        $clientes = Cliente::all();

        if ($clientes->isEmpty()) {
            $data = [
                'message' => 'No hay clientes',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($clientes, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'telefono' => 'required|max:255',
            'email' => 'required|email|unique:clientes',
            'direccion' => 'required|max:255',
            'password' => 'required|max:15',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Encriptar la contraseña
        $passwordHashed = Hash::make($request->password);

        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'password' => $passwordHashed,
        ]);

        if (!$cliente) {
            $data = [
                'message' => 'Error al crear el cliente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'cliente' => $cliente,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'cliente' => $cliente,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $cliente->delete();

        $data = [
            'message' => 'Cliente eliminado correctamente',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'telefono' => 'required|max:255',
            'email' => 'required|email|unique:clientes,email,'.$id,
            'direccion' => 'required|max:255',
            'password' => 'required|max:15',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $cliente->nombre = $request->nombre;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->password = Hash::make($request->password); // Encriptar la contraseña

        $cliente->save();

        $data = [
            'message' => 'Cliente actualizado',
            'cliente' => $cliente,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'telefono' => 'max:255',
            'email' => 'email|unique:clientes,email,'.$id,
            'direccion' => 'max:255',
            'password' => 'max:15',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $cliente->nombre = $request->nombre;
        }

        if ($request->has('telefono')) {
            $cliente->telefono = $request->telefono;
        }

        if ($request->has('email')) {
            $cliente->email = $request->email;
        }

        if ($request->has('direccion')) {
            $cliente->direccion = $request->direccion;
        }

        if ($request->has('password')) {
            $cliente->password = Hash::make($request->password); // Encriptar la contraseña
        }

        $cliente->save();

        $data = [
            'message' => 'Cliente actualizado parcialmente',
            'cliente' => $cliente,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
?>