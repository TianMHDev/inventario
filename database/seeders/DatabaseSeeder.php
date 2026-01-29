<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREAMOS UN ADMINISTRADOR
        $admin = User::create([
            'name' => 'Admin de Prueba',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('prueba123'), // La contraseña será: password
            'role' => 'admin',
            'edad' => 30,
        ]);

        // 2. CREAMOS UN EMPLEADO
        $empleado = User::create([
            'name' => 'Empleado Juan',
            'email' => 'juan@empresa.com',
            'password' => Hash::make('prueba123'),
            'role' => 'empleado',
            'edad' => 25,
        ]);

        // 3. CREAMOS PRODUCTOS PARA EL EMPLEADO
        Producto::create([
            'nombre' => 'Laptop Gamer',
            'precio' => 1500,
            'stock' => 5,
            'user_id' => $empleado->id, // El dueño es Juan
        ]);

        // 4. CREAMOS PRODUCTOS PARA EL ADMIN
        Producto::create([
            'nombre' => 'Mouse Pro',
            'precio' => 50,
            'stock' => 20,
            'user_id' => $admin->id, // El dueño es el Admin
        ]);
    }
}
