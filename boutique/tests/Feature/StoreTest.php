<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Agendamiento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendamientoControllerStoreTest extends TestCase
{
    use RefreshDatabase; // Para resetear la base de datos después de cada prueba

    /** @test */
    public function it_creates_a_new_agendamiento()
    {
        // Datos simulados para crear un agendamiento
        $data = [ 
            'cliente_id' => 1, // Debe existir un cliente con ID 1 en la base de datos
            'empleado_id' => 1, // Debe existir un empleado con ID 1 en la base de datos
            'fecha_hora' => '2024-06-30 10:00:00', // Fecha y hora válida
        ];

        // Realizar la solicitud POST para crear un agendamiento
        $response = $this->post('/api/Agendamiento', $data);

        // Verificar que la solicitud fue exitosa (status 201 - Created)
        $response->assertStatus(201);

        // Verificar que el agendamiento se haya creado correctamente
        $this->assertDatabaseHas('agendamientos', $data);
    }

    /** @test */
    public function it_requires_cliente_id_empleado_id_and_fecha_hora_to_create_agendamiento()
    {
        // Datos faltantes para crear un agendamiento
        $data = [];

        // Realizar la solicitud POST con datos faltantes
        $response = $this->post('/api/Agendamiento', $data);

        // Verificar que la solicitud falle debido a la validación (status 400 - Bad Request)
        $response->assertStatus(400);

        // Verificar que se devuelva el mensaje de error adecuado
        $response->assertJsonFragment([
            'message' => 'Error en la validación de los datos'
        ]);
    }
}
