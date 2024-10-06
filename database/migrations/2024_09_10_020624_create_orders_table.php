<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bảng đơn hàng
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('invoice_id'); // ID hóa đơn
            $table->foreignId('user_id')->constrained(); // ID người dùng
            $table->text('address'); // Địa chỉ
            $table->double('discount')->default(0); // Giảm giá
            $table->double('delivery_charge')->default(0); // Phí vận chuyển
            $table->double('grand_total'); // Tổng tiền
            $table->integer('product_qty'); // Số lượng sản phẩm
            $table->string('payment_method')->nullable(); // Phương thức thanh toán
            $table->string('payment_status')->default('pending'); // Trạng thái thanh toán
            $table->timestamp('payment_approve_date')->nullable(); // Ngày hoàn thành thanh toán
            $table->json('coupon_info')->nullable(); // Thông tin mã khuyến mãi
            $table->string('currency_name')->default('VND'); // Đơn vị tiền tệ
            $table->string('order_status')->default('pending'); // Trạng thái đơn hàng

            $table->timestamps(); // Thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
