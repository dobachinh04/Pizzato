<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = fake()->randomFloat(2, 100, 1000);
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'thumb_image' => fake()->imageUrl(640, 480, 'products', true, 'Faker'),
            'category_id' => fake()->numberBetween(1, 10),  // Giả sử có 10 category
            'view' => fake()->numberBetween(0, 1000),
            'short_description' => fake()->sentence(),
            'long_description' => fake()->paragraph(),
            'price' => $price,
            'offer_price' => fake()->numberBetween(0, (int)($price - 1)), // Giá ưu đãi giữa 0 và (giá gốc - 1)
            'qty' => fake()->numberBetween(1, 100),
            'sku' => fake()->unique()->regexify('[A-Z0-9]{8}'),
            'show_at_home' => fake()->boolean(),
            'status' => fake()->boolean(),
        ];
    }
}