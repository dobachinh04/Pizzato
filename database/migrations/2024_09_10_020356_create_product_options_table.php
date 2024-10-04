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
        // Bảng sản phẩm ăn kèm (Nước...)
        Schema::create('product_options', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('product_id')->constrained('products'); // ID sản phẩm
            $table->string('name'); // Tên món ăn kèm
            $table->double('price'); // Giá
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_options');
    }
};
