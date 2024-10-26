<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $product = Product::first();

        // Tạo dữ liệu mẫu cho bảng cart
        if ($user && $product) {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'coupons_id' => null, // Hoặc đặt ID của một mã giảm giá nếu có
                'quantity' => 2,
                'grand_total' => $product->price * 2, // Tổng tiền dựa trên giá sản phẩm và số lượng
            ]);
        }
    }
}
