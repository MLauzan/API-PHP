<?php

use App\Http\Controllers\controladorCarrito;
use App\Http\Controllers\controladorCategorias;
use App\Http\Controllers\controladorMetodosPago;
use App\Http\Controllers\controladorOrdenCompra;
use App\Http\Controllers\controladorProductos;
use App\Http\Controllers\controladorUsuarios;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use Illuminate\Http\Request;

Route::get('carrito', [controladorCarrito::class, 'obtener']);
Route::get('carrito/productos', [controladorCarrito::class, 'listar']);
Route::post('carrito', [controladorCarrito::class, 'crear']);
Route::put('carrito', [controladorCarrito::class, 'editar']);
Route::delete('carrito', [controladorCarrito::class, 'limpiar']);

Route::get('categorias/{id}', [controladorCategorias::class, 'obtener']);
Route::post('categorias', [controladorCategorias::class, 'crear']);
Route::put('categorias', [controladorCategorias::class, 'editar']);

Route::post('metodoPago', [controladorMetodosPago::class, 'crear']);
Route::put('metodoPago', [controladorMetodosPago::class, 'editar']);

Route::post('orden', [controladorOrdenCompra::class, 'crear']);

Route::post('registrarse', [controladorUsuarios::class, 'crear']);
Route::get('usuario', [controladorUsuarios::class, 'obtener']);
Route::put('usuario', [controladorUsuarios::class, 'editar']);

Route::get('productos', [controladorProductos::class, 'listar']);
Route::get('producto/{id}', [controladorProductos::class, 'obtener']);
Route::get('cantidad/{id}', [controladorProductos::class, 'verCantidad']);
Route::post('producto', [controladorProductos::class, 'crear']);
Route::put('producto', [controladorProductos::class, 'editar']);
Route::delete('producto', [controladorProductos::class, 'eliminar']);
