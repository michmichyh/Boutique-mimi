<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

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
