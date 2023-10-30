<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductosController extends Controller
{
    public function listar()
    {
        $productos = Producto::with('categorias')->get();
        return response()->json(['productos' => $productos]);
    }
    public function obtener()
    {
        $nombre = request('nombre');
        $productos = Producto::with('categorias')->where('nombre', 'like', "%$nombre%")->get(); 

        return response()->json(['productos' => $productos]);
    }

    public function crear(Request $req)
    {
        try {
            $req->validate([
                'nombre' => 'required|string|max:255',
                'precio' => 'required|numeric',
                'imagen' => 'nullable|url:http,https',
                'descripcion' => 'nullable|string|max:255',
                'categoria_id' => 'required|exists:categorias,id'
            ]);

            $producto = new Producto();
            $producto->nombre = $req->nombre;
            $producto->precio = $req->precio;
            $producto->imagen = $req->imagen;
            $producto->descripcion = $req->descripcion;
            $producto->categoria_id = $req->categoria_id;
            $producto->save();

            return response()->json(['producto' => $producto]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function editar(Request $req)
    {
        echo "Actualizando producto";
    }
    public function eliminar(Request $req)
    {
        echo "Eliminando el producto";
    }
}
