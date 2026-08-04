<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('inscripcion')->orderBy('fecha_pago', 'desc')->paginate(15);
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $inscripciones = Inscripcion::with(['cliente', 'membresia'])->get();
        return view('pagos.create', compact('inscripciones'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_inscripcion' => 'required|exists:inscripciones,id_inscripcion',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:Efectivo,Tarjeta,Transferencia',
            'estado' => 'required|in:Pagado,Pendiente,Cancelado',
        ]);

        Pago::create($data);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

    public function show(Pago $pago)
    {
        $pago->load('inscripcion');
        return view('pagos.show', compact('pago'));
    }

    public function edit(Pago $pago)
    {
        $inscripciones = Inscripcion::with(['cliente', 'membresia'])->get();
        return view('pagos.edit', compact('pago', 'inscripciones'));
    }

    public function update(Request $request, Pago $pago)
    {
        $data = $request->validate([
            'id_inscripcion' => 'required|exists:inscripciones,id_inscripcion',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:Efectivo,Tarjeta,Transferencia',
            'estado' => 'required|in:Pagado,Pendiente,Cancelado',
        ]);

        $pago->update($data);

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
    }
}
