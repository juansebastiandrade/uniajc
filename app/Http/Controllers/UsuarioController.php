<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id_usuario', 'desc')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:usuario,username',
            'password' => 'required|string|min:8',
            'rol' => 'required|in:admin,vendedor,supervisor',
            'activo' => 'required|boolean',
            'id_empresa' => 'nullable|integer',
        ]);

        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'rol' => $request->rol,
            'activo' => $request->activo,
            'fecha_creacion' => now(),
            'id_empresa' => $request->id_empresa,
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('usuario', 'username')
                    ->ignore($usuario->id_usuario, 'id_usuario'),
            ],
            'password' => 'nullable|string|min:8',
            'rol' => 'required|in:admin,vendedor,supervisor',
            'activo' => 'required|boolean',
            'id_empresa' => 'nullable|integer',
        ]);

        $datos = $request->only([
            'username',
            'rol',
            'activo',
            'id_empresa',
        ]);

        if ($request->filled('password')) {
            $datos['password'] = $request->password;
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}