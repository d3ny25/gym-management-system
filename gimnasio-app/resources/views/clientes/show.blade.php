@extends('layouts.app')
@section('title','Ver Cliente')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Cliente: {{ $cliente->nombre }} {{ $cliente->apellido_paterno }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h3 class="text-sm font-medium text-gray-600">Teléfono</h3>
            <p class="mt-1">{{ $cliente->telefono }}</p>
        </div>
        <div>
            <h3 class="text-sm font-medium text-gray-600">Correo</h3>
            <p class="mt-1">{{ $cliente->correo }}</p>
        </div>
        <div>
            <h3 class="text-sm font-medium text-gray-600">Fecha de Nacimiento</h3>
            <p class="mt-1">{{ $cliente->fecha_nacimiento }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h3 class="text-sm font-medium text-gray-600">Dirección</h3>
        <p class="mt-1">{{ $cliente->direccion }}</p>
    </div>

    <div class="mt-6 flex items-center space-x-2">
        <a href="{{ route('clientes.edit', $cliente) }}" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Editar</a>
        <a href="{{ route('clientes.index') }}" class="px-4 py-2 rounded border">Volver</a>
    </div>
</div>
@endsection
