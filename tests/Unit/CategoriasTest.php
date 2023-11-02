<?php

namespace Tests\Unit;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriasTest extends TestCase
{

    public function test_post_categorias(): void
    {
        $data = ['nombre' => 'Prueba'];

        $response = $this->postJson('/api/categoria', $data);

        $response
            ->assertStatus(201)
            ->assertJsonPath('categoria.nombre', 'Prueba');

        $this->assertDatabaseHas('categorias', $data);
    }
    public function test_get_categoria(): void
    {
        $categoria = new Categoria(['nombre' => 'Prueba']);
        $categoria->save();
        $response = $this->get("api/categoria/$categoria->id");
        $response->assertStatus(200)->assertJsonPath('categorias.nombre', 'Prueba');
    }
}
