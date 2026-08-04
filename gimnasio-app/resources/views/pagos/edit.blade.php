@extends('layouts.app')
@section('title','Editar Pago')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Editar Pago</h2>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.update', ['pago' => $pago->id_pago]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Inscripción</label><select name="id_inscripcion" class="mt-1 block w-full border rounded px-3 py-2" required><option value="">--</option>@foreach($inscripciones as $inscripcion)<option value="{{ $inscripcion->id_inscripcion }}" {{ old('id_inscripcion', $pago->id_inscripcion)==$inscripcion->id_inscripcion ? 'selected' : '' }}>#{{ $inscripcion->id_inscripcion }} - {{ $inscripcion->cliente?->nombre ?? 'Cliente' }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium">Fecha de pago</label><input type="date" name="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium">Monto</label><input type="number" step="0.01" min="0" name="monto" value="{{ old('monto', $pago->monto) }}" class="mt-1 block w-full border rounded px-3 py-2" required></div>
            <div><label class="block text-sm font-medium">Método de pago</label><select name="metodo_pago" class="mt-1 block w-full border rounded px-3 py-2"><option value="Efectivo" {{ old('metodo_pago', $pago->metodo_pago)=='Efectivo' ? 'selected' : '' }}>Efectivo</option><option value="Transferencia" {{ old('metodo_pago', $pago->metodo_pago)=='Transferencia' ? 'selected' : '' }}>Transferencia</option><option value="Tarjeta" {{ old('metodo_pago', $pago->metodo_pago)=='Tarjeta' ? 'selected' : '' }}>Tarjeta</option></select></div>
        </div>
        <div><label class="block text-sm font-medium">Estado</label><select name="estado" class="mt-1 block w-full border rounded px-3 py-2"><option value="Pagado" {{ old('estado', $pago->estado)=='Pagado' ? 'selected' : '' }}>Pagado</option><option value="Pendiente" {{ old('estado', $pago->estado)=='Pendiente' ? 'selected' : '' }}>Pendiente</option><option value="Cancelado" {{ old('estado', $pago->estado)=='Cancelado' ? 'selected' : '' }}>Cancelado</option></select></div>
        <div class="flex items-center space-x-2"><button type="submit" class="px-4 py-2 rounded text-white" style="background-color:#3B82F6">Actualizar</button><a href="{{ route('pagos.index') }}" class="px-4 py-2 rounded border">Cancelar</a></div>
    </form>
</div>
@endsection
