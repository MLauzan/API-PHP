<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CarritoController extends Controller
{
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'usuario_id' => 'required|numeric|exists:usuarios,id|unique:carritos,usuario_id',
                'importe' => 'required|numeric|gt:0',
            ]);

            $carrito = new Carrito();
            $carrito->usuario_id = $req->usuario_id;
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
