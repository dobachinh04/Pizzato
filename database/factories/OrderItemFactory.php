<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lấy ngẫu nhiên order_id từ 1 đến 100
        $orderId = $this->faker->numberBetween(1, 100);

        // Lấy một Product ngẫu nhiên từ cơ sở dữ liệu
        $product = Product::inRandomOrder()->first(); // Lấy một Product ngẫu nhiên

        return [
            'order_id' => $orderId, // Gán order_id trong khoảng 1 -> 100
            'product_id' => $product ? $product->id : Product::factory(), // Nếu có Product thì lấy ID, nếu không tạo mới
            'unit_price' => $product ? $product->offer_price : $this->faker->randomFloat(2, 10000, 500000), // Lấy giá sản phẩm hoặc tạo giá ngẫu nhiên
            'qty' => $this->faker->numberBetween(1, 3), // Tạo số lượng ngẫu nhiên
        ];
    }
}
