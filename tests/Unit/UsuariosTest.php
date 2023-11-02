<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuariosTest extends TestCase
{
    public function test_post_usuarios(): void
    {
        $data = [
            'nombre' => 'nombreDePrueba',
            'email' => 'nombrepruebdasdsaaaaasdadsadsadadsadasdasasdasAa@gmail.com',
            'password' => 'prueba123',
            'telefono' => '',
            'domicilio' => '',
        ];

        $response = $this->postJson('/api/registrar', $data);

        $response
            ->assertStatus(201)
            ->assertJsonPath('usuario.nombre', $data['nombre'])
            ->assertJsonPath('usuario.email', $data['email'])
            ->assertJsonPath('usuario.telefono', null)
            ->assertJsonPath('usuario.domicilio', null);

        $this->assertDatabaseHas('usuarios', ['email' => $data['email']]);
    }
}
