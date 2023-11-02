<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoriasController extends Controller
{
    public function obtener(Request $req, $id)
    {
        $categorias = Categoria::with('productos')->find($id);
        return response()->json(['categorias' => $categorias], 200);
    }
    public function crear(Request $req)
    {
        try {
            $req->validate([
                'nombre' => 'required|string|max:100',
            ]);

            $categoria = new Categoria();
            $categoria->nombre = $req->nombre;
            $categoria->save();
            return response()->json(['categoria' => $categoria], 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
    public function editar(Request $req, $id)
    {
        try {
            $categoria = Categoria::find($id);

            if (!$categoria) {
                return response()->json(['errores' => 'Categoría no encontrada'], 404);
            }
            
            $req->validate([
                'nombre' => 'required|string|max:100',
            ]);
            $categoria->update([
                'nombre' => $req->nombre
            ]);
            return response()->json(['categoria' => $categoria], 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errores' => $errors], 422);
        }
    }
}
