@extends('layouts.app')
@section('title','Usuarios')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Usuarios</h2>
        <a href="{{ route('usuarios.create') }}" class="px-4 py-2 rounded text-white" style="background-color:#22C55E">Nuevo usuario</a>
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
                    <th class="p-2">Correo</th>
                    <th class="p-2">Rol</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr class="border-t">
                        <td class="p-2">{{ $usuario->id_usuario }}</td>
                        <td class="p-2">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}</td>
                        <td class="p-2">{{ $usuario->correo }}</td>
                        <td class="p-2">{{ $usuario->rol }}</td>
                        <td class="p-2">{{ $usuario->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('usuarios.show', $usuario) }}" class="px-2 py-1 rounded text-sm" style="background-color:#3B82F6;color:white">Ver</a>
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="px-2 py-1 rounded text-sm" style="background-color:#3B82F6;color:white">Editar</a>
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded text-sm" style="background-color:#EF4444;color:white">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-4 text-gray-600">No hay usuarios registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $usuarios->links() }}</div>
</div>
@endsection
