<?php

namespace Database\Seeders;

use App\Models\PizzaBase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bases = [
            [
                'id' => 1,
                'name' => 'Đế Dày Bột Tươi',
                'price' => '5000',
            ],
            [
                'id' => 2,
                'name' => 'Đế Vừa Bột Tươi',
                'price' => '15000',
            ],
            [
                'id' => 3,
                'name' => 'Đế Mỏng Giòn',
                'price' => '25000',
            ],
        ];

        foreach ($bases as $base) {
            PizzaBase::create($base);
        }
    }
}
