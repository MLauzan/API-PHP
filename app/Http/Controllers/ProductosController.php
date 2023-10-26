<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function listar(Request $req)
    {
        $productos = Producto::with('categorias')->get();
        return response()->json(['productos' => $productos]);
    }
    public function obtener($id)
    {
        $producto = Producto::with('categorias')->find($id);
        return response()->json(['producto' => $producto]);
    }
    public function crear(Request $req)
    {
        echo "Creando producto";
    }
    public function editar(Request $req)
    {
        echo "Actualizando producto";
    }
    public function eliminar(Request $req)
    {
        echo "Eliminando el producto";
    }
}
