@extends('layouts.app')
@section('title','Ver Inscripción')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Inscripción #{{ $inscripcione->id_inscripcion }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><h3 class="text-sm font-medium text-gray-600">Cliente</h3><p class="mt-1">{{ $inscripcione->cliente?->nombre ?? 'Sin cliente' }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Membresía</h3><p class="mt-1">{{ $inscripcione->membresia?->nombre ?? 'Sin membresía' }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Usuario</h3><p class="mt-1">{{ $inscripcione->usuario?->nombre ?? 'Sin usuario' }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Estado</h3><p class="mt-1">{{ $inscripcione->estado }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Fecha Inicio</h3><p class="mt-1">{{ $inscripcione->fecha_inicio }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Fecha Fin</h3><p class="mt-1">{{ $inscripcione->fecha_fin }}</p></div>
    </div>
    <div class="mt-6 flex items-center space-x-2"><a href="{{ route('inscripciones.edit', ['inscripcione' => $inscripcione->id_inscripcion]) }}" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Editar</a><a href="{{ route('inscripciones.index') }}" class="px-4 py-2 rounded border">Volver</a></div>
</div>
@endsection
