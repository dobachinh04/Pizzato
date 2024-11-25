<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            [
                'id' => 1,
                'name' => 'S',
                'price' => '10000',
            ],
            [
                'id' => 2,
                'name' => 'M',
                'price' => '20000',
            ],
            [
                'id' => 3,
                'name' => 'L',
                'price' => '30000',
            ],
            [
                'id' => 4,
                'name' => 'XL',
                'price' => '40000',
            ],
        ];

        foreach ($sizes as $size) {
            ProductSize::create($size);
        }
    }
}
