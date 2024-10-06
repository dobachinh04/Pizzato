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
        // Bảng danh mục blog
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); // Tên danh mục blog
            $table->string('slug'); // Tên SEO
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
