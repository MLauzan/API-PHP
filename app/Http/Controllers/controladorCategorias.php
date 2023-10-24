<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controladorCategorias extends Controller
{
    public function crear(Request $req)
    {
        echo "Creando categoría";
    }
    public function editar(Request $req)
    {
        echo "Actualizando producto";
    }
    public function obtener(Request $req)
    {
        echo "Obteniendo productos dentro de la categoría";
    }
}
