<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CarritoController extends Controller
{
    public function obtener()
    {
        $carrito = Carrito::with('usuario', 'pedidos.productos.categorias')->where('usuario_id', Auth::user()->id)->first();

        $pedidos =  Pedido::where('carrito_id', $carrito->id)->get();
        $importeTotal = 0;
        foreach ($pedidos as $pedido) {
            $importeTotal += $pedido->importe;
        }
        $carrito->importe = $importeTotal;
        return response()->json(['carrito' => $carrito]);
    }
}
