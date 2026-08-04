@extends('layouts.app')
@section('title','Ver Usuario')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Usuario: {{ $usuario->nombre }} {{ $usuario->apellido_paterno }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><h3 class="text-sm font-medium text-gray-600">Correo</h3><p class="mt-1">{{ $usuario->correo }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Rol</h3><p class="mt-1">{{ $usuario->rol }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Estado</h3><p class="mt-1">{{ $usuario->estado ? 'Activo' : 'Inactivo' }}</p></div>
    </div>
    <div class="mt-6 flex items-center space-x-2"><a href="{{ route('usuarios.edit', $usuario) }}" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Editar</a><a href="{{ route('usuarios.index') }}" class="px-4 py-2 rounded border">Volver</a></div>
</div>
@endsection
