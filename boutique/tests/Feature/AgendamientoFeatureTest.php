<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Agendamiento;
use App\Models\Cliente;
use App\Models\Empleado;

class AgendamientoFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para listar agendamientos.
     *
     * @return void
     */
    public function test_can_list_agendamientos()
    {
        $response = $this->get('/api/Agendamiento');

        $response->assertStatus(200);
        // Puedes agregar más aserciones según la estructura de tu respuesta JSON
    }

    /**
     * Test para crear un agendamiento válido.
     *
     * @return void
     */
    public function test_can_create_agendamiento()
    {
        $cliente = Cliente::factory()->create();
        $empleado = Empleado::factory()->create();

        $data = [
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
            'fecha_hora' => now()->addDay(),
        ];

        $response = $this->postJson('/api/Agendamiento', $data);

        $response->assertStatus(201);
        // Puedes agregar más aserciones según la estructura de tu respuesta JSON
    }

    /**
     * Test para validar datos al crear un agendamiento.
     *
     * @return void
     */
    public function test_validates_data_when_creating_agendamiento()
    {
        $$data = []; // Datos incompletos para forzar error de validación

        $response = $this->postJson('/api/Agendamiento', $data);
    
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['cliente_id', 'empleado_id', 'fecha_hora']);
    }
    }
