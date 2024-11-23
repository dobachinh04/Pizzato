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
            $table->id();

            $table->foreignId('product_id')->constrained('products');

            $table->string('size_name')->nullable();
            $table->double('size_price')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
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
