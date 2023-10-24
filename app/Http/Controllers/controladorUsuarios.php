<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class controladorUsuarios extends Controller
{
    public function crear(Request $req)
    {
        echo "Creando usuario";
    }
    public function editar(Request $req)
    {
        echo "Editando usuario";
    }
    public function obtener(Request $req)
    {
        echo "Obteniendo un usuario";
    }
}
