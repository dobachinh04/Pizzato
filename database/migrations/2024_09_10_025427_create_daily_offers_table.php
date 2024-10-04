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
        // Bảng deal hời mỗi ngày
        Schema::create('daily_offers', function (Blueprint $table) {
            $table->id(); // ID tự tặng
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // ID sản phẩm
            $table->boolean('status')->default(1); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_offers');
    }
};
