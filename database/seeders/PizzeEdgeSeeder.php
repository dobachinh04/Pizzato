<?php

namespace Database\Seeders;

use App\Models\PizzaEdge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaEdgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $edges = [
            [
                'id' => 1,
                'name' => 'Viền phô mai',
                'price' => '25000',
            ],
            [
                'id' => 2,
                'name' => 'Viền xúc xích',
                'price' => '30000',
            ],
        ];

        foreach ($edges as $edge) {
            PizzaEdge::create($edge);
        }
    }
}
