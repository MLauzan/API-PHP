<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function obtener($orden_id)
    {
        $orden = Orden::with('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago')->find($orden_id);
        return response()->json(['orden' => $orden]);
    }
    public function crear()
    {
        echo "Creando orden de la compra";
    }
}
