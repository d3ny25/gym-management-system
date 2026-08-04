<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use Illuminate\Http\Request;

class MembresiaController extends Controller
{
    public function index()
    {
        $membresias = Membresia::orderBy('nombre')->paginate(15);
        return view('membresias.index', compact('membresias'));
    }

    public function create()
    {
        return view('membresias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'duracion_meses' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:150',
            'estado' => 'required|boolean',
        ]);

        Membresia::create($data);

        return redirect()->route('membresias.index')->with('success', 'Membresía creada correctamente.');
    }

    public function show(Membresia $membresia)
    {
        return view('membresias.show', compact('membresia'));
    }

    public function edit(Membresia $membresia)
    {
        return view('membresias.edit', compact('membresia'));
    }

    public function update(Request $request, Membresia $membresia)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'duracion_meses' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string|max:150',
            'estado' => 'required|boolean',
        ]);

        $membresia->update($data);

        return redirect()->route('membresias.index')->with('success', 'Membresía actualizada correctamente.');
    }

    public function destroy(Membresia $membresia)
    {
        $membresia->delete();
        return redirect()->route('membresias.index')->with('success', 'Membresía eliminada correctamente.');
    }
}
