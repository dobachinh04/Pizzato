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
        // Bảng danh mục sản phẩm
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); // Tên danh mục
            $table->string('slug'); // Tên SEO
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
            $table->string('show_at_home')->default('0'); // Trạng thái hiển thị ở trang chủ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
