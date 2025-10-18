<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'product_name' => 'Esmalte Vermelho',
                'description' => 'Esmalte tradicional cor vermelho',
                'quantity' => 15,
                'unit_cost' => 8.50,
                'minimum_quantity' => 5,
            ],
            [
                'product_name' => 'Esmalte Rosa',
                'description' => 'Esmalte tradicional cor rosa',
                'quantity' => 12,
                'unit_cost' => 8.50,
                'minimum_quantity' => 5,
            ],
            [
                'product_name' => 'Base para Unhas',
                'description' => 'Base protetora para unhas',
                'quantity' => 8,
                'unit_cost' => 12.00,
                'minimum_quantity' => 3,
            ],
            [
                'product_name' => 'Top Coat',
                'description' => 'Finalizador para esmalte',
                'quantity' => 10,
                'unit_cost' => 12.00,
                'minimum_quantity' => 3,
            ],
            [
                'product_name' => 'Removedor de Esmalte',
                'description' => 'Removedor de esmalte sem acetona',
                'quantity' => 25,
                'unit_cost' => 6.00,
                'minimum_quantity' => 10,
            ],
            [
                'product_name' => 'Algodão',
                'description' => 'Algodão para remoção de esmalte',
                'quantity' => 50,
                'unit_cost' => 3.50,
                'minimum_quantity' => 20,
            ],
            [
                'product_name' => 'Lixa para Unhas',
                'description' => 'Lixa descartável para unhas',
                'quantity' => 100,
                'unit_cost' => 0.50,
                'minimum_quantity' => 50,
            ],
            [
                'product_name' => 'Palito de Laranjeira',
                'description' => 'Palito de laranjeira para cutícula',
                'quantity' => 200,
                'unit_cost' => 0.20,
                'minimum_quantity' => 100,
            ],
            [
                'product_name' => 'Óleo de Cutícula',
                'description' => 'Óleo hidratante para cutículas',
                'quantity' => 5,
                'unit_cost' => 15.00,
                'minimum_quantity' => 3,
            ],
            [
                'product_name' => 'Creme Hidratante',
                'description' => 'Creme hidratante para mãos e pés',
                'quantity' => 8,
                'unit_cost' => 18.00,
                'minimum_quantity' => 4,
            ],
            [
                'product_name' => 'Gel para Alongamento',
                'description' => 'Gel para alongamento de unhas',
                'quantity' => 6,
                'unit_cost' => 45.00,
                'minimum_quantity' => 3,
            ],
            [
                'product_name' => 'Tips para Alongamento',
                'description' => 'Tips plásticas para alongamento (caixa com 100)',
                'quantity' => 3,
                'unit_cost' => 25.00,
                'minimum_quantity' => 2,
            ],
            [
                'product_name' => 'Cola para Tips',
                'description' => 'Cola especial para tips de alongamento',
                'quantity' => 4,
                'unit_cost' => 12.00,
                'minimum_quantity' => 2,
            ],
            [
                'product_name' => 'Luvas Descartáveis',
                'description' => 'Luvas descartáveis (caixa com 100)',
                'quantity' => 2,
                'unit_cost' => 35.00,
                'minimum_quantity' => 1,
            ],
            [
                'product_name' => 'Álcool 70%',
                'description' => 'Álcool 70% para esterilização',
                'quantity' => 10,
                'unit_cost' => 8.00,
                'minimum_quantity' => 5,
            ],
        ];

        foreach ($products as $product) {
            Stock::create($product);
        }
    }
}





