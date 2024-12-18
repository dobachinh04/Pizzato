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
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumb_image')->nullable();

            // $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->integer('view')->default(0);
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->double('price'); // Giá sản phẩm
            $table->double('offer_price')->nullable()->default(0);
            $table->integer('qty')->default(0);
            $table->string('sku')->unique(); // Mã sản phẩm, phải là duy nhất
            $table->boolean('show_at_home')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes(); // Thêm cột xóa mềm
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
