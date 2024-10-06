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
        // Bảng đánh giá, bình luận sản phẩm
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID người dùng
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // ID danh mục
            $table->string('image'); // Ảnh bình luận
            $table->string('title'); // Tiêu đề
            $table->decimal('rating', 6, 1); // Số sao đánh giá
            $table->text('description'); // Mô tả
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
