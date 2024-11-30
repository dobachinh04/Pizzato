<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Random tạo từ 100 đến 250 đánh giá
        $randomReviewCount = rand(100, 250);

        // Tạo số lượng review ngẫu nhiên
        ProductReview::factory($randomReviewCount)->create();
    }
}
