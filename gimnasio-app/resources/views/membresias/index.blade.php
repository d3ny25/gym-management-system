@extends('layouts.app')
@section('title','Membresías')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Membresías</h2>
        <a href="{{ route('membresias.create') }}" class="px-4 py-2 rounded text-white" style="background-color:#22C55E">Nueva membresía</a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left text-sm text-gray-600">
                    <th class="p-2">ID</th>
                    <th class="p-2">Nombre</th>
                    <th class="p-2">Duración</th>
                    <th class="p-2">Precio</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($membresias as $membresia)
                    <tr class="border-t">
                        <td class="p-2">{{ $membresia->id_membresia }}</td>
                        <td class="p-2">{{ $membresia->nombre }}</td>
                        <td class="p-2">{{ $membresia->duracion_meses }} meses</td>
                        <td class="p-2">${{ number_format($membresia->precio, 2) }}</td>
                        <td class="p-2">{{ $membresia->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('membresias.show', $membresia) }}" class="px-2 py-1 rounded text-sm" style="background-color:#3B82F6;color:white">Ver</a>
                            <a href="{{ route('membresias.edit', $membresia) }}" class="px-2 py-1 rounded text-sm" style="background-color:#3B82F6;color:white">Editar</a>
                            <form action="{{ route('membresias.destroy', $membresia) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar membresía?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded text-sm" style="background-color:#EF4444;color:white">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-4 text-gray-600">No hay membresías registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $membresias->links() }}</div>
</div>
@endsection
