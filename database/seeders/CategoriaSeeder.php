<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Computadores', 'descripcion' => 'Laptops, desktops y servidores.'],
            ['nombre' => 'Tablets', 'descripcion' => 'Dispositivos táctiles portátiles.'],
            ['nombre' => 'Celulares', 'descripcion' => 'Smartphones y teléfonos móviles.'],
            ['nombre' => 'Accesorios', 'descripcion' => 'Periféricos y complementos.'],
        ];

        foreach ($categorias as $cat) {
            \App\Models\Categoria::updateOrCreate(
                ['nombre' => $cat['nombre']],
                ['descripcion' => $cat['descripcion']]
            );
        }
    }
}
