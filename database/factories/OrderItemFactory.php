<?php

namespace Database\Factories;

use App\Models\Order;
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
        // Lấy một Order và Product ngẫu nhiên từ cơ sở dữ liệu
        $order = Order::inRandomOrder()->first(); // Lấy một Order ngẫu nhiên
        $product = Product::inRandomOrder()->first(); // Lấy một Product ngẫu nhiên

        return [
            'order_id' => $order ? $order->id : Order::factory(), // Nếu có Order thì lấy ID, nếu không tạo mới
            'product_id' => $product ? $product->id : Product::factory(), // Nếu có Product thì lấy ID, nếu không tạo mới
            'unit_price' => $product ? $product->offer_price : $this->faker->randomFloat(2, 10000, 500000), // Lấy giá sản phẩm hoặc tạo giá ngẫu nhiên
            'qty' => $product ? $product->qty : $this->faker->numberBetween(1, 10), // Lấy số lượng sản phẩm hoặc tạo số ngẫu nhiên
        ];
    }
}
