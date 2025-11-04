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
        User::firstOrCreate(
            ['email' => 'admin@studiounhas.com'],
            [
                'name' => 'Administrador',
                'phone' => '(11) 98765-4321',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Cliente de teste
        User::firstOrCreate(
            ['email' => 'maria@example.com'],
            [
                'name' => 'Maria Silva',
                'phone' => '(11) 91234-5678',
                'password' => Hash::make('senha123'),
                'role' => 'cliente',
            ]
        );
    }
}





