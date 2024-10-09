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
            $table->string('slug')->unique(); // Tên SEO, phải là duy nhất
            $table->string('thumb_image')->nullable(); // Ảnh chính, có thể để trống
            $table->foreignId('category_id')->constrained('categories'); // ID danh mục, liên kết với bảng categories
            $table->integer('view')->default(0); // Lượt xem, mặc định là 0
            $table->text('short_description')->nullable(); // Mô tả ngắn, có thể để trống
            $table->text('long_description')->nullable(); // Mô tả dài, có thể để trống
            $table->double('price'); // Giá sản phẩm
            $table->double('offer_price')->nullable()->default(0); // Giá được giảm giá, mặc định là 0, có thể để trống
            $table->integer('qty')->default(0); // Số lượng, mặc định là 0
            $table->string('sku')->unique(); // Mã sản phẩm, phải là duy nhất
            $table->boolean('show_at_home')->default(0); // Trạng thái hiển thị ở trang chủ, mặc định là 0 (không hiển thị)
            $table->boolean('status')->default(1); // Trạng thái bật/tắt, mặc định là 1 (bật)
            $table->timestamps(); // Thời gian tạo và cập nhật
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
