<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controladorCarrito extends Controller
{
    public function crear(Request $req)
    {
        echo "Creando carrito";
    }
    public function editar(Request $req)
    {
        echo "Editando producto del carrito";
    }
    public function listar(Request $req)
    {
        echo "Listando productos del carrito";
    }
    public function obtener(Request $req)
    {
        echo "Obteniendo resumen del carrito de compras del usuario";
    }
    public function limpiar(Request $req)
    {
        echo "Limpiando producto del carrito";
    }
}
