<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,  // Tên của coupon
            'code' => strtoupper(Str::random(10)),  // Mã coupon ngẫu nhiên
            'qty' => $this->faker->numberBetween(1, 100),  // Số lượng từ 1 đến 100
            'min_purchase_amount' => $this->faker->randomFloat(2, 10, 500),  // Số tiền mua tối thiểu từ 10 đến 500
            'expire_date' => $this->faker->dateTimeBetween('now', '+1 year'),  // Ngày hết hạn từ hiện tại đến 1 năm
            'discount_type' => $this->faker->randomElement(['percent', 'amount']),  // Loại giảm giá: percentage hoặc fixed
            'discount' => $this->faker->numberBetween(5, 50),  // Giá trị giảm từ 5 đến 50 (có thể là % hoặc số tiền)
            'status' => $this->faker->boolean,  // Trạng thái: true hoặc false
        ];
    }
}
