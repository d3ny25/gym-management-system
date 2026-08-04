@extends('layouts.app')
@section('title','Editar Membresía')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Editar Membresía</h2>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('membresias.update', $membresia) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Nombre</label><input name="nombre" value="{{ old('nombre', $membresia->nombre) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
            <div><label class="block text-sm font-medium">Duración (meses)</label><input type="number" min="1" name="duracion_meses" value="{{ old('duracion_meses', $membresia->duracion_meses) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Precio</label><input type="number" step="0.01" min="0" name="precio" value="{{ old('precio', $membresia->precio) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
            <div><label class="block text-sm font-medium">Estado</label><select name="estado" class="mt-1 block w-full border rounded px-3 py-2"><option value="1" {{ old('estado', $membresia->estado)=='1' ? 'selected' : '' }}>Activo</option><option value="0" {{ old('estado', $membresia->estado)=='0' ? 'selected' : '' }}>Inactivo</option></select></div>
        </div>
        <div><label class="block text-sm font-medium">Descripción</label><textarea name="descripcion" class="mt-1 block w-full border rounded px-3 py-2">{{ old('descripcion', $membresia->descripcion) }}</textarea></div>
        <div class="flex items-center space-x-2"><button type="submit" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Actualizar</button><a href="{{ route('membresias.index') }}" class="px-4 py-2 rounded border">Cancelar</a></div>
    </form>
</div>
@endsection
