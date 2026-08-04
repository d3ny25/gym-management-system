@extends('layouts.app')
@section('title','Crear Inscripción')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Crear Inscripción</h2>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inscripciones.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Cliente</label><select name="id_cliente" class="mt-1 block w-full border rounded px-3 py-2" required><option value="">--</option>@foreach($clientes as $cliente)<option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} {{ $cliente->apellido_paterno }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium">Membresía</label><select name="id_membresia" class="mt-1 block w-full border rounded px-3 py-2" required><option value="">--</option>@foreach($membresias as $membresia)<option value="{{ $membresia->id_membresia }}">{{ $membresia->nombre }}</option>@endforeach</select></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Usuario</label><select name="id_usuario" class="mt-1 block w-full border rounded px-3 py-2" required><option value="">--</option>@foreach($usuarios as $usuario)<option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium">Estado</label><select name="estado" class="mt-1 block w-full border rounded px-3 py-2"><option value="Activa">Activa</option><option value="Finalizada">Finalizada</option><option value="Cancelada">Cancelada</option></select></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Fecha Inicio</label><input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
            <div><label class="block text-sm font-medium">Fecha Fin</label><input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" class="mt-1 block w-full border rounded px-3 py-2"></div>
        </div>
        <div class="flex items-center space-x-2"><button type="submit" class="px-4 py-2 rounded text-white" style="background-color:#22C55E">Guardar</button><a href="{{ route('inscripciones.index') }}" class="px-4 py-2 rounded border">Cancelar</a></div>
    </form>
</div>
@endsection
