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
        // Bảng sản phẩm yêu thích
        Schema::create('favorite_products', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('user_id')->constrained(); // ID người dùng
            $table->foreignId('product_id'); //ID các sản phẩm
            $table->timestamps(); // Thời gian thêm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_products');
    }
};
