<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productos = Producto::all()->pluck('id')->toArray();

        return [
            'producto_id' => $this->faker->randomElement($productos),
            'cantidad' => $this->faker->randomDigitNotNull,
        ];
    }
}
