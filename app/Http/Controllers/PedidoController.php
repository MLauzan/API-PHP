<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function obtener($pedido_id)
    {
        $pedidos = Pedido::with('productos.categorias', 'carrito.usuario')->find($pedido_id);
        return response()->json(['pedidos' => $pedidos]);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'carrito_id' => 'required|numeric|exists:carritos,id',
                'producto_id' => 'required|numeric|exists:productos,id',
                'cantidad' => 'required|numeric|gt:0',
                'importe' => 'required|numeric|gt:0'
            ]);
            $pedido = new Pedido();
            $pedido->carrito_id = $req->carrito_id;
            $pedido->producto_id = $req->producto_id;
            $pedido->cantidad = $req->cantidad;
            $pedido->importe = $req->importe;

            $productoEnCarrito = Pedido::where('producto_id', $pedido->producto_id)->where('carrito_id', $pedido->carrito_id)->first();
            if ($productoEnCarrito) {
                $productoEnCarrito->update(['cantidad' => $productoEnCarrito->cantidad + intval($req->cantidad)]);
            } else {
                $pedido->save();
            }
            $pedido->load('carrito.usuario', 'productos.categorias');
            return response()->json(['pedido' => $pedido]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
}
