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
        // Bảng chi tiết các món trong đơn hàng
        Schema::create('order_items', function (Blueprint $table) { // Bảng chi tiết đơn hàng
            $table->id(); // ID tự tăng
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // ID đơn hàng
            $table->foreignId('product_id'); //ID các sản phẩm
            $table->double('unit_price'); // Giá các sản phẩm
            $table->integer('qty'); // Số lượng
            $table->json('product_size')->nullable(); // Kích thước sản phẩm
            $table->json('product_option')->nullable(); // Sản phẩm ăn kèm (Nước...)
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
