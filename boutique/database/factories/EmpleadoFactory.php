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
            'nombre' => $this->faker->name,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'descripcion' => $this->faker->sentence,
        ];
    }
}