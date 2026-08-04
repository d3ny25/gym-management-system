@extends('layouts.app')
@section('title','Ver Membresía')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Membresía: {{ $membresia->nombre }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><h3 class="text-sm font-medium text-gray-600">Duración</h3><p class="mt-1">{{ $membresia->duracion_meses }} meses</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Precio</h3><p class="mt-1">${{ number_format($membresia->precio, 2) }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Estado</h3><p class="mt-1">{{ $membresia->estado ? 'Activo' : 'Inactivo' }}</p></div>
    </div>
    <div class="mt-4"><h3 class="text-sm font-medium text-gray-600">Descripción</h3><p class="mt-1">{{ $membresia->descripcion }}</p></div>
    <div class="mt-6 flex items-center space-x-2"><a href="{{ route('membresias.edit', $membresia) }}" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Editar</a><a href="{{ route('membresias.index') }}" class="px-4 py-2 rounded border">Volver</a></div>
</div>
@endsection
