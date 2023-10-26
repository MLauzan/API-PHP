<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MetodosPago;
use Illuminate\Http\Request;

class MetodosPagoController extends Controller
{
    public function obtener()
    {
        $metodosPago = MetodosPago::all();
        return response()->json(['metodosPago' => $metodosPago]);
    }
    public function crear()
    {
        echo "Creando método de pago";
    }
    public function editar()
    {
        echo "Actualizando método de pago";
    }
}
