<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('correo')->unique();
            $table->string('contrasena');
            $table->string('rol')->default('empleado');
            $table->string('estado')->default('activo');
        });

        Schema::create('membresias', function (Blueprint $table) {
            $table->id('id_membresia');
            $table->string('nombre');
            $table->integer('duracion_meses');
            $table->decimal('precio', 10, 2);
            $table->text('descripcion')->nullable();
            $table->string('estado')->default('activa');
        });

        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente');
            $table->foreignId('id_membresia')->constrained('membresias', 'id_membresia');
            $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('estado')->default('activa');
        });

        Schema::create('pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->foreignId('id_inscripcion')->constrained('inscripciones', 'id_inscripcion');
            $table->date('fecha_pago');
            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago')->nullable();
            $table->string('estado')->default('pendiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('inscripciones');
        Schema::dropIfExists('membresias');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('clientes');
    }
};
