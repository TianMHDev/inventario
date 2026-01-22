<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Laptop',
                'precio' => 3500.00,
                'stock'  => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mouse',
                'precio' => 80.50,
                'stock'  => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Teclado',
                'precio' => 120.00,
                'stock'  => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
