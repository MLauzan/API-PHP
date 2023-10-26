<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CarritoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $usuarios = Usuario::all()->pluck('id')->toArray();

        return [
            'usuario_id' => $this->faker->unique()->randomElement($usuarios),
            'importe' => $this->faker->numberBetween(1000, 12000),
            'fecha_creacion' => now()
        ];
    }
}
