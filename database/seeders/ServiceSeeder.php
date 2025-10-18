<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Manicure Simples',
                'description' => 'Lixamento, cutilagem, esmaltação com esmalte tradicional',
                'price' => 35.00,
                'duration_minutes' => 45,
                'active' => true,
            ],
            [
                'name' => 'Manicure com Spa',
                'description' => 'Manicure completa com esfoliação, hidratação e massagem',
                'price' => 55.00,
                'duration_minutes' => 60,
                'active' => true,
            ],
            [
                'name' => 'Pedicure Simples',
                'description' => 'Lixamento, cutilagem, esmaltação com esmalte tradicional',
                'price' => 40.00,
                'duration_minutes' => 50,
                'active' => true,
            ],
            [
                'name' => 'Pedicure com Spa',
                'description' => 'Pedicure completa com esfoliação, hidratação e massagem',
                'price' => 60.00,
                'duration_minutes' => 70,
                'active' => true,
            ],
            [
                'name' => 'Alongamento em Gel',
                'description' => 'Alongamento de unhas com gel, formato à escolher',
                'price' => 120.00,
                'duration_minutes' => 120,
                'active' => true,
            ],
            [
                'name' => 'Alongamento em Fibra',
                'description' => 'Alongamento de unhas com fibra de vidro',
                'price' => 100.00,
                'duration_minutes' => 100,
                'active' => true,
            ],
            [
                'name' => 'Manutenção de Alongamento',
                'description' => 'Manutenção de unhas alongadas (gel ou fibra)',
                'price' => 80.00,
                'duration_minutes' => 90,
                'active' => true,
            ],
            [
                'name' => 'Unha em Gel',
                'description' => 'Esmaltação em gel, maior durabilidade',
                'price' => 50.00,
                'duration_minutes' => 60,
                'active' => true,
            ],
            [
                'name' => 'Blindagem',
                'description' => 'Tratamento para fortalecimento das unhas',
                'price' => 45.00,
                'duration_minutes' => 50,
                'active' => true,
            ],
            [
                'name' => 'Nail Art Simples',
                'description' => 'Decoração artística simples nas unhas (por unha)',
                'price' => 10.00,
                'duration_minutes' => 15,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}





