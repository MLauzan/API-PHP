<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Validation\ValidationException;

class UsuariosController extends Controller
{
    public function obtener($id)
    {
        $usuario = Usuario::find($id);
        return response()->json(['usuario' => $usuario]);
    }

    public function login(Request $req)
    {
        try {
            $req->validate([
                'email' => 'required|email',
                'contrasena' => 'required|string'
            ]);
            $usuario = Usuario::where('email', $req->email)
                ->where('contrasena', $req->contrasena)
                ->first();
            if (!$usuario) {
                throw new \Exception("Credenciales inválidas");
            } else {
                $clave_secreta = 'clave_secreta_secreta';
                $datos_usuario = [
                    'id' => $usuario->id,
                    'nombre' => $usuario->nombre
                ];
                $jwt = JWT::encode($datos_usuario, $clave_secreta, 'HS256');
                $decoded = JWT::decode($jwt, new Key($clave_secreta, 'HS256'));
                return response()->json(['jwt' => $jwt, 'decoded' => $decoded]);
            }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


    public function editar(Request $req)
    {
        echo "Editando usuario";
    }
}
