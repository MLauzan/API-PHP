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
        $pedidos = Pedido::where('carrito_id', $idCarritoUsuario)->get();
        $importeTotal = 0;
        foreach ($pedidos as $pedido) {
            $importeTotal += $pedido->importe;
        }
        $pedidos->importe = $importeTotal;
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
            $pedidos =  Pedido::where('carrito_id', $carritoUsuario->id)->get();
            $importeTotal = 0;
            foreach ($pedidos as $pedido) {
                $importeTotal += $pedido->importe;
            }
            $pedido->importeTotal = $importeTotal;
            $pedido->load('carrito.usuario', 'productos.categorias');
            return response()->json(['pedido' => $pedido]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function eliminar($id)
    {
        try {
            $carritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->first();
            if (!$carritoUsuario->id) {
                return response()->json(['errores' => 'Carrito no encontrado'], 404);
            } else {
                $pedido = Pedido::where('carrito_id', $carritoUsuario->id)->where('id', $id)->first();
                if ($pedido) {
                    $carritoUsuario->save();
                    $pedido->delete();
                    return response()->json(['mensaje' => 'Pedido borrado con éxito'], 200);
                } else {
                    return response()->json(['errores' => 'Pedido no encontado'], 404);
                }
            }
        } catch (\Throwable $e) {
            return response()->json(['errores' => $e->getMessage()], 500);
        }
    }
}
