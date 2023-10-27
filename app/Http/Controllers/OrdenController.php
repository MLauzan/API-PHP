<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrdenController extends Controller
{
    public function obtener($orden_id)
    {
        $orden = Orden::with('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago')->find($orden_id);
        return response()->json(['orden' => $orden]);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'carrito_id' => 'required|numeric|exists:carritos,id|unique:ordenes,carrito_id',
                'metodo_pago_id' => 'required|numeric|exists:metodos_pago,id',
            ]);
            $orden = new Orden();
            $orden->carrito_id = $req->carrito_id;
            $orden->metodo_pago_id = $req->metodo_pago_id;

            $orden->save();
            $orden->load('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago');
            return response()->json(['orden' => $orden]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
}
