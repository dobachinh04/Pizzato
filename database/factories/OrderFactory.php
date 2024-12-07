<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\DeliveryArea;
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

        // Lấy ngẫu nhiên coupon
        $coupon = Coupon::inRandomOrder()->first();

        // Tính toán mức giảm giá dựa trên loại giảm giá
        $discount = 0;
        if ($coupon) {
            if ($coupon->discount_type === 'percent') {
                // Giảm giá theo phần trăm
                $discount = $this->faker->randomFloat(2, 0, $coupon->discount);
            } elseif ($coupon->discount_type === 'amount') {
                // Giảm giá theo số tiền cố định
                $discount = min($coupon->discount, $this->faker->randomFloat(2, 0, 500000)); // Giới hạn mức giảm tối đa
            }
        }

        $deliveryArea = DeliveryArea::inRandomOrder()->first();

        return [
            // Mã invoice tăng dần từ 00001
            'invoice_id' => $invoiceId,

            // Chọn một user ngẫu nhiên
            'user_id' => User::inRandomOrder()->first()->id,

            // Sử dụng giá trị ngẫu nhiên cho address_id và address
            'address_id' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->address,

            // Chọn ngẫu nhiên mức giảm giá, phí giao hàng, tổng số tiền
            'discount' => $discount, // Mức giảm giá đã tính
            'delivery_charge' => $deliveryArea ? $deliveryArea->delivery_fee : 0,
            'sub_total' => $this->faker->randomFloat(2, 200000, 1000000),

            // Tính grand_total với giá trị số (không có đơn vị tiền tệ)
            'grand_total' => fn(array $attributes) => $attributes['sub_total'] - $attributes['discount'] + $attributes['delivery_charge'],

            // Số lượng sản phẩm
            'product_qty' => $this->faker->numberBetween(1, 10),

            // Phương thức thanh toán và trạng thái thanh toán
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cash', 'vn_pay']),

            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),

            // Ngày duyệt thanh toán (tùy chọn)
            'payment_approve_date' => function (array $attributes) {
                // Nếu payment_status là 'pending', thì không có ngày thanh toán
                if ($attributes['payment_status'] === 'pending') {
                    return null;
                }

                // Nếu payment_status là 'completed', chắc chắn có ngày thanh toán
                if ($attributes['payment_status'] === 'completed') {
                    return $this->faker->dateTimeBetween(now()->subMinutes(rand(1, 30)), now()->addHours(rand(1, 3))); // ngày trong khoảng 1 đến 3 giờ sau hoặc trước
                }

                // Nếu payment_status là 'failed', chỉ một số ít đơn hàng sẽ có ngày thanh toán
                if ($attributes['payment_status'] === 'failed') {
                    // Xác suất 30% có ngày thanh toán
                    return rand(1, 100) <= 30
                        ? $this->faker->dateTimeBetween(now()->subMinutes(rand(1, 30)), now()->addHours(rand(1, 3)))
                        : null; // Không có ngày thanh toán trong 70% trường hợp
                }

                return null; // Mặc định trả về null
            },

            // Thông tin mã giảm giá (nếu có)
            'coupon_info' => Coupon::inRandomOrder()->first()?->name ?? '',

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
