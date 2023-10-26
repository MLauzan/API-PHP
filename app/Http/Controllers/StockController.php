<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function obtener($producto_id)
    {
        $stock = Stock::where('producto_id', $producto_id)->with('producto.categorias')->first();
        return response()->json(['stock' => $stock]);
    }
    public function actualizar()
    {
        echo ("Actualizando stock");
    }
}
