@extends('layouts.app')
@section('title','Editar Usuario')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Editar Usuario</h2>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Nombre</label><input name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
            <div><label class="block text-sm font-medium">Apellido Paterno</label><input name="apellido_paterno" value="{{ old('apellido_paterno', $usuario->apellido_paterno) }}" class="mt-1 block w-full border rounded px-3 py-2"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Apellido Materno</label><input name="apellido_materno" value="{{ old('apellido_materno', $usuario->apellido_materno) }}" class="mt-1 block w-full border rounded px-3 py-2"></div>
            <div><label class="block text-sm font-medium">Correo</label><input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Contraseña</label><input type="password" name="contrasena" class="mt-1 block w-full border rounded px-3 py-2"></div>
            <div><label class="block text-sm font-medium">Rol</label><select name="rol" class="mt-1 block w-full border rounded px-3 py-2"><option value="Administrador" {{ old('rol', $usuario->rol)=='Administrador' ? 'selected' : '' }}>Administrador</option><option value="Recepcionista" {{ old('rol', $usuario->rol)=='Recepcionista' ? 'selected' : '' }}>Recepcionista</option></select></div>
        </div>
        <div><label class="block text-sm font-medium">Estado</label><select name="estado" class="mt-1 block w-full border rounded px-3 py-2"><option value="1" {{ old('estado', $usuario->estado)=='1' ? 'selected' : '' }}>Activo</option><option value="0" {{ old('estado', $usuario->estado)=='0' ? 'selected' : '' }}>Inactivo</option></select></div>
        <div class="flex items-center space-x-2"><button type="submit" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Actualizar</button><a href="{{ route('usuarios.index') }}" class="px-4 py-2 rounded border">Cancelar</a></div>
    </form>
</div>
@endsection
