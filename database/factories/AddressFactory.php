<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use App\Models\DeliveryArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lấy khu vực giao hàng ngẫu nhiên
        $deliveryArea = DeliveryArea::inRandomOrder()->first();

        // Danh sách các quận/huyện của Hà Nội
        $districtsHanoi = [
            'Ba Đình',
            'Hoàn Kiếm',
            'Tây Hồ',
            'Long Biên',
            'Cầu Giấy',
            'Đống Đa',
            'Hai Bà Trưng',
            'Hoàng Mai',
            'Thanh Xuân',
            'Hà Đông',
            'Nam Từ Liêm',
            'Bắc Từ Liêm',
            'Đan Phượng',
            'Gia Lâm',
            'Đông Anh',
            'Sóc Sơn',
        ];

        // Danh sách các quận/huyện của Hồ Chí Minh
        $districtsHCM = [
            'Quận 1',
            'Quận 3',
            'Quận 5',
            'Quận 7',
            'Quận 9',
            'Quận 10',
            'Quận 11',
            'Quận 12',
            'Bình Thạnh',
            'Tân Bình',
            'Tân Phú',
            'Phú Nhuận',
            'Thủ Đức',
            'Bình Tân',
            'Gò Vấp',
            'Hóc Môn',
        ];

        // Chọn quận/huyện dựa trên khu vực giao hàng
        $district = $deliveryArea->area_name === 'Hà Nội'
            ? $this->faker->randomElement($districtsHanoi)
            : $this->faker->randomElement($districtsHCM);

        // Random số nhà, số ngõ, số ngách
        $houseNumber = 'Số ' . $this->faker->numberBetween(1, 999);
        $lane = 'Ngõ ' . $this->faker->numberBetween(1, 100);
        $subLane = 'Ngách ' . $this->faker->numberBetween(1, 50);

        // Địa chỉ chi tiết
        $address = $houseNumber . ', ' . $lane . ', ' . $subLane . ', ' . $district . ', ' . $deliveryArea->area_name;

        // Lấy người dùng ngẫu nhiên
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'delivery_area_id' => $deliveryArea->id,
            'first_name' => $user->name,                       // Lấy tên từ bảng `users`
            'last_name' => '',                                 // Bỏ qua họ, chỉ giữ tên
            'email' => $this->faker->boolean(50)               // 50% xác suất
                ? 'dobachinh04@gmail.com'
                : $this->faker->unique()->safeEmail,
            'phone' => $this->faker->numerify('09########'),   // Số điện thoại Việt Nam
            'address' => $address,                            // Địa chỉ chi tiết
        ];
    }
}
