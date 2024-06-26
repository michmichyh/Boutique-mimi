<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Agendamiento;
use App\Models\Cliente;
use App\Models\Empleado;

class AgendamientoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_agendamiento_if_valid_data_is_provided()
    {
        // Crear un cliente y un empleado de prueba
        $cliente = Cliente::factory()->create();
        $empleado = Empleado::factory()->create();

        // Datos del agendamiento a crear
        $agendamientoData = [
            'cliente_id' => $cliente->id,
            'empleado_id' => $empleado->id,
            'fecha_hora' => '2024-06-30 10:00:00',
        ];

        // Hacer una solicitud POST al endpoint del controlador
        $response = $this->postJson('/api/agendamientos', $agendamientoData);

        // Verificar que la respuesta sea exitosa (código 201)
        $response->assertStatus(201);

        // Verificar que el agendamiento se haya creado en la base de datos
        $this->assertDatabaseHas('agendamientos', $agendamientoData);
    }

    /** @test */
    public function it_returns_validation_error_if_invalid_data_is_provided()
    {
        // Datos inválidos (cliente_id y empleado_id no existentes)
        $invalidData = [
            'cliente_id' => 999, // Cliente ID inválido (que no existe)
            'empleado_id' => 123, // Empleado ID inválido (que no existe)
            'fecha_hora' => 'invalid_date_format', // Formato de fecha inválido
        ];

        // Hacer una solicitud POST al endpoint del controlador con datos inválidos
        $response = $this->postJson('/api/agendamientos', $invalidData);

        // Verificar que la respuesta sea un error de validación (código 400)
        $response->assertStatus(400)
                 ->assertJson([
                     'message' => 'Error en la validación de los datos',
                     // Puedes agregar más detalles según los errores específicos esperados
                 ]);

        // Verificar que el agendamiento no se haya creado en la base de datos
        $this->assertDatabaseMissing('agendamientos', $invalidData);
    }
}
