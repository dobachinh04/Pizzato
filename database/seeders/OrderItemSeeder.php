<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Đảm bảo có sẵn ít nhất 1 sản phẩm trong cơ sở dữ liệu
        if (Product::count() === 0) {
            Product::factory(10)->create(); // Tạo 10 sản phẩm nếu chưa có
        }

        $productIds = Product::pluck('id')->toArray(); // Lấy danh sách ID sản phẩm

        // Đảm bảo mỗi order_id từ 1 đến 100 có ít nhất một OrderItem
        foreach (range(1, 100) as $orderId) {
            OrderItem::factory()->create([
                'order_id' => $orderId,
                'product_id' => $productIds[array_rand($productIds)], // Chọn ngẫu nhiên một sản phẩm
            ]);
        }

        // Tạo thêm các OrderItem ngẫu nhiên khác
        OrderItem::factory(200)->create(); // Tạo thêm 200 OrderItem bổ sung
    }
}
