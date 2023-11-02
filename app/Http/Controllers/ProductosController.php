<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
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
    public function editar(Request $req, $id)
    {
        try {
            $producto = Producto::find($id);

            if (!$producto) {
                return response()->json(['errores' => 'Producto no encontrado'], 404);
            }
            $req->validate([
                'nombre' => 'nullable|string|max:255',
                'precio' => 'nullable|numeric',
                'imagen' => 'nullable|url:http,https',
                'descripcion' => 'nullable|string|max:255',
                'categoria_id' => 'nullable|exists:categorias,id'
            ]);
            $producto->fill($req->only([
                'nombre', 'precio', 'imagen', 'descripcion', 'categoria_id'
            ]));
            $producto->save();
            $pedidos =  Pedido::where('producto_id', $id)->get();
            foreach ($pedidos as $pedido) {
                $pedido->update(["importe" => $producto->precio]);
            }
            return response()->json(['producto' => $producto], 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function eliminar(Request $req, $id)
    {
        $producto = Producto::find($id);

        if (!$producto || $producto->habilitado === 0) {
            return response()->json(['errores' => 'El producto no fue encontrado o ya fue borrado'], 404);
        } else {
            $producto->update(['habilitado' => false]);
            return response()->json(['mensaje' => 'Producto borrado con éxito'], 200);
        }
    }
}
