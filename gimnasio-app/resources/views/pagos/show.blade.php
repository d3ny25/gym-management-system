@extends('layouts.app')
@section('title','Ver Pago')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Pago #{{ $pago->id_pago }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><h3 class="text-sm font-medium text-gray-600">Inscripción</h3><p class="mt-1">#{{ $pago->id_inscripcion }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Fecha de Pago</h3><p class="mt-1">{{ $pago->fecha_pago }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Monto</h3><p class="mt-1">${{ number_format($pago->monto, 2) }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Método de Pago</h3><p class="mt-1">{{ $pago->metodo_pago }}</p></div>
        <div><h3 class="text-sm font-medium text-gray-600">Estado</h3><p class="mt-1">{{ $pago->estado }}</p></div>
    </div>
    <div class="mt-6 flex items-center space-x-2"><a href="{{ route('pagos.edit', ['pago' => $pago->id_pago]) }}" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Editar</a><a href="{{ route('pagos.index') }}" class="px-4 py-2 rounded border">Volver</a></div>
</div>
@endsection
