@extends('layouts.app')
@section('title','Editar Cliente')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Editar Cliente</h2>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Nombre</label>
            <input name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="mt-1 block w-full border rounded px-3 py-2" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Apellido Paterno</label>
                <input name="apellido_paterno" value="{{ old('apellido_paterno', $cliente->apellido_paterno) }}" class="mt-1 block w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Apellido Materno</label>
                <input name="apellido_materno" value="{{ old('apellido_materno', $cliente->apellido_materno) }}" class="mt-1 block w-full border rounded px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" class="mt-1 block w-full border rounded px-3 py-2">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Teléfono</label>
                <input name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="mt-1 block w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Correo</label>
                <input type="email" name="correo" value="{{ old('correo', $cliente->correo) }}" class="mt-1 block w-full border rounded px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium">Dirección</label>
            <textarea name="direccion" class="mt-1 block w-full border rounded px-3 py-2">{{ old('direccion', $cliente->direccion) }}</textarea>
        </div>

        <div class="flex items-center space-x-2">
            <button type="submit" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Actualizar</button>
            <a href="{{ route('clientes.index') }}" class="px-4 py-2 rounded border">Cancelar</a>
        </div>
    </form>
</div>
@endsection
