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
            $table->id();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            $table->decimal('rating', 6, 1);
            $table->text('review');
            // $table->boolean('status')->default(1); // 1: Approved, 0: Pending
            // $table->timestamp('approved_at')->nullable(); // Thời gian được duyệt
            $table->timestamps();
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
