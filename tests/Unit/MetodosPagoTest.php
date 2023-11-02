<?php

namespace Tests\Unit;

use App\Models\MetodosPago;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MetodosPagoTest extends TestCase
{

    public function test_post_metodos_pago(): void
    {
        $data = ['tipo' => 'Efectivo'];

        $response = $this->postJson('/api/metodospago', $data);

        $response
            ->assertStatus(201)
            ->assertJsonPath('metodoPago.tipo', 'Efectivo');

        $this->assertDatabaseHas('metodos_pago', $data);
    }
    public function test_get_metodos_pago(): void
    {
        $metodoPago = new MetodosPago(['tipo' => 'Efectivo']);
        $metodoPago->save();
        $response = $this->get("api/metodospago");
        $response->assertStatus(200)->assertJsonIsArray('metodosPago');
    }
}
