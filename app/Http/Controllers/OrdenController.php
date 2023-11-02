<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Orden;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrdenController extends Controller
{
    public function obtener()
    {
        $idCarritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->value('id');
        $pedidos = Pedido::where('carrito_id', $idCarritoUsuario)->get();
        $importeTotal = 0;
        foreach ($pedidos as $pedido) {
            $importeTotal += $pedido->importe;
        }
        $orden = Orden::with('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago')->where('carrito_id', $idCarritoUsuario)->first();
        $orden->importe = $importeTotal;
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
            $pedidos = Pedido::where('carrito_id', $idCarritoUsuario)->get();
            $orden->carrito_id =  $idCarritoUsuario;
            $orden->metodo_pago_id = $req->metodo_pago_id;
            $orden->save();

            $importeTotal = 0;
            foreach ($pedidos as $pedido) {
                $importeTotal += $pedido->importe;
            }
            $orden->importe = $importeTotal;
            $orden->load('carrito.usuario', 'carrito.pedidos.productos.categorias', 'metodo_pago');
            return response()->json(['orden' => $orden]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function eliminar()
    {
        try {
            $idCarritoUsuario = Carrito::where('usuario_id', Auth::user()->id)->value('id');
            if (!$idCarritoUsuario) {
                return response()->json(['errores' => 'Carrito no encontrado'], 404);
            } else {
                $orden = Orden::where('carrito_id', $idCarritoUsuario)->first();
                if ($orden) {
                    $orden->delete();
                    return response()->json(['mensaje' => 'Órden borrada con éxito'], 200);
                } else {
                    return response()->json(['errores' => 'Órden no encontada'], 404);
                }
            }
        } catch (\Throwable $e) {
            return response()->json(['errores' => $e->getMessage()], 500);
        }
    }
}
