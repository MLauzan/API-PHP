<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MetodosPagoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;

Route::get('carrito/{id}', [CarritoController::class, 'obtener']);
Route::post('carrito', [CarritoController::class, 'crear']);
Route::put('carrito', [CarritoController::class, 'editar']);
Route::delete('carrito', [CarritoController::class, 'limpiar']);


Route::get('categoria/{id}', [CategoriasController::class, 'obtener']);
Route::post('categoria', [CategoriasController::class, 'crear']);
Route::put('categoria', [CategoriasController::class, 'editar']);

Route::get('metodosPago', [MetodosPagoController::class, 'obtener']);
Route::post('metodoPago', [MetodosPagoController::class, 'crear']);
Route::put('metodoPago', [MetodosPagoController::class, 'editar']);

Route::get('pedido/{id}', [PedidoController::class, 'obtener']);


Route::get('orden/{id}', [OrdenController::class, 'obtener']);
Route::post('orden', [OrdenController::class, 'crear']);

Route::get('usuario/{id}', [UsuariosController::class, 'obtener']);
Route::post('usuario', [UsuariosController::class, 'crear']);
Route::put('usuario', [UsuariosController::class, 'editar']);

Route::get('stock/{id}', [StockController::class, 'obtener']);
Route::post('stock', [StockController::class, 'actualizar']);

Route::get('productos', [ProductosController::class, 'listar']);
Route::get('producto/{id}', [ProductosController::class, 'obtener']);
Route::post('producto', [ProductosController::class, 'crear']);
Route::put('producto', [ProductosController::class, 'editar']);
Route::delete('producto', [ProductosController::class, 'eliminar']);
