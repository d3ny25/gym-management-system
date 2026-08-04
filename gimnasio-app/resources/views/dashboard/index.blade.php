@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Clientes</h3>
            <p class="text-3xl font-bold mt-2">{{ $clientesCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Membresías</h3>
            <p class="text-3xl font-bold mt-2">{{ $membresiasCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Inscripciones</h3>
            <p class="text-3xl font-bold mt-2">{{ $inscripcionesCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Pagos</h3>
            <p class="text-3xl font-bold mt-2">{{ $pagosCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium">Usuarios</h3>
            <p class="text-3xl font-bold mt-2">{{ $usuariosCount }}</p>
        </div>
    </div>
</div>
@endsection
