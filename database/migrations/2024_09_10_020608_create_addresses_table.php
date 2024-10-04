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
        // Bảng địa chỉ của người dùng
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID người dùng
            $table->foreignId('delivery_area_id')->constrained('delivery_areas'); // Khu vực giao hàng
            $table->string('first_name'); // Họ
            $table->string('last_name')->nullable(); // Tên
            $table->string('email'); // Email
            $table->string('phone'); // SĐT
            $table->text('address'); // Địa chỉ chi tiết
            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
