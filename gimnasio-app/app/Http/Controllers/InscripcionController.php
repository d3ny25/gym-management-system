<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Inscripcion;
use App\Models\Membresia;
use App\Models\Usuario;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['cliente', 'membresia', 'usuario'])->orderBy('fecha_inicio', 'desc')->paginate(15);
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $membresias = Membresia::orderBy('nombre')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('inscripciones.create', compact('clientes', 'membresias', 'usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_membresia' => 'required|exists:membresias,id_membresia',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:Activa,Finalizada,Cancelada',
        ]);

        Inscripcion::create($data);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada correctamente.');
    }

    public function show(Inscripcion $inscripcione)
    {
        $inscripcione->load(['cliente', 'membresia', 'usuario', 'pagos']);
        return view('inscripciones.show', compact('inscripcione'));
    }

    public function edit(Inscripcion $inscripcione)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $membresias = Membresia::orderBy('nombre')->get();
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('inscripciones.edit', compact('inscripcione', 'clientes', 'membresias', 'usuarios'));
    }

    public function update(Request $request, Inscripcion $inscripcione)
    {
        $data = $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_membresia' => 'required|exists:membresias,id_membresia',
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:Activa,Finalizada,Cancelada',
        ]);

        $inscripcione->update($data);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(Inscripcion $inscripcione)
    {
        $inscripcione->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada correctamente.');
    }
}
