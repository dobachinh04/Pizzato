<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductReview::class;

    public function definition(): array
    {
        return [
            'user_id' =>User::inRandomOrder()->first()->id, // Chọn user ngẫu nhiên từ bảng users
            'product_id' => Product::inRandomOrder()->first()->id, // Chọn product ngẫu nhiên từ bảng products
            'rating' => fake()->randomFloat(1, 1, 5), // Rating từ 1.0 đến 5.0
            'review' => fake()->paragraph(), // Đoạn văn ngẫu nhiên
            // 'status' => fake()->boolean(80), // 80% là đã duyệt
            // 'approved_at' => fake()->optional(0.8)->dateTime(), // 80% có thời gian duyệt
        ];
    }
}
