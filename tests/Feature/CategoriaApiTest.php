<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que se pueden listar las categorías.
     */
    public function test_se_pueden_listar_categorias()
    {
        $user = \App\Models\User::factory()->create();
        \App\Models\Categoria::create(['nombre' => 'Ropa']);
        \App\Models\Categoria::create(['nombre' => 'Hogar']);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/categorias');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    /**
     * Prueba que los administradores pueden crear categorías.
     */
    public function test_admin_puede_crear_categoria()
    {
        $user = \App\Models\User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/categorias', [
                'nombre' => 'Nueva Categoría',
                'descripcion' => 'Descripción de prueba'
            ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['nombre' => 'Nueva Categoría']);
    }
}
