<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => $this->faker->uuid,
            'user_id' => User::inRandomOrder()->first()->id,
            'address_id' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->address,
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'delivery_charge' => $this->faker->randomFloat(2, 0, 50),
            'sub_total' => $this->faker->randomFloat(2, 100, 1000),
            'grand_total' => fn(array $attributes) => $attributes['sub_total'] - $attributes['discount'] + $attributes['delivery_charge'],
            'product_qty' => $this->faker->numberBetween(1, 10),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash']),
            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'payment_approve_date' => $this->faker->optional()->dateTime,
            'coupon_info' => function () {
                $coupon = Coupon::inRandomOrder()->first(); // Lấy một mã giảm giá ngẫu nhiên
                return $coupon ? json_encode(['code' => $coupon->code]) : null;
            },
            'currency_name' => 'VND',
            'order_status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'canceled']),
        ];
    }
}
