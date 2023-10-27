<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MetodosPago;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MetodosPagoController extends Controller
{
    public function obtener()
    {
        $metodosPago = MetodosPago::all();
        return response()->json(['metodosPago' => $metodosPago]);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'tipo' => 'required|string|max:100',
            ]);
            $metodoPago = new MetodosPago();
            $metodoPago->tipo = $req->tipo;
            $metodoPago->save();

            return response()->json(['metodoPago' => $metodoPago]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function editar()
    {
        echo "Actualizando método de pago";
    }
}
