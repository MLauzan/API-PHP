<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CarritoController extends Controller
{
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'importe' => 'required|numeric|gt:0',
            ]);

            $carrito = new Carrito();
            $carrito->usuario_id =  Auth::user()->id;
            $carrito->importe = $req->importe;

            $carrito->save();
            $carrito->load('usuario');

            return response()->json(['carrito' => $carrito]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function obtener(Request $req, $carrito_id)
    {
        $carrito = Carrito::with('usuario', 'pedidos.productos.categorias')->find($carrito_id);
        return response()->json(['carrito' => $carrito]);
    }
    public function editar(Request $req)
    {
        echo "Editando producto del carrito";
    }
    public function limpiar(Request $req)
    {
        echo "Limpiando producto del carrito";
    }
}
