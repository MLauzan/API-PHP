<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    public function obtener($producto_id)
    {
        $stock = Stock::where('producto_id', $producto_id)->with('producto.categorias')->first();
        return response()->json(['stock' => $stock]);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'producto_id' => 'required|numeric|exists:productos,id|unique:stocks,producto_id',
                'cantidad' => 'required|numeric|gt:0',
            ]);
            $stock = new Stock();
            $stock->producto_id = $req->producto_id;
            $stock->cantidad = $req->cantidad;
            $stock->save();
            $stock->load('producto.categorias');

            return response()->json(['stock' => $stock]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
}
