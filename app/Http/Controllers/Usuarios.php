<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Inertia\Inertia; // necessario para renderizar pagina dentro do vue

class Usuarios extends Controller
{
    public function view(Request $request)
    {
        $usuarios = Usuario::where('user_id', $request->user_id)->get();
        return response()->json($usuarios);
    }

    public function create(Request $request)
    {
        try{
            $validateRequest = $request->validate([
                'nome' => 'required|string|min:5',
                'email' => 'required|email|unique:usuarios,email',
                'telefone' => 'required|string',
                'descricao' => 'nullable|string|',
                'user_id' => 'required'
            ]);
            Usuario::create($validateRequest);
            return response()->json(['message' => 'Usuário cadastrado com sucesso'], 201);
        } catch(\Illuminate\Validation\ValidationException $error) {
            return response()->json([
                'erros' => $error->errors()
            ]);
        }
    }

    public function perfilUsuario() {
        return Inertia::render('Usuario/Perfil');
    }

    public function viewUsuario($id) {
        $usuario = Usuario::where('id', $id)->get();
        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        try{
            $usuario = Usuario::findOrFail($id);
            $validateRequest = $request->validate([
                'nome' => 'required|string|min:5',
                'email' => 'required|email|unique:usuarios,email,' . $id,
                'telefone' => 'required|string',
                'descricao' => 'nullable|string',
                'user_id' => 'required'
            ]);
            $usuario->update($validateRequest);
            return response()->json(['message' => 'Usuário atualizado com sucesso'], 201);
        } catch(\Illuminate\Validation\ValidationException $error) {
            return response()->json([
                'erros' => $error->errors()
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try{
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return response()->json(['message' => 'Usuário deletado com sucesso'], 201);
        } catch(\Illuminate\Validation\ValidationException $error) {
            return response()->json([
                'erros' => $error->errors()
            ]);
        }
    }
}
