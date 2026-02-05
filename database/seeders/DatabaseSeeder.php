<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREAMOS CATEGORÍAS POR DEFECTO
        $tec = Categoria::create(['nombre' => 'Tecnología', 'descripcion' => 'Productos electrónicos y gadgets']);
        $ropa = Categoria::create(['nombre' => 'Ropa', 'descripcion' => 'Prendas de vestir y accesorios']);
        $hogar = Categoria::create(['nombre' => 'Hogar', 'descripcion' => 'Artículos para la casa']);
        $otros = Categoria::create(['nombre' => 'Otros', 'descripcion' => 'Categoría general']);

        // 2. CREAMOS UN ADMINISTRADOR
        $admin = User::create([
            'name' => 'Admin de Prueba',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('prueba123'), // La contraseña será: password
            'role' => 'admin',
            'edad' => 30,
        ]);

        // 3. CREAMOS UN EMPLEADO
        $empleado = User::create([
            'name' => 'Empleado Juan',
            'email' => 'juan@empresa.com',
            'password' => Hash::make('prueba123'),
            'role' => 'empleado',
            'edad' => 25,
        ]);

        // 4. CREAMOS PRODUCTOS PARA EL EMPLEADO
        Producto::create([
            'nombre' => 'Laptop Gamer',
            'precio' => 1500,
            'stock' => 5,
            'user_id' => $empleado->id, // El dueño es Juan
            'categoria_id' => $tec->id,
        ]);

        // 5. CREAMOS PRODUCTOS PARA EL ADMIN
        Producto::create([
            'nombre' => 'Mouse Pro',
            'precio' => 50,
            'stock' => 20,
            'user_id' => $admin->id, // El dueño es el Admin
            'categoria_id' => $tec->id,
        ]);
    }
}
