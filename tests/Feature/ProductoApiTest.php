<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que un usuario autenticado puede crear un producto con imagen.
     */
    public function test_usuario_puede_crear_producto_con_imagen()
    {
        // 1. Preparamos el entorno
        \Illuminate\Support\Facades\Storage::fake('public'); // Simulamos el storage
        $user = \App\Models\User::factory()->create(['role' => 'user']);
        $categoria = \App\Models\Categoria::create(['nombre' => 'Test Cat', 'descripcion' => 'Desc']);

        $imagen = \Illuminate\Http\UploadedFile::fake()->create('producto.jpg');

        $datos = [
            'nombre'       => 'Producto de Prueba',
            'precio'       => 99.99,
            'stock'        => 10,
            'categoria_id' => $categoria->id,
            'imagen'       => $imagen
        ];

        // 2. Ejecutamos la acción como el usuario autenticado (usando Sanctum)
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/productos', $datos);

        // 3. Verificamos resultados
        $response->assertStatus(201)
            ->assertJsonStructure(['status', 'message', 'data' => ['imagen_url']]);

        // Verificamos que el archivo se guardó físicamente (en el fake storage)
        $producto = \App\Models\Producto::first();
        \Illuminate\Support\Facades\Storage::disk('public')->assertExists($producto->imagen);
    }

    /**
     * Prueba que los productos se listan con su categoría.
     */
    public function test_listar_productos_incluye_categoria()
    {
        $user = \App\Models\User::factory()->create(['role' => 'admin']);
        $categoria = \App\Models\Categoria::create(['nombre' => 'Electrónica']);
        \App\Models\Producto::factory()->create([
            'user_id' => $user->id,
            'categoria_id' => $categoria->id,
            'nombre' => 'Smartphone'
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/productos');

        $response->assertStatus(200)
            ->assertJsonFragment(['nombre' => 'Electrónica']);
    }

    /**
     * Prueba que un usuario no puede borrar productos de otros si no es admin.
     */
    public function test_usuario_no_puede_borrar_producto_ajeno()
    {
        $user1 = \App\Models\User::factory()->create(['role' => 'user']);
        $user2 = \App\Models\User::factory()->create(['role' => 'user']);
        $producto = \App\Models\Producto::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2, 'sanctum')
            ->deleteJson("/api/productos/{$producto->id}");

        $response->assertStatus(403); // Forbidden
    }
}
