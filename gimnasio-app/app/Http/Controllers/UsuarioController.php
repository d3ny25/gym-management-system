<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('nombre')->paginate(15);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'nullable|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'correo' => 'required|email|max:100',
            'contrasena' => 'required|string|min:4|max:255',
            'rol' => 'required|in:Administrador,Recepcionista',
            'estado' => 'required|boolean',
        ]);

        $data['contrasena'] = bcrypt($data['contrasena']);

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'nullable|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'correo' => 'required|email|max:100',
            'contrasena' => 'nullable|string|min:4|max:255',
            'rol' => 'required|in:Administrador,Recepcionista',
            'estado' => 'required|boolean',
        ]);

        if (!empty($data['contrasena'])) {
            $data['contrasena'] = bcrypt($data['contrasena']);
        } else {
            unset($data['contrasena']);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
