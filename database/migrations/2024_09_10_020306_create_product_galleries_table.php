<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bảng Galleries - ảnh phụ sản phẩm
        Schema::create('product_galleries', function (Blueprint $table) {
            $table->id();

            // $table->foreignId('product_id')->constrained('products');
            $table->foreignIdFor(Product::class)->constrained();

            $table->string('galleries')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_galleries');
    }
};
