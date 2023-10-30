<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrdenController extends Controller
{
    public function obtener()
    {
        $idCarritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->value('id');
        $orden = Orden::with('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago')->where('carrito_id', $idCarritoUsuario)->first();
        return response()->json(['orden' => $orden]);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'metodo_pago_id' => 'required|numeric|exists:metodos_pago,id',
            ]);
            $idCarritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->value('id');

            $orden = new Orden();
            $orden->carrito_id =  $idCarritoUsuario;
            $orden->metodo_pago_id = $req->metodo_pago_id;

            $orden->save();
            $orden->load('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago');
            return response()->json(['orden' => $orden]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function eliminar()
    {
    }
}
