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
        // Chọn loại giảm giá ngẫu nhiên: 'percent' hoặc 'amount'
        $discountType = $this->faker->randomElement(['percent', 'amount']);

        // Tính giá trị giảm giá dựa trên loại
        $discount = $discountType === 'percent'
            ? $this->faker->numberBetween(5, 50) // Phần trăm giảm từ 5% đến 50%
            : $this->roundToNearest($this->faker->numberBetween(10000, 150000)); // Số tiền giảm từ 10,000 VND đến 150,000 VND, làm tròn

        // Số tiền giảm tối đa, chỉ áp dụng khi loại là percent
        $maxDiscountAmount = $discountType === 'percent'
            ? $this->faker->numberBetween(50000, 200000) // Giới hạn số tiền giảm tối đa từ 50,000 VND đến 200,000 VND
            : null;
        return [
            'name' => strtoupper($this->faker->unique()->word),  // Tên của coupon, viết hoa và unique
            'code' => strtoupper(Str::random(10)),  // Mã coupon ngẫu nhiên
            'qty' => $this->faker->numberBetween(1, 100),  // Số lượng từ 1 đến 100
            'min_purchase_amount' => $this->roundToNearest($this->faker->numberBetween(50000, 500000)),  // Số tiền mua tối thiểu, làm tròn
            'expire_date' => $this->faker->dateTimeBetween('now', '+1 year'),  // Ngày hết hạn từ hiện tại đến 1 năm
            'discount_type' => $discountType,  // Loại giảm giá: 'percent' hoặc 'amount'
            'discount' => $discount,  // Giá trị giảm giá tương ứng
            'max_discount_amount' =>  $this->roundToNearest($maxDiscountAmount),  // Số tiền giảm tối đa nếu là percent
            'status' => $this->faker->boolean,  // Trạng thái: true hoặc false
        ];
    }

    /**
     * Hàm làm tròn số từ hàng chục trở lên:
     * - Nếu phần dư > 500: làm tròn lên hàng ngàn kế tiếp.
     * - Nếu phần dư = 500: làm tròn lên hàng ngàn kế tiếp.
     * - Nếu phần dư < 500: làm tròn xuống hàng ngàn.
     *
     * @param int $number
     * @return int
     */
    private function roundToNearest($number): int
    {
        // Tính phần dư của hàng ngàn
        $remainder = $number % 1000;

        if ($remainder >= 500) {
            // Làm tròn lên hàng ngàn kế tiếp
            return $number + (1000 - $remainder);
        } else {
            // Làm tròn xuống hàng ngàn hiện tại
            return $number - $remainder;
        }
    }
}
