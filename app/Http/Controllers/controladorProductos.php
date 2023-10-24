<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controladorProductos extends Controller
{
    public function crear(Request $req)
    {
        echo "Creando producto";
    }
    public function editar(Request $req)
    {
        echo "Actualizando producto";
    }
    public function listar(Request $req)
    {
        echo "Listando productos";
    }
    public function obtener(Request $req)
    {
        echo "Obteniendo un producto";
    }
    public function verCantidad(Request $req)
    {
        echo "Obteniendo el stock de un producto";
    }
    public function eliminar(Request $req)
    {
        echo "Eliminando el producto";
    }
}
