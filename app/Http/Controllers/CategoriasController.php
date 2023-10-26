<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function obtener(Request $req, $id)
    {
        $categorias = Categoria::with('productos')->find($id);
        return response()->json(['categorias' => $categorias]);
    }
    public function crear(Request $req)
    {
        echo "Creando categoría";
    }
    public function editar(Request $req)
    {
        echo "Actualizando producto";
    }
}
