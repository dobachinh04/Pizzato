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
        // Bảng sản phẩm
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); // Tên sản phẩm
            $table->string('slug'); // Tên SEO
            $table->string('thumb_image'); // Ảnh chính
            $table->foreignId('category_id')->constrained('categories'); // ID danh mục
            $table->integer('view'); // Lượt xem
            $table->text('short_description'); // Mô tả ngắn
            $table->text('long_description'); // Mô tả dài
            $table->double('price'); // Giá sản phẩm
            $table->double('offer_price')->default(0); // Giá được giảm giá
            $table->integer('qty'); // Số lượng
            $table->string('sku')->nullable(); // Mã sản phẩm
            $table->string('show_at_home')->default('0'); // Trạng thái hiển thị ở trang chủ
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};