<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\MetodosPago;
use App\Models\Orden;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Stock;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categoria::factory()->count(5)->create();
        MetodosPago::factory()->count(2)->create();
        Usuario::factory()->count(10)->create();
        Producto::factory()->count(10)->create();
        Carrito::factory()->count(10)->create();
        Pedido::factory()->count(5)->create();
        Orden::factory()->count(7)->create();
        Stock::factory()->count(9)->create();
    }
}
