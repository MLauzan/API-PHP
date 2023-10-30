<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CarritoController extends Controller
{
    public function obtener()
    {
        $carrito = Carrito::with('usuario', 'pedidos.productos.categorias')->where('usuario_id', Auth::user()->id)->first();
        return response()->json(['carrito' => $carrito]);
    }
}
