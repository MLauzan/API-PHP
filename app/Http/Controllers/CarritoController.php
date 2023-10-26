<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function obtener(Request $req, $carrito_id)
    {
        $carrito = Carrito::with('usuario', 'pedidos.productos.categorias')->find($carrito_id);
        return response()->json(['carrito' => $carrito]);
    }
    public function crear(Request $req)
    {
        echo "Creando carrito";
    }
    public function editar(Request $req)
    {
        echo "Editando producto del carrito";
    }
    public function listar(Request $req)
    {
        echo "Listando productos del carrito";
    }
    public function limpiar(Request $req)
    {
        echo "Limpiando producto del carrito";
    }
}
