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
                'name' => 'Nhỏ',
                'price' => '0',
            ],
            [
                'id' => 2,
                'name' => 'Vừa',
                'price' => '20000',
            ],
            [
                'id' => 3,
                'name' => 'Lớn',
                'price' => '30000',
            ],
        ];

        foreach ($sizes as $size) {
            ProductSize::create($size);
        }
    }
}
