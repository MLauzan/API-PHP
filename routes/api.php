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


Route::prefix('v1')->middleware(['api'])->group(function () {
    
    Route::middleware('auth:api')->group(function () {
        
        Route::get('logout', [UsuariosController::class, 'logout']);
       
        Route::get('carrito', [CarritoController::class, 'obtener']);

        Route::post('categoria', [CategoriasController::class, 'crear']);
        Route::put('categoria/{id}', [CategoriasController::class, 'editar']);

        Route::post('metodospago', [MetodosPagoController::class, 'crear']);
        Route::put('metodospago/{id}', [MetodosPagoController::class, 'editar']);

        Route::get('pedido', [PedidoController::class, 'obtener']);
        Route::post('pedido', [PedidoController::class, 'crear']);
        Route::delete('pedido/{id}', [PedidoController::class, 'eliminar']);

        Route::get('orden', [OrdenController::class, 'obtener']);
        Route::post('orden', [OrdenController::class, 'crear']);
        Route::delete('orden', [OrdenController::class, 'eliminar']);

        Route::get('usuario', [UsuariosController::class, 'obtener']);
        Route::put('usuario', [UsuariosController::class, 'editar']);

        Route::post('stock', [StockController::class, 'crear']);
        Route::put('stock/{producto_id}', [StockController::class, 'editar']);

        Route::post('producto', [ProductosController::class, 'crear']);
        Route::put('producto/{id}', [ProductosController::class, 'editar']);
        Route::delete('producto/{id}', [ProductosController::class, 'eliminar']);
    });

    Route::post('login', [UsuariosController::class, 'login']);
    Route::post('registrar', [UsuariosController::class, 'registrarse']);

    Route::get('producto', [ProductosController::class, 'obtener']);
    Route::get('productos', [ProductosController::class, 'listar']);

    Route::get('stock/{id}', [StockController::class, 'obtener']);

    Route::get('metodospago', [MetodosPagoController::class, 'obtener']);

    Route::get('categoria/{id}', [CategoriasController::class, 'obtener']);
});
