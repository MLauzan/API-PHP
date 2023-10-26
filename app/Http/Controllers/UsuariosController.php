<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function obtener($id)
    {
        $usuario = Usuario::find($id);
        return response()->json(['usuario' => $usuario]);
    }
    public function crear(Request $req)
    {
        echo "Creando usuario";
    }
    public function editar(Request $req)
    {
        echo "Editando usuario";
    }
}
