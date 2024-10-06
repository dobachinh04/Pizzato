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
        // Bảng mã giảm giá
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); // Tên mã giảm giá
            $table->string('code'); // Code để nhập giảm giá
            $table->integer('qty'); // Số lượng
            $table->integer('min_purchase_amount')->default(0); //
            $table->timestamps(); // Thời gian tạo
            $table->date('expire_date'); // Thời gian hết hạn
            $table->enum('discount_type', ['percent', 'amount']); // Loại giảm % hay trừ thẳng tiền
            $table->double('discount'); // Số % hoặc tiền muốn giảm giá
            $table->boolean('status')->default('1'); // Trạng thái bật/tắt
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
