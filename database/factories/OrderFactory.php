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
    // Khai báo biến toàn cục để theo dõi mã invoice
    private static $invoiceNumber = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Tạo mã invoice có 7 ký tự và tăng dần
        $invoiceId = str_pad(self::$invoiceNumber++, 7, '0', STR_PAD_LEFT);

        // Lấy thời gian hiện tại
        $currentTime = now();

        // Lấy ngày hiện tại và tính ngày tối đa không được vượt quá
        $maxDate = $currentTime->format('Y-m-d');  // Lấy ngày hiện tại (năm-tháng-ngày)

        // Xác suất 40% cho đơn hàng mới nhất trong khoảng từ 1 đến 30 phút
        $isRecentOrder = rand(1, 100) <= 40;

        if ($isRecentOrder) {
            // Random thời gian tạo trong khoảng từ 1 đến 30 phút
            $randomMinutes = rand(20, 40); // Random số phút từ 1 đến 30
            $createdAt = $this->faker->dateTimeBetween($currentTime->subMinutes($randomMinutes), $currentTime);
        } else {
            // Tạo ngày ngẫu nhiên trong năm nay nhưng không vượt quá ngày hiện tại
            $createdAt = $this->faker->dateTimeBetween('2024-01-01', $maxDate);
        }

        // Xác định trạng thái đơn hàng: Nếu đơn được tạo quá 4 tiếng trước, không gán trạng thái 'pending'
        $orderStatus = $createdAt >= $currentTime->subHours(4) ? $this->faker->randomElement(['pending', 'processing', 'completed', 'canceled']) : $this->faker->randomElement(['processing', 'completed', 'canceled']);

        return [
            // Mã invoice tăng dần từ 00001
            'invoice_id' => $invoiceId,

            // Chọn một user ngẫu nhiên
            'user_id' => User::inRandomOrder()->first()->id,

            // Sử dụng giá trị ngẫu nhiên cho address_id và address
            'address_id' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->address,

            // Chọn ngẫu nhiên mức giảm giá, phí giao hàng, tổng số tiền
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'delivery_charge' => $this->faker->randomFloat(2, 0, 50),
            'sub_total' => $this->faker->randomFloat(2, 100, 1000),

            // Tính grand_total với giá trị số (không có đơn vị tiền tệ)
            'grand_total' => fn(array $attributes) => $attributes['sub_total'] - $attributes['discount'] + $attributes['delivery_charge'],

            // Số lượng sản phẩm
            'product_qty' => $this->faker->numberBetween(1, 10),

            // Phương thức thanh toán và trạng thái thanh toán
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash']),
            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),

            // Ngày duyệt thanh toán (tùy chọn)
            'payment_approve_date' => $this->faker->optional()->dateTime,

            // Thông tin mã giảm giá (nếu có)
            'coupon_info' => function () {
                $coupon = Coupon::inRandomOrder()->first(); // Lấy một mã giảm giá ngẫu nhiên
                return $coupon ? json_encode(['code' => $coupon->code]) : null;
            },

            // Đơn vị tiền tệ
            'currency_name' => 'VND',

            // Trạng thái đơn hàng
            'order_status' => $orderStatus,

            // Ngày tạo đơn hàng ngẫu nhiên trong năm nay nhưng không vượt quá ngày hiện tại
            'created_at' => $createdAt,

            // Ngày cập nhật
            'updated_at' => now(),
        ];
    }
}
