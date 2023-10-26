<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categorias = Categoria::all()->pluck('id')->toArray();

        return [
            'nombre' => $this->faker->sentence(random_int(1, 5)),
            'precio' => $this->faker->randomDigitNotNull,
            'imagen' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->sentences(2, true),
            'categoria_id' => $this->faker->randomElement($categorias),
        ];
    }
}
