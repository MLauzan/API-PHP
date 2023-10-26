<?php

namespace Database\Factories;

use App\Models\Carrito;
use App\Models\MetodosPago;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orden>
 */
class OrdenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $metodos_pago = MetodosPago::all()->pluck('id')->toArray();

        return [
            'carrito_id' => $this->faker->unique()->numberBetween(1, 7),
            'metodo_pago_id' => $this->faker->randomElement($metodos_pago),
            'fecha_creacion' => now(),
        ];
    }
}
