<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    public function obtener()
    {
        $idCarritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->value('id');
        $pedidos = Pedido::with('productos.categorias', 'carrito.usuario')->where('carrito_id', $idCarritoUsuario)->first();

        return response()->json(['pedidos' => $pedidos]);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'producto_id' => 'required|numeric|exists:productos,id',
                'cantidad' => 'required|numeric|gt:0',
            ]);
            $carritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->first();
            if (!$carritoUsuario) {
                $carritoUsuario = new Carrito();
                $carritoUsuario->usuario_id = Auth::user()->id;
                $carritoUsuario->importe = 0;
                $carritoUsuario->save();
            }

            $precioProducto = Producto::where('id', $req->producto_id)->value('precio');

            $pedido = new Pedido();
            $pedido->carrito_id =  $carritoUsuario->id;
            $pedido->producto_id = $req->producto_id;
            $pedido->cantidad = $req->cantidad;
            $pedido->importe = intval($precioProducto * $pedido->cantidad);

            $productoEnCarrito = Pedido::where('producto_id', $pedido->producto_id)->where('carrito_id', $pedido->carrito_id)->first();
            if ($productoEnCarrito) {
                $productoEnCarrito->update(
                    [
                        'cantidad' => $productoEnCarrito->cantidad + intval($req->cantidad),
                        'importe' => $productoEnCarrito->importe + ($precioProducto * intval($req->cantidad))
                    ]
                );
            } else {
                $pedido->save();
            }
            $carritoUsuario->importe = $carritoUsuario->importe + $pedido->importe;
            $carritoUsuario->save();

            $pedido->load('carrito.usuario', 'productos.categorias');
            return response()->json(['pedido' => $pedido]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function eliminar()
    {
    }
}
