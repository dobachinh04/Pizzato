<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bảng giỏ hàng
        Schema::create('cart', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('user_id')->constrained(); // ID người dùng
            $table->foreignId('product_id'); //ID các sản phẩm
            $table->foreignId('coupons_id')->nullable(); //ID mã giảm giá
            $table->double('grand_total'); // Tổng tiền
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
