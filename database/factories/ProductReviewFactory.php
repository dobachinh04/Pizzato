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
     @return array<string, mixed>
     */
    protected $model = ProductReview::class;

    public function definition(): array
    {
        // Logic xác định rating sao cho 80% là trên 4 sao
        $rating = rand(1, 100) <= 80
            ? fake()->randomFloat(1, 4, 5) // 80% đánh giá từ 4 đến 5 sao
            : fake()->randomFloat(1, 1, 4); // 20% đánh giá từ 1 đến 4 sao

        return [
            'user_id' => User::inRandomOrder()->first()->id, // Chọn user ngẫu nhiên từ bảng users
            'product_id' => Product::inRandomOrder()->first()->id, // Chọn product ngẫu nhiên từ bảng products
            'rating' => $rating, // Rating từ 1.0 đến 5.0
            'review' => fake()->paragraph(), // Đoạn văn ngẫu nhiên
        ];
    }
}

