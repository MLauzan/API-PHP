<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function obtener($pedido_id)
    {
        $pedidos = Pedido::with('productos.categorias', 'carrito.usuario')->find($pedido_id);
        return response()->json(['pedidos' => $pedidos]);
    }
}
