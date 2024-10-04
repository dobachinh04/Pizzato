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
        // Bảng ảnh slider ở trang chủ
        Schema::create('sliders', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->text('image'); // Ảnh
            $table->string('offer')->nullable(); // Offer
            $table->string('title'); // Tên chính
            $table->string('sub_title'); // Tên phụ
            $table->string('short_description'); // Mô tả ngắn
            $table->string('button_link')->nullable(); // Nút đường dẫn
            $table->boolean('status')->default(1); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
