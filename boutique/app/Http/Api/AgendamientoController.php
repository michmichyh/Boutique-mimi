<?php

namespace App\Http\Controllers;

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
        return view('agendamientos.index', compact('agendamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Aquí puedes cargar los clientes y empleados disponibles para la agenda
        $clientes = \App\Models\Cliente::all();
        $empleados = \App\Models\Empleado::all();
        
        return view('agendamientos.create', compact('clientes', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_hora' => 'required|date',
        ]);

        Agendamiento::create($request->all());

        return redirect()->route('agendamientos.index')
            ->with('success', 'Agendamiento creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agendamiento  $agendamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamiento $agendamiento)
    {
        return view('agendamientos.show', compact('agendamiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agendamiento  $agendamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamiento $agendamiento)
    {
        // Aquí también cargas los clientes y empleados disponibles para la edición
        $clientes = \App\Models\Cliente::all();
        $empleados = \App\Models\Empleado::all();
        
        return view('agendamientos.edit', compact('agendamiento', 'clientes', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agendamiento  $agendamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamiento $agendamiento)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_hora' => 'required|date',
        ]);

        $agendamiento->update($request->all());

        return redirect()->route('agendamientos.index')
            ->with('success', 'Agendamiento actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agendamiento  $agendamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamiento $agendamiento)
    {
        $agendamiento->delete();

        return redirect()->route('agendamientos.index')
            ->with('success', 'Agendamiento eliminado satisfactoriamente.');
    }
}
