<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;

class Usuarios extends Controller
{
    public function view()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function create(Request $request)
    {
        try{
            $validateRequest = $request->validate([
                'nome' => 'required|string|min:5',
                'email' => 'required|email|unique:usuarios,email',
                'telefone' => 'required|string|min:7',
                'descricao' => 'nullable|string|'
            ]);
            Usuario::create($validateRequest);
            return response()->json(['message' => 'Usuário cadastrado com sucesso'], 201);
        } catch(\Illuminate\Validation\ValidationException $error) {
            return response()->json([
                'erros' => $error->errors()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $usuario = Usuario::findOrFail($id);
            $validateRequest = $request->validate([
                'nome' => 'required|string|min:5',
                'email' => 'required|email|unique:usuarios,email,' . $id,
                'telefone' => 'required|string|min:7',
                'descricao' => 'nullable|string|'
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
