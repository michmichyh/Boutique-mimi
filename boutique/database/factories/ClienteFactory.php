<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            // Define aquí los campos y valores que deseas generar para pruebas
            'nombre' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            // Otros campos necesarios
        ];
    }
}
