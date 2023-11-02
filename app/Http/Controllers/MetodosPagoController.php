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
        return response()->json(['metodosPago' => $metodosPago], 200);
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

            return response()->json(['metodoPago' => $metodoPago], 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function editar(Request $req, $id)
    {
        try {
            $metodo_pago = MetodosPago::find($id);

            if (!$metodo_pago) {
                return response()->json(['errores' => 'Método de Pago no encontrado'], 404);
            }

            $req->validate([
                'tipo' => 'required|string|max:100',
            ]);
            $metodo_pago->update([
                'tipo' => $req->tipo
            ]);
            return response()->json(['metodo_pago' => $metodo_pago], 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
}
