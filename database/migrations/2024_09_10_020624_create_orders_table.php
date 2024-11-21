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
            $table->id();
            $table->string('invoice_id')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('address_id');

            $table->text('address');
            $table->double('discount')->default(0);
            $table->double('delivery_charge')->default(0);
            $table->double('sub_total');
            $table->double('grand_total');
            $table->integer('product_qty');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->timestamp('payment_approve_date')->nullable();
            $table->json('coupon_info')->nullable();
            $table->string('currency_name')->default('VND');
            $table->string('order_status')->default('pending');
            $table->timestamps();
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
