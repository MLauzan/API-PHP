<?php

namespace Database\Factories;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $carritos = Carrito::all()->pluck('id')->toArray();
        $productos = Producto::all()->pluck('id')->toArray();

        return [
            'carrito_id' => $this->faker->randomElement($carritos),
            'producto_id' => $this->faker->randomElement($productos),
            'cantidad' => $this->faker->randomDigitNotNull(),
            'importe' => $this->faker->numberBetween(1000, 12000),
        ];
    }
}
