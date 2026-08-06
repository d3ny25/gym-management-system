<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        $nombres = ['Juan', 'Carlos', 'María', 'Guadalupe', 'José', 'Antonio', 'Miguel', 'Fernando', 'Roberto', 'Daniel', 'Alejandro', 'Jorge', 'Luis', 'Francisco', 'Ricardo', 'David', 'Eduardo', 'Sergio', 'Omar', 'Rafael'];
        $apellidos = ['García', 'López', 'Martínez', 'González', 'Rodríguez', 'Hernández', 'Pérez', 'Sánchez', 'Ramírez', 'Flores', 'Torres', 'Rivera', 'Gómez', 'Díaz', 'Reyes', 'Cruz', 'Morales', 'Ortiz', 'Jiménez', 'Castillo'];
        $ladas = ['55', '33', '81', '44', '22', '66', '77', '33', '81', '55'];

        return [
            'nombre' => fake()->randomElement($nombres),
            'apellido_paterno' => fake()->randomElement($apellidos),
            'apellido_materno' => fake()->randomElement($apellidos),
            'fecha_nacimiento' => fake()->date('Y-m-d', '-18 years'),
            'telefono' => fake()->randomElement($ladas) . fake()->numerify('#######'),
            'correo' => fake()->unique()->safeEmail(),
            'direccion' => fake()->address(),
        ];
    }
}
