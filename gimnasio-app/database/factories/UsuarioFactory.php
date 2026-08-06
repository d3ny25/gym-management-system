<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        $nombres = ['Juan', 'Carlos', 'María', 'Guadalupe', 'José', 'Antonio', 'Miguel', 'Fernando', 'Roberto', 'Daniel', 'Alejandro', 'Jorge', 'Luis', 'Francisco', 'Ricardo', 'David', 'Eduardo', 'Sergio', 'Omar', 'Rafael'];
        $apellidos = ['García', 'López', 'Martínez', 'González', 'Rodríguez', 'Hernández', 'Pérez', 'Sánchez', 'Ramírez', 'Flores', 'Torres', 'Rivera', 'Gómez', 'Díaz', 'Reyes', 'Cruz', 'Morales', 'Ortiz', 'Jiménez', 'Castillo'];

        return [
            'nombre' => fake()->randomElement($nombres),
            'apellido_paterno' => fake()->randomElement($apellidos),
            'apellido_materno' => fake()->randomElement($apellidos),
            'correo' => fake()->unique()->safeEmail(),
            'contrasena' => bcrypt('password'),
            'rol' => fake()->randomElement(['Administrador', 'Recepcionista']),
            'estado' => fake()->randomElement(['activo', 'inactivo']),
        ];
    }
}
