<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsuariosController extends Controller
{
    public function obtener()
    {
        return response()->json(['usuario' => Auth::user()]);
    }

    public function login(Request $req)
    {
        try {
            $credenciales = $req->validate([
                'email' => 'required|exists:usuarios,email',
                'password' => 'required'
            ]);
            if (Auth::attempt($credenciales, true)) {
                $usuario = Usuario::find(Auth::user()->id);
                $token = $usuario->createToken('token')->accessToken;
                return response()->json(['token'  => $token, 'usuario' => $usuario]);
            }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }

    public function registrarse(Request $req)
    {
        try {
            $req->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios,email',
                'password' => 'required|string|min:6',
                'telefono' => 'nullable|string|max:30',
                'domicilio' => 'nullable|string|max:255',
            ]);
            $usuario = new Usuario();
            $usuario->nombre = $req->nombre;
            $usuario->email = $req->email;
            $usuario->password = $req['password'] = Hash::make($req['password']);
            $usuario->telefono = $req->telefono;
            $usuario->domicilio = $req->domicilio;

            $usuario->save();
            $token = $usuario->createToken('token')->accessToken;
            return response()->json(['token' => $token, 'usuario' => $usuario]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }

    public function logout(Request $req)
    {
        $token = $req->user()->token();
        $token->revoke();
        return response()->noContent();
    }

    public function editar(Request $req)
    {
        echo "Editando usuario";
    }
}
