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
        // Bảng kích thước sản phẩm
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('product_id')->constrained('products'); // ID sản phẩm
            $table->string('name'); // Tên kích cỡ
            $table->double('price'); // Giá tiền tương ứng
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
