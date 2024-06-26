<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Agendamiento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendamientoControllerIndexTest extends TestCase
{
    use RefreshDatabase; // Para resetear la base de datos después de cada prueba

    /** @test */
    public function it_returns_all_agendamientos()
    {
        // Crear algunos agendamientos de prueba en la base de datos
        Agendamiento::factory()->count(3)->create();

        // Realizar la solicitud GET para obtener todos los agendamientos
        $response = $this->get('/api/agendamientos');

        // Verificar que la solicitud fue exitosa (status 200 - OK)
        $response->assertStatus(200);

        // Verificar que se devuelva la cantidad correcta de agendamientos en formato JSON
        $response->assertJsonCount(3, 'data.agendamientos');
    }
}
