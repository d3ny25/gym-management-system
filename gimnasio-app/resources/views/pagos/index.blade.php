@extends('layouts.app')
@section('title','Pagos')
@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Pagos</h2>
        <a href="{{ route('pagos.create') }}" class="px-4 py-2 rounded text-white" style="background-color:#22C55E">Nuevo pago</a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left text-sm text-gray-600">
                    <th class="p-2">ID</th>
                    <th class="p-2">Inscripción</th>
                    <th class="p-2">Fecha</th>
                    <th class="p-2">Monto</th>
                    <th class="p-2">Método</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagos as $pago)
                    <tr class="border-t">
                        <td class="p-2">{{ $pago->id_pago }}</td>
                        <td class="p-2">{{ trim(($pago->inscripcion?->cliente?->nombre ?? '') . ' ' . ($pago->inscripcion?->cliente?->apellido_paterno ?? '') . ' ' . ($pago->inscripcion?->cliente?->apellido_materno ?? '')) ?: 'Sin cliente' }}</td>
                        <td class="p-2">{{ $pago->fecha_pago }}</td>
                        <td class="p-2">${{ number_format($pago->monto, 2) }}</td>
                        <td class="p-2">{{ $pago->metodo_pago }}</td>
                        <td class="p-2">{{ $pago->estado }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('pagos.show', ['pago' => $pago->id_pago]) }}" class="px-2 py-1 rounded text-sm" style="background-color:#3B82F6;color:white">Ver</a>
                            <a href="{{ route('pagos.edit', ['pago' => $pago->id_pago]) }}" class="px-2 py-1 rounded text-sm" style="background-color:#3B82F6;color:white">Editar</a>
                            <form action="{{ route('pagos.destroy', ['pago' => $pago->id_pago]) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar pago?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded text-sm" style="background-color:#EF4444;color:white">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-4 text-gray-600">No hay pagos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $pagos->links() }}</div>
</div>
@endsection
