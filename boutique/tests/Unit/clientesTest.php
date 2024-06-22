<?php

namespace Tests\Unit;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VentaControllerTest extends TestCase
{
    use RefreshDatabase;

   
    public function test_get()
    {
        
        $cliente = Cliente::factory()->create();

       
        $response = $this->get('api/clientes');

      
        $response->assertStatus(200);

    
    }
}
