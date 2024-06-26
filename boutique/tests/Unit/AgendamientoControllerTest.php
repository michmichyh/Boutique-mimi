<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Agendamiento;
use App\Models\Cliente;
use App\Models\Empleado;

class AgendamientoControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_can_list_agendamientos()
    {
        Agendamiento::factory()->create();

        $response = $this->getJson('/api/agendamientos');

        $response->assertStatus(200);
        // Aquí puedes agregar más validaciones según la estructura esperada de la respuesta
    }

    public function test_it_can_create_an_agendamiento()
    {
        $cliente = Cliente::factory()->create();
        $empleado = Empleado::factory()->create();
        $data = [
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
            'fecha_hora' => now()->addDays(7)->format('Y-m-d H:i:s'),
        ];

        $response = $this->postJson('/api/agendamientos', $data);

        $response->assertStatus(201);
        // Aquí puedes agregar más validaciones según la estructura esperada de la respuesta
    }

    public function test_it_validates_data_when_creating_an_agendamiento()
    {
        $response = $this->postJson('/api/agendamientos', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['cliente_id', 'empleado_id', 'fecha_hora']);
    }
}