<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@studiounhas.com',
            'phone' => '(11) 98765-4321',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Cliente de teste
        User::create([
            'name' => 'Maria Silva',
            'email' => 'maria@example.com',
            'phone' => '(11) 91234-5678',
            'password' => Hash::make('senha123'),
            'role' => 'cliente',
        ]);
    }
}





